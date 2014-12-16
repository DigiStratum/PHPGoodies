<?php
/**
 * PHPGoodies:ObjectNamed - An object class with named properties
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Oop.Object');

/**
 * ObjectNamed - An object class with named properties
 */
class ObjectNamed extends Object {

	/**
	 * The property names that we will allow to be accessed
	 */
	protected $propertyNames = array();

	/**
	 * Constructor
	 *
	 * @param array $properties The set of property names we will allow
	 */
	public function __construct($properties = array()) {
		if (! is_array($properties)) {
			throw new \Exception('Supplied properties must be an array - ' . gettype($properties) . ' provided.');
		}
		foreach ($properties as $name) {
			if (! $this->isLegalName($name)) {
				throw new \Exception('Illegal property name specified');
			}
		}
		$this->propertyNames = array_values($properties);
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
	 * Check whether the specified property name is a valid one
	 *
	 * @param string $name The name of a property we want to check
	 *
	 * @return boolean true if the property name is valid, else false
	 */
	protected function isValidProperty($name) {
		return in_array($name, $this->propertyNames);
	}

	/**
	 * Sets the named property to the supplied value
	 *
	 * @param string $name Name of the property we want to set
	 * @param mixed $value The value we want to set it to
	 *
	 * @return object $this for chaining support...
	 */
	public function set($name, $value) {
		if (! $this->isValidProperty($name)) {
			throw new \Exception("Attempted to set undefined property name: '{$name}'");
		}
		return parent::set($name, $value);
	}

	/**
	 * Check whether the named property is defined
	 *
	 * @param string $name Name of the property we want to check
	 *
	 * @return boolean true if the property is defined, else false
	 */
	public function has($name) {
		if (! $this->isValidProperty($name)) {
			throw new \Exception("Attempted to check undefined property name: '{$name}'");
		}
		return parent::has($name);
	}

	/**
	 * Get the value of the named property
	 *
	 * @param string $name Name of the property we want to get
	 *
	 * @return mixed The value of the named property, or null if it is not set
	 */
	public function get($name) {
		if (! $this->isValidProperty($name)) {
			throw new \Exception("Attempted to get undefined property name: '{$name}'");
		}
		return parent::get($name);
	}

	/**
	 * Delete the named property if it is defined
	 *
	 * @param string $name Name of the property we want to delete
	 *
	 * @return object $this for chaining support...
	 */
	public function del($name) {
		if (! $this->isValidProperty($name)) {
			throw new \Exception("Attempted to delete undefined property name: '{$name}'");
		}
		return parent::del($name);
	}
}

