<?php
/**
 * PHPGoodies:TClass - A 'Typed' class with strong type enforcement
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * A 'Typed' class with strong type enforcement
 */
class TClass {

	const SCOPE_ANY		= 'any';
	const SCOPE_PUBLIC	= 'public';
	const SCOPE_PRIVATE	= 'private';

	/**
	 *
	 */
	protected $classMembers = array();

	/**
	 *
	 */
	public function __construct() {

	}

	/**
	 * Add a public class member
	 *
	 * Note that type is automatically the type of that value unless overridden.
	 *
	 * @param string $name The name of the class member to add
	 * @param mixed $value The default value to assign to this class member (data|function)
	 * @param string $type Optional type that will be enforced for this class member
	 *
	 * @return object $this for chaining support...
	 */
	public function add($name, $value, $type = null) {
		if (is_null($type)) $type = $this->getType($value);
		return $this->addClassMember($name, $type, self::SCOPE_PUBLIC, $value);
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
			return $this->set($name, $value, self::SCOPE_PUBLIC);
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
		return $this->chk($name, self::SCOPE_PUBLIC);
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
		return $this->get($name, self::SCOPE_PUBLIC);
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
		$this->del($name, self::SCOPE_PUBLIC);
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
	protected function getType($obj) {
		$type = gettype($obj);
		if ($type == 'object') {
			$class = get_class($obj);
			return ($class == 'StdClass') ? 'object' : "class:{$class}";
		}
		return $type;
	}

	/**
	 * Require that the named class member exists
	 *
	 * @param string $name The name we require to exist
	 */
	protected function requireMember($name) {
		if (! $this->hasClassMember($name)) {
			throw new \Exception("Attempted to access non-existent class member '{$name}'");
		}
	}

	/**
	 * Require value's type to match unless it's null which is always ok
	 *
	 * @param string $name Name of the class member whose type we are comparing to
	 * @param mixed $value The value whose type we are interested in relative to named member
	 */
	protected function requireTypeMatch($name, &$value) {

		// So long as the class member exists...
		$this->requireMember($name);

		// A null value is always acceptable...
		if (is_null($value)) return;

		// Look more closely...
		$member = $this->getClassMember($name);
		$type = gettype($value);

		// An exact match on type is great...
		if ($member->type == $type) return;

		// If the value is an object...
		if ($type == 'object') {
			$class = get_class($value);
			// ... and we have a classname match then we're good...
			if ($member->type == "class:{$class}") return;
		}
		
		throw new \Exception("Type mismatch accessing class member '{$name}'; expected '{$member->type}', got '{$type}'");
	}

	/**
	 * Check whether the specified name is a legal one to use for a property
	 *
	 * @param string $name The name we want to verify out
	 *
	 * @return boolean true if the name is legal for use as a property name, else false
	 */
	protected function isLegalName($name) {
		if (! is_string($name)) return false;
		// Legal names start with A-Z, a-z, or '_' and are followed by the same and/or digits
		return preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $name);
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
			case 'string':
			case 'integer':
			case 'int':
			case 'float':
			case 'double':
			case 'boolean':
			case 'resource':
			case 'object':
				return true;

			default:
				// We also support 'class:name'
				if (preg_match('/class:(.*)/', $type, $matches)) {

					// Check that the class name is a legal one...
					$name = $matches[1];
					if (! $this->isLegalName($name)) return false;

					// And that the class is defined
					// TODO: anything needed to account for namespacing here?
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
		switch ($scope) {
			case self::SCOPE_ANY:
			case self::SCOPE_PUBLIC:
			case self::SCOPE_PRIVATE:
				return true;
		}
		return false;
	}

	/**
	 * Add a class member with the specified type and scope
	 *
	 * @param string $name The name of the class member to add
	 * @param string $type The type that will be enforced for this class member
	 * @param string $scope The visibility scope for this class member (public|private)
	 * @param mixed $value The default value to assign to this class member (data|function)
	 *
	 * @return object $this for chaining support...
	 */
	protected function addClassMember($name, $type, $scope, $value = null) {

		//  Check for legal name, type, and scope
		if (! $this->isLegalName($name)) {
			throw new \Exception('Illegal class member name specified: ' . (is_string($name) ? "'{$name}'" : "[ {$this->getType($name)} ]"));
		}
		if (! $this->isLegalType($type)) {
			throw new \Exception('Illegal class member type specified: ' . (is_string($type) ? "'{$type}'" : "[ {$this->getType($type)} ]"));
		}
		if (! $this->isLegalScope($scope)) {
			throw new \Exception('Illegal class member scope specified: ' . (is_string($scope) ? "'{$scope}'" : "[ {$this->getType($scope)} ]"));
		}

		// Prevent redefinition
		if ($this->hasClassMember($name)) {
			throw new \Exception("A class member named '{$name}' already exists");
		}

		// Add the new property member
		$this->classMembers[$name] = (object) array(
			'type' => $type,
			'scope' => $scope,
			'value' => null
		);

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
	 * @param string $name The name of the class member to add
	 *
	 * @return object Class member definition that we're after or null if it doesn't exist
	 */
	protected function &getClassMember($name) {
		$null = null;
		return $this->hasClassMember($name) ? $this->classMembers[$name] : $null;
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
			case self::SCOPE_ANY:
				return true;

			// Explicit access; scope must match that of named member
			case self::SCOPE_PUBLIC:
			case self::SCOPE_PRIVATE:
				$member = $this->getClassMember($name);
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
		if ($this->isClassMemberScopeAccessible($name, $scope)) return;
		// Basically we shouldn't be able to access private scope on a public request
		throw new \Exception('Attempted to access non-existent or private class member from public scope.');
	}

	/**
	 * Sets the named property to the supplied value
	 *
	 * @param string $name Name of the property we want to set
	 * @param mixed $value The value we want to set it to
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return object $this for chaining support...
	 */
	protected function set($name, $value, $scope = self::SCOPE_ANY) {
		$this->requireTypeMatch($name, $value);
		$this->requireAccess($name, $scope);
		$member =$ $this->getClassMember($name);
		$member->value = $value;
		return $this;
	}

	/**
	 * Check whether the named property is defined
	 *
	 * @param string $name Name of the property we want to check
	 *
	 * @return boolean true if the property is defined, else false
	 */
	protected function has($name) {
		return $this->hasClassMember($name);
	}

	/**
	 * Internal property checker
	 *
	 * @param string $name Name of the property we want to check
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return boolean true if the property is set, else false
	 */
	protected function chk($name, $scope = self::SCOPE_ANY) {
		if (! $this->isClassMemberScopeAccessible($name, $scope)) return false;
		$member = $this->getClassMember($name);
		return is_null($member->value) ? false : true;
	}

	/**
	 * Get the value of the named property
	 *
	 * @param string $name Name of the property we want to get
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return mixed The value of the named property, or null if it is not set
	 */
	protected function get($name, $scope = self::SCOPE_ANY) {
		if (! $this->hasClassMember($name)) return null;
		if (! $this->isClassMemberScopeAccessible($name, $scope)) return null;
		$member = $this->getClassMember($name);
		return $member->value;
	}

	/**
	 * Delete the named property if it is defined
	 *
	 * @param string $name Name of the property we want to delete
	 * @param string $scope The visibility scope of the requester
	 *
	 * @return object $this for chaining support...
	 */
	protected function del($name, $scope = self::SCOPE_ANY) {
		$this->requireAccess($name, $scope);
		unset($this->classMembers[$name]);
		return $this;
	}
}

