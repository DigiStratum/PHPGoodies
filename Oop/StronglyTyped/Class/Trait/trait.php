<?php
/**
 * PHPGoodies:Oop_StronglyTyped_Class_Trait - A set of traits for a 'Strongly Typed' class
 *
 * ref: http://php.net/manual/en/language.oop5.overloading.php#object.set
 * ref: http://php.net/manual/en/functions.anonymous.php
 * ref: http://php.net/manual/en/closure.bind.php
 * ref: http://php.net/manual/en/spl.exceptions.php
 *
 * @todo Rename all internal methods to something more obscure, less likely to collide with subcless methog names
 * @todo Add support for __call()ing private methods from inside the class (privileged __call)
 * @todo Add support for typed arrays...
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.StronglyTyped.Class.Member');

/**
 * Scope constants
 */
const ST_SCOPE_ANY	= 'any';
const ST_SCOPE_PUBLIC	= 'public';
const ST_SCOPE_PRIVATE	= 'private';

/**
 * Type constants
 */
const ST_TYPE_STRING	= 'string';
const ST_TYPE_INTEGER	= 'integer';
const ST_TYPE_DOUBLE	= 'double';
const ST_TYPE_BOOLEAN	= 'boolean';
const ST_TYPE_RESOURCE	= 'resource';
const ST_TYPE_OBJECT	= 'object';
const ST_TYPE_ARRAY	= 'array';
const ST_TYPE_FUNCTION	= 'function';
const ST_TYPE_UNKNOWN	= 'unknown type';
const ST_TYPE_VARARGS	= '...';

// Just used for return types on protoMethods that don't return data:
const ST_TYPE_NULL	= 'null';

const ST_PROTO_LEADER	= '___proto___';

/**
 * A set of traits for a 'Strongly Typed' class
 */
trait Oop_StronglyTyped_Class_Trait {

	/**
	 * The class members under our management
	 */
	protected $classMembers = array();

	/**
	 * ProtoMethod data for our lazy loader to reference
	 */
	protected $protoMethods = array();


	/**
	 * Constructor function
	 *
	 * Let's initialize anything that we need to, the work normally done by a constructor. This
	 * code is here instead of in an explicit constructor in order that a subclass may have a
	 * constructor which doesn't interfere with this, and also to facilitate polymorphic
	 * constructors...
	 */
	protected function ___constructor($args) {

		// Reflect on ourselves to see what final private ___proto___*() functions we have
		$myself = new \ReflectionClass($this);
		$methods = $myself->getMethods(\ReflectionMethod::IS_PUBLIC);

		// Of all the defined methods, look for protomethods and register them
		foreach ($methods as $index => $method) {

			// If this method's name starts witht he protomethod leader string...
			if (strpos($method->name, ST_PROTO_LEADER) === false) continue;

			// Look for annotation: @proto scope returnType methodName(argType1[,argType2[,argTypeN]]])
			$name = substr($method->name, strlen(ST_PROTO_LEADER));
			if ($vpos = strpos($name, '___')) {
				// Strip the variant id off the end...
				$name = substr($name, 0, $vpos);
			}
			$docComment = $methods[$index]->getDocComment();

			// If there is no proper @proto annotation...
			if (! preg_match("/@proto (.*? {$name}\(.*?\))/m", $docComment, $matches)) {

				// If there was an attempt at one...
				if (preg_match("/(@proto .*?\n)/m", $docComment, $matches)) {
					$msg = "Improper @proto annotation found for method '{$method->name}'";
					throw PHPGoodies::instantiate('Oop.Exception.InvalidAnnotationException', $msg);
				}

				// TODO: should we passively skip these, log a warning or big-badda-boom?
				continue;
			}
			$protoAnnotation = $matches[1];
			$characteristics = explode(' ', $protoAnnotation);

			// For now we expect 3 characteristics: scope, returnType, methodName(argTypes)
			if (3 != count($characteristics)) {
				$msg = "Improper @proto annotation found for method '{$method->name}'";
				throw PHPGoodies::instantiate('Oop.Exception.InvalidAnnotationException', $msg);
			}
			$prototype = $characteristics[2];

			// If this protoMethod is a constructor...
			if ('__construct' == $name) {

				// Load it up now because we're going to call it after the loop
				$this->loadProtoMethod(
					$name,
					$prototype,
					$method->name,
					$characteristics[1],
					$characteristics[0]
				);
			}
			else {

				// Otherwise, just register the ProtoMethod
				$this->protoMethods[$prototype] = new \StdClass();
				$this->protoMethods[$prototype]->name = $name;
				$this->protoMethods[$prototype]->scope = $characteristics[0];
				$this->protoMethods[$prototype]->returnType = $characteristics[1];
				$this->protoMethods[$prototype]->protoName = $method->name;
			}
		}

		// Now call the constructor requested, if there is one
		try {
			$this->call('__construct', $args, ST_SCOPE_PUBLIC);
		}
		catch (\Exception $e) {

			// If there were any args supplied
			if (count($args) > 0) {

				// Rethrow the exception; obviously there was no matching constructor
				throw $e;
			}

			// Otherwise we let it slide silently because PHP objects
			// should be instantiable even with no constructor at all
		}
	}

	/**
	 * ProtoMethod lazy loader
	 *
	 * @param string $name The name of the desired method; there may be many (polymorphic, duh)
	 *
	 * @return object $this for chaining support...
	 */
	protected function loadProtoMethods($name) {

		// Find all protoMethods with the matching name amongst the registered ones
		foreach ($this->protoMethods as $prototype => $protoMethod) {

			// If the name does not match, keep looking, otherwise load it up!
			if ($name != $protoMethod->name) continue;

			$this->loadProtoMethod(
				$name,
				$prototype,
				$protoMethod->protoName,
				$protoMethod->returnType,
				$protoMethod->scope
			);
	
			// Remove from protoMethod since it is promoted to a full classMember now;
			// this reduces the set that we have to comb through in future calls.
			unset($this->protoMethods[$prototype]);

		}
	}

	/**
	 * ProtoMethod lazy loader
	 *
	 * @param string $name The name of the desired method; there may be many (polymorphic, duh)
	 * @param string $prototype The function prototype for the one we want...
	 *
	 * @return object $this for chaining support...
	 */
	protected function loadProtoMethod($name, $prototype, $protoName, $returnType, $scope) {

		// Extract the argTypes from the prototype
		$skip = strlen($name) + 1;
		$argTypeList = substr($prototype, $skip, strlen($prototype) - $skip - 1);
		$argTypes = strlen($argTypeList) ? explode(',', $argTypeList) : array();

		// Verify that all argTypes are legal...
		foreach ($argTypes as $argType) {
			$this->requireLegalType($argType);
		}

		// Get the code for the function...
		$function = $this->$protoName();
		if (ST_TYPE_FUNCTION !== $this->getType($function)) {
			$msg = "Method '{$protoName}' did not return a callable function";
			throw PHPGoodies::instantiate('Oop.Exception.BadProtoMethodException', $msg);
		}

		// Try to add this prototyped function as a class member
		$this->addClassMember(
			$name,
			$returnType,
			$scope,
			$function,
			$prototype
		);

		return $this;
	}

	/**
	 * Add a public class member
	 *
	 * Note that type is automatically the type of that value unless overridden; however the
	 * only purpose for this method to exist is to facilitate overriding the type, otherwise a
	 * member could be easily added with direct assignment routing through the _set() method.
	 *
	 * @param string $name The name of the class member to add
	 * @param mixed $value The default value to assign to this class member (data|function)
	 * @param string $type Optional type that will be enforced for this class member
	 *
	 * @return object $this for chaining support...
	 */
	public function add($name, $value, $type = null) {
		if (is_null($type)) $type = $this->getType($value);
		return $this->addClassMember($name, $type, ST_SCOPE_PUBLIC, $value);
	}

	/**
	 * Magic property setter
	 *
	 * This magic function is used whenever there is any attempt to directly assign a property
	 * to the object. This logic forces any such attempt to be moderated by our set() method;
	 * one exception from our normal setter's behavior though is that using this we will add the
	 * property if it doesn't exist instead of requiring it to preexist. Once added, the member
	 * will take on the type of the supplied value and any future set operations performed
	 * against it will need to be the same type, else big badda boom.
	 *
	 * @param string $name Name of the property we want to set
	 * @param mixed $value The value we want to set it to
	 *
	 * @return object $this for chaining support...
	 */
	public function __set($name, $value) {
		if ($this->hasClassMember($name)) {
			return $this->set($name, $value, ST_SCOPE_PUBLIC);
		}
		else {
			return $this->add($name, $value);
		}
	}

	/**
	 * Magic property checker
	 *
	 * This magic function is used whenever there is any outside attempt to directly check if a
	 * class property is set. This logic forces us to consider the existence of the property,
	 * it's scope of accessibility (must not be private), and whether or not there actually is a
	 * value set for it. Since isset() is supposed to be a gentle way to ask about the existence
	 * that won't cause an explosion in an attempt to access blindly, we won't throw any sort of
	 * error for named class members that don't exist.
	 *
	 * @param string $name Name of the property we want to check
	 *
	 * @return boolean true if the property is set, else false
	 */
	public function __isset($name) {
		return $this->chk($name, ST_SCOPE_PUBLIC);
	}

	/**
	 * Magic property getter
	 *
	 * This magic function is used whenever there is any outside attempt to directly get the
	 * value of a class property. Here we call our internal getter with the public scope to
	 * enforce scope-checking...
	 *
	 * @param string $name Name of the property we want to get
	 *
	 * @return mixed The value of the named property, or null if it is not set
	 */
	public function __get($name) {
		return $this->get($name, ST_SCOPE_PUBLIC);
	}

	/**
	 * Magic property unsetter
	 *
	 * This magic function is used whenever there is any outside attempt to directly unset one
	 * of the class properties. Here we call our internal del() method with the public scope to
	 * enforce scope-checking...
	 *
	 * @param string $name Name of the property we want to delete
	 */
	public function __unset($name) {
		$this->del($name, ST_SCOPE_PUBLIC);
	}

	/**
	 * Magic method caller
	 *
	 * This method is invoked whenever anyone from the outside attempts to call a method inside
	 * the class with the specific name. We will use this to invoke our dynamically added code
	 * if possible.
	 *
	 * @param string $name The name of the function to call
	 * @param array $args The set of calling arguments for the function call to be made
	 *
	 * @return mixed Returns whatever the function call does normally
	 */
	public function __call($name, $args) {
		return $this->call($name, $args, ST_SCOPE_PUBLIC);
	}

	/**
	 * Get the 'type' for the supplied object
	 *
	 * Our types expand on the PHP primitives by combining objects with their class names if
	 * they are anything more specific than 'StdClass'
	 *
	 * @param mixed $obj Some data/callable entity that we want a type for
	 *
	 * @return string the type of the object that we will use internally
	 */
	protected function getType(&$obj) {

		// Get the native type; strtolower makes 'NULL' into 'null'
		$type = strtolower(gettype($obj));

		if (ST_TYPE_OBJECT == $type) {

			// Nope, must be a regular object class
			$class = get_class($obj);

			// Functions are class "Closure"
			if ('Closure' == $class) return ST_TYPE_FUNCTION;

			// Anything else is a normal class
			return ('StdClass' == $class) ? ST_TYPE_OBJECT : "class:{$class}";
		}

		return $type;
	}

	/**
	 * Require that the named class member exists
	 *
	 * @param string $name The name we require to exist
	 */
	protected function requireMember($name) {
		if ($this->hasClassMember($name)) return;
		throw PHPGoodies::instantiate('Oop.Exception.MemberDoesNotExistException',
			'Attempted to access non-existent class member'
		);
	}

	/**
	 * Require value's type to match unless it's null which is always ok
	 *
	 * We disallow null for function type members, but allow it for pretty much anything else...
	 *
	 * @param string $name Name of the class member whose type we are comparing to
	 * @param mixed $value The value whose type we are interested in relative to named member
	 *
	 * @return object $this for chaining support...
	 */
	protected function requireTypeMatch($name, &$value) {

		// So long as the class member exists...
		$this->requireMember($name);

		// Look more closely...
		$member =& $this->getClassMember($name);

		// A null value is usually acceptable...
		if (is_null($value)) {

			// As long as the classMember is nullable...
			if ($member->isNullable) return $this;
		}

		// If the member has enforcement disabled then any value is OK...
		if (ST_ENFORCEMENT_DISABLED == $member->enforcement) return $this;

		$type = gettype($value);

		// An exact match on native type is great...
		if ($member->type == $type) return $this;

		// Translated type might be a better match...
		$type = $this->getType($value);
		if ($member->type == $type) return $this;
		
		throw new \InvalidArgumentException("Type mismatch accessing class member '{$name}'; expected '{$member->type}', got '{$type}'");
	}

	/**
	 * Check whether the specified name is legal to use for a class member
	 *
	 * @param string $name The name we want to check out
	 *
	 * @return boolean true if the name is legal to use as a class member name, else false
	 */
	protected function isLegalName($name) {
		if (! is_string($name)) return false;
		// Legal names start with A-Z, a-z, or '_' and are followed by
		// the same and/or digits; added '\' to support namespaced names
		return preg_match('/^[\\\\A-Za-z_][\\\\A-Za-z0-9_]*$/', $name) ? true : false;
	}

	/**
	 * Check whether the specified type name is a legal one
	 *
	 * @param string $type The type name we want to check out
	 *
	 * @return boolean true if it is legal, else false
	 */
	protected function isLegalType($type) {

		// Type specifier MUST be a native string!
		if (! is_string($type)) return false;

		switch ($type) {
			// The essential types...
			case ST_TYPE_STRING:
			case ST_TYPE_INTEGER:
			case ST_TYPE_DOUBLE:
			case ST_TYPE_BOOLEAN:
			case ST_TYPE_RESOURCE:
			case ST_TYPE_OBJECT:
			case ST_TYPE_ARRAY:
			// Made up types...
			case ST_TYPE_FUNCTION:
			case ST_TYPE_NULL:
				return true;

			default:
				// We also support 'class:name'
				if (preg_match('/class:(.*)/', $type, $matches)) {

					// Check that the class name is a legal one...
					$name = $matches[1];
					if (! $this->isLegalName($name)) return false;

					// And that the class is defined
					return class_exists($name);
				}
		}

		return false;
	}

	/**
	 * Check whether the specified scope name is a legal one
	 *
	 * @param string $scope The scope name we want to check out
	 *
	 * @return boolean true if it is legal, else false
	 */
	protected function isLegalScope($scope) {

		// Scope specifier MUST be a native string!
		if (! is_string($scope)) return false;

		switch ($scope) {
			case ST_SCOPE_ANY:
			case ST_SCOPE_PUBLIC:
			case ST_SCOPE_PRIVATE:
				return true;
		}

		return false;
	}

	/**
	 * Require a legal scope specifier... or Except
	 *
	 * @todo Add test coverage for this method...
	 *
	 * @param string $scope The scope name we want to check out
	 *
	 * @return object $this for chaining support...
	 */
	protected function requireLegalScope($scope) {
		if ($this->isLegalScope($scope)) return $this;
		$msg = 'Illegal scope specified: ' . (is_string($scope) ? "'{$scope}'" : "[ {$this->getType($scope)} ]");
		throw new \InvalidArgumentException($msg);
	}

	/**
	 * Require a legal type specifier... or Except
	 *
	 * @todo Add test coverage for this method...
	 *
	 * @param string $type The type name we want to check out
	 *
	 * @return object $this for chaining support...
	 */
	protected function requireLegalType($type) {
		if ($this->isLegalType($type)) return $this;
		$msg = 'Illegal data type specified: ' . (is_string($type) ? "'{$type}'" : "[ {$this->getType($type)} ]");
		throw new \InvalidArgumentException($msg);
	}

	/**
	 * Require a legal name specifier... or Except
	 *
	 * @todo Add test coverage for this method...
	 *
	 * @param string $name The name we want to check out
	 *
	 * @return object $this for chaining support...
	 */
	protected function requireLegalName($name) {
		if ($this->isLegalName($name)) return $this;
		$msg = 	'Illegal class member name specified: ' . (is_string($name) ? "'{$name}'" : "[ {$this->getType($name)} ]");
		throw new \InvalidArgumentException($msg);
	}

	/**
	 * Add a class member with the specified type and scope
	 *
	 * Note that if the ClassMember being added is a function, then type should be set to the
	 * expected return type for that function, and the function callable should be provided as
	 * the value. These will be reworked into the classMembers such that type becomes function,
	 * returnType becomes type, and the function callable is stored in value.
	 *
	 * @param string $name The name of the class member to add
	 * @param string $type The type that will be enforced for this class member
	 * @param string $scope The visibility scope for this class member (public|private)
	 * @param mixed $value The default value to assign to this class member (data|function)
	 *
	 * @return object $this for chaining support...
	 */
	protected function addClassMember($name, $type, $scope, $value = null, $prototype = null) {

		//  Check for legal name, type, and scope
		$this->requireLegalName($name)->requireLegalType($type)->requireLegalScope($scope);

		// Special handling for functions to get the return type
		$returnType = null;
		if (! is_null($value)) {
			$vtype = $this->getType($value);
			if (ST_TYPE_FUNCTION == $vtype) {
				$returnType = $type;
				$type = ST_TYPE_FUNCTION;
			}
		}

		// For functions...
		if (ST_TYPE_FUNCTION == $type) {

			// Make a new function member...
			$member = PHPGoodies::instantiate('Oop.STClassMember', $name, $scope, $type, $returnType, $prototype);

			// The real name will now be the member's prototype
			$name = $member->prototype;

			// Prevent redefinition
			if ($this->hasClassMember($member->prototype)) {
				throw new \LogicException("A class method with the same prototype already exists: {$member->prototype}");
			}

			// Add it to the collection of class members
			$this->classMembers[$name] = $member;
		}
		else {

			// Prevent redefinition
			if ($this->hasClassMember($name)) {
				throw new \LogicException("A class member named '{$name}' already exists");
			}

			// Add it to the collection of class members
			$this->classMembers[$name] = PHPGoodies::instantiate('Oop.STClassMember', $name, $scope, $type);
		}

		// Now set the value for the class member with type enforcement
		$this->set($name, $value);

		return $this;
	}

	/**
	 * Check if we have a class member with the specified name
	 *
	 * @param string $name The name of the class member to add
	 *
	 * @return boolean true if we have the named class member, else false
	 */
	protected function hasClassMember($name) {
		return isset($this->classMembers[$name]);
	}

	/**
	 * Get the definition for the class member with the specified name
	 *
	 * For performance reasons, most-to-all usages of this method should get a reference to the
	 * classMember data instead of a value copy. This avoids copying properties of classMember
	 * such as the value which could potentially have enormous amounts of data in it...
	 *
	 * @param string $name The name of the class member to add
	 *
	 * @return object Class member definition that we're after or null if it doesn't exist
	 */
	protected function &getClassMember($name) {
		if (! $this->hasClassMember($name)) {
			$null = null;
			return $null;
		}
		return $this->classMembers[$name];
	}

	/**
	 * Check whether the named class member is accessible to the reqesting scope
	 *
	 * @param string $name The name of the class member to check
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return boolean true if the named class member is accessible, else false
	 */
	protected function isClassMemberScopeAccessible($name, $scope) {

		// Require the member to be defined
		if (! $this->hasClassMember($name)) return false;

		// Examine requesting scope...
		switch ($scope) {

			// Privileged access; 'any' accesses members with any scope
			case ST_SCOPE_ANY:
				return true;

			// Explicit access; scope must match that of named member
			case ST_SCOPE_PUBLIC:
			case ST_SCOPE_PRIVATE:
				$member =& $this->getClassMember($name);
				return $member->scope == $scope;
		}

		return false;
	}

	/**
	 * Require that the named class member is accessible from the specified scope
	 *
	 * @param string $name The name of the class member to check
	 * @param string $scope The visibility scope of the requester
	 */
	protected function requireAccess($name, $scope) {

		// Basically we shouldn't be able to access private scope on a public request...
		if ($this->isClassMemberScopeAccessible($name, $scope)) return;
		throw PHPGoodies::instantiate('Oop.Exception.AccessDeniedException',
			'Attempted to access private class member from public scope'
		);
	}

	/**
	 * Check whether the named class member is a function that can be called
	 *
	 * @param string $name The name of the class member to check
	 *
	 * @return boolean true if it is a function, else false
	 */ 
	protected function isFunction($name) {
		$member =& $this->getClassMember($name);
		if (is_null($member)) return false;
		return $member->type == ST_TYPE_FUNCTION;
	}

	/**
	 * Require that the named class member is a function that can be called
	 *
	 * @param string $name The name of the class member to check
	 */
	protected function requireFunction($name) {
		if ($this->isFunction($name)) return;
		throw new \BadMethodCallException('Attempted to invoke a non-existent function/method');
	}

	/**
	 * Sets the named class member to the supplied value
	 *
	 * @param string $name Name of the class member we want to set
	 * @param mixed $value The value we want to set it to
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return object $this for chaining support...
	 */
	protected function set($name, $value, $scope = ST_SCOPE_ANY) {
		$this->requireTypeMatch($name, $value);
		$this->requireAccess($name, $scope);
		$member =& $this->getClassMember($name);

		// For functions we need to create a closure so they can get at the rest of our class members
		if ($this->isFunction($name)) {
			$member->value = \Closure::bind($value, $this, get_class());
		}
		else $member->value = $value;

		return $this;
	}

	/**
	 * Make a function prototype string from the supplied name and argument types
	 *
	 * Note that we are just doing what we are told with no error checking. The caller should
	 * verify that the supplied name and argTypes are all legal/valid.
	 *
	 * @param string $name Name of the function
	 * @param array An arry of strings (each one of the ST_TYPE_* constants)
	 * @param boolean $variadic Optionally add varargs argument to the end, default false
	 *
	 * @return string A function prototype string that matches what was supplied
	 */
	protected function makePrototype($name, $argTypes, $variadic = false) {

		// Each one of these ends with varargs since it is impossible for
		// there to be an exact match on anything with FEWER than the
		// number of calling arguments we actually received...
		if ($variadic) $argTypes[] = ST_TYPE_VARARGS;
		return $name . '(' . join(',', $argTypes) . ')';
	}

	/**
	 * Find a function proto name amongst the class members matching the name/argument types
	 *
	 * @param string $name Name of the function
	 * @param array An arry of strings (each one of the ST_TYPE_* constants)
	 *
	 * @return string Protoname of the matching class member, or null if none found
	 */
	protected function findProtoname($name, $argTypes = array()) {

		// First see if there is an exact match for this argument prototype
		$protoname = $this->makePrototype($name, $argTypes);
		if (! $this->isFunction($protoname)) {

			// For each possible prototype match from most to least specific
			for ($xx = count($argTypes); $xx >= 0; $xx--) {

				// Each one of these possibilities must be variadic since it is
				// impossible for there to be an exact match on anything with FEWER
				// than the number of calling arguments we actually received...
				$protoname = $this->makePrototype($name, array_slice($argTypes, 0, $xx), true);
				if ($this->isFunction($protoname)) break;
			}
		}

		return $this->isFunction($protoname) ? $protoname : null;
	}

	/**
	 * Internal method caller
	 *
	 * This is the only way to call one of the dynamically added private scoped functions
	 * internally such that the requireAccess() call will be satisfied. External calls that go
	 * through __call() are scoped public, but direct calls here are scoped any by default...
	 *
	 * The function's return data type is enforced to match what is on record...
	 *
	 * @param string $name The name of the function to call
	 * @param array $args The set of calling arguments for the function call to be made
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return mixed Returns whatever the function call does normally
	 */
	protected function call($name, $args, $scope = ST_SCOPE_ANY) {

		// Convert the calling arguments into a set of prototype matchers
		$argTypes = array();
		foreach ($args as $arg) $argTypes[] = $this->getType($arg);
		// TODO: any need for special accounting of object vs class:classname?

		// First let's see if we already have a protoname that matches
		$protoname = $this->findProtoname($name, $argTypes);
		if (is_null($protoname)) {
			// See if there are any protoMethods waiting for a lazy load
			$this->loadProtoMethods($name);
		}

		// Still nothing?
		$protoname = $this->findProtoname($name, $argTypes);
		if (is_null($protoname)) {
			$msg = "There is no class method matching: {$this->makePrototype($name, $argTypes)}";
			throw new \BadMethodCallException($msg);
		}

		// TODO: account for internal calls on ST_SCOPE_PRIVATE functions without having to send args through an array (?)
		$this->requireFunction($protoname);
		$this->requireAccess($protoname, $scope);
		$member =& $this->getClassMember($protoname);
		$res = call_user_func_array($member->value, $args);
		$returnType = $this->getType($res);

		// TODO : conditional enforcement and hybrid types (like object vs. class:classname) for return value
		if ($returnType !== $member->returnType) {
			$msg = "Type mismatch for result from function call to '{$name}'; expected '{$member->returnType}', but got '{$returnType}'";
			throw new \UnexpectedValueException($msg);
		}

		return $res;
	}

	/**
	 * Check whether the named class member is defined
	 *
	 * @param string $name Name of the class member we want to check
	 *
	 * @return boolean true if the class member is defined, else false
	 */
	protected function has($name) {
		return $this->hasClassMember($name);
	}

	/**
	 * Check whether the named class member is set and visible to the named scope
	 *
	 * @param string $name Name of the class member we want to check
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return boolean true if the class member is set, else false
	 */
	protected function chk($name, $scope = ST_SCOPE_ANY) {
		if (! $this->isClassMemberScopeAccessible($name, $scope)) return false;
		$member =& $this->getClassMember($name);
		return is_null($member->value) ? false : true;
	}

	/**
	 * Get the value of the named class member
	 *
	 * @param string $name Name of the class member we want to get
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return mixed The value of the named class member
	 */
	protected function get($name, $scope = ST_SCOPE_ANY) {
		$this->requireMember($name);
		$this->requireAccess($name, $scope);
		$member =& $this->getClassMember($name);
		return $member->value;
	}

	/**
	 * Delete the named class member if it is defined
	 *
	 * In order to support removal of functions, there is some trickery. The problem we have is
	 * that a call to unset() must be supplied with the instance->propertyName. Functions are
	 * organized by prototypes which are not valid property names because they include special
	 * characters like '(,.)' in them; Indeed it would be impossible to rework the prototype
	 * string schema to use only valid characters without stepping on the normal domain of
	 * valid property names that could potentially collide with user-defined names. Therefore
	 * what we have done is made it so that when you attempt to unset(instance->propetyName),
	 * we enter here, look for a normal property with the exact match on the propertyName and
	 * unset it if present. Otherwise we look through all defined functions and any function
	 * whose name matches propertyName - not prototype - will be unset. That means that, with
	 * a polymorphic pair such as myfunc(boolean) and myfunc(integer), unset(instance->myfunc)
	 * will remove both forms of the function. At the end of the day, this is a peculiar
	 * convenience capability anyway which will probably only see occasional use, so this seems
	 * like a decent compromise to facilitate dynamic removal of functions at all.
	 *
	 * @param string $name Name of the class member we want to delete
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return object $this for chaining support...
	 */
	protected function del($name, $scope = ST_SCOPE_ANY) {

		// If there is a direct match, then it's easy...
		if ($this->hasClassMember($name)) {
			$this->requireAccess($name, $scope);
			unset($this->classMembers[$name]);
			return $this;
		}

		// If there are any functions by this name...
		$matched = false;
		foreach ($this->classMembers as $protoname => $member) {

			// If this class member is not a function keep looking...
			if (ST_TYPE_FUNCTION !== $member->type) continue;

			// If this class member's name is not the one we want keep looking...
			if ($name !== $member->name) continue;

			// This is a match - kill it!
			$matched = true;
			$this->requireAccess($protoname, $scope);
			unset($this->classMembers[$protoname]);
		}

		if (! $matched) {
			throw PHPGoodies::instantiate('Oop.Exception.MemberDoesNotExistException',
				'Attempted to remove non-existent class member'
			);
		}

		return $this;
	}
}

