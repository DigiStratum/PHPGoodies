<?php
/**
 * PHPGoodies:Oop_Type - An assortment of utility methods to help us with data types
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;



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
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @return boolean true if the data's type matches the specified type, else false
	 */
	public static function isType(&$data, $type, $ignoreNamespace = true) {
		return (static::getType($data, $ignoreNamespace) == $type);
	}

	/**
	 * Throws an exception if the supplied data does NOT match the specified type
	 *
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @throws Oop_Exception_TypeMismatch if the type does not match
	 */
	public static function requireType(&$data, $type, $ignoreNamespace = true) {
		if (static::isType($data, $type, $ignoreNamespace)) return;
		throw new Oop_Exception_TypeMismatch("Expected '$type', but got '" . static::getType($data, $ignoreNamespace) . "'");
	}

	/**
	 * Throws an exception if the supplied data is not null AND does not match specified type
	 *
	 * @param mixed $data Any PHP data we want to check the type of
	 * @param string $type Descriptor of a valid type including a class name
	 * @param boolean $ignoreNamespace Defaults to true to remove the namespace from class names
	 *
	 * @throws Oop_Exception_TypeMismatch if the type does not match
	 */
	public static function optionalType(&$data, $type, $ignoreNamespace = true) {
		if (is_null($data)) return;
		static::requireType($data, $type, $ignoreNamespace);
	}
}

