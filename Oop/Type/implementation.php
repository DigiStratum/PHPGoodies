<?php
/**
 * PHPGoodies:Oop_Type - An assortment of utility methods to help us with data types
 *
 * @uses Oop_Exception_TypeMismatch
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Exception.TypeMismatch');


/**
 * An assortment of utility methods to help us with data types
 */ 
abstract class Oop_Type {

	/**
	 * Get the 'type' for the supplied object
	 *
	 * Our types expand on the PHP primitives by combining objects with their class names if
	 * they are anything more specific than 'StdClass'
	 *
	 * @param mixed $data Some data/callable entity that we want a type for
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @return string the type of the object that we will use internally
	 */
	public static function getType(&$data, $ignoreNamespace = true) {

		// Get the native type; strtolower makes 'NULL' into 'null'
		$type = strtolower(gettype($data));

		if ('object' !== $type) return $type;

		// Nope, must be a regular object class
		$class = get_class($data);

		// Functions are class "Closure"
		if ('Closure' == $class) return 'function';

		// Is it a standard class (unnamed)? 
		if ('stdClass' == $class) return 'object';

		// Anything else is a normal class; if it is namespaced...
		if ($ignoreNamespace && strpos($class, '\\')) {
			// Remove the namespace and just get the class name
			$class = substr($class, strrpos($class, '\\') + 1);
		}

		return "class:{$class}";
	}

	/**
	 * Is the supplied data of the specified type?
	 *
	 * Note, classnames must be specified as "class:{classname}" for the data type.
	 *
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @return boolean true if the data's type matches the specified type, else false
	 */
	public static function isType(&$data, $type, $ignoreNamespace = true) {

		// If the data is the exact type, then we're good...
		$res = (static::getType($data, $ignoreNamespace) == $type);
		if ($res) return true;

		// But we might also have an "is a" situation via inheritance, so...
		if (strpos($type, ':') === false) return false;
		$classinfo = explode(':', $type);
		$class = $classinfo[1];
		$res = $data instanceof $class;
		if ($res) return true;

		// Ok, last chance: maybe it's in our namespace instead of the global one...
		$class = "PHPGoodies\\{$class}";
		return $data instanceof $class;
	}

	/**
	 * Throws an exception if the supplied data does NOT match the specified type
	 *
	 * Note, classnames must be specified as "class:{classname}" for the data type.
	 *
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @return mixed $data, whatever it was, if the type check passes
	 *
	 * @throws Oop_Exception_TypeMismatch if the type does not match
	 */
	public static function requireType(&$data, $type, $ignoreNamespace = true) {
		if (static::isType($data, $type, $ignoreNamespace)) return $data;
		throw new Oop_Exception_TypeMismatch("Expected '$type', but got '" . static::getType($data, $ignoreNamespace) . "'");
	}

	/**
	 * Throws an exception if the supplied data is not null AND does not match specified type
	 *
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @return mixed $data, whatever it was, if the type check passes
	 *
	 * @throws Oop_Exception_TypeMismatch if the type does not match
	 */
	public static function optionalType(&$data, $type, $ignoreNamespace = true) {
		return (is_null($data)) ? null : static::requireType($data, $type, $ignoreNamespace);
	}
}

