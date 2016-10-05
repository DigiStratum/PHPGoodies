<?php
/**
 * PHPGoodies:GenericDto - A generic DTO implementation
 *
 * Publicly exposes most, but not all, of the protected Dto class methods with the same naming and
 * arguments except that the underscore prefix is dropped from the public facing names. Does NOT
 * expose the protected data properties publicly. In this way we can programmatically defined a
 * DTO that is usable on-the-fly without having to necessarily create a reusable class definition.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Dto');

/**
 * Generic DTO implementation
 */
class GenericDto extends Dto {

	/**
	 * Constructor mirrors that of DTO
	 *
	 * @param $propertyNames Array of strings that define valid property names for this DTO
	 */
	public function __construct($properties = array()) {
		parent::__construct();
	}

	/**
	 * Macro setter for declaring the properties and their values in one shot
	 *
	 * @param array $properties Associative array of name=value purperty pairs
	 */
	public function setProperties($properties = array()) {
		if (! is_array($properties)) return;
		$this->setPropertyNames(array_keys($properties));
		foreach ($properties as $name => $value) {
			$this->set($name, $value);
		}
	}

	/**
	 * Expose setter for property names
	 *
	 * @param $propertyNames Array of strings that define valid property names for this DTO
	 */
	public function setPropertyNames($propertyNames = array()) {
		$this->_setPropertyNames($propertyNames);
	}

	/**
	 * Get the names of all the currently defined properties
	 *
	 * @return array of strings for all the currently defined properties; may be empty
	 */
	public function definedProperties() {
		return $this->_definedProperties();
	}

	/**
	 * Expose the property setter
	 *
	 * @param string $name The name of the property to be set
	 * @param mixed $value The value of the property to be set
	 * 
	 * @return string The propertyName that was actually used to identify the property, same as
	 * $name unless there was a problem with it.
	 */
	public function set($name, $value) {
		return $this->_set($name, $value);
	}

	/**
	 * Expose the property getter
	 *
	 * @param string $name The name of the property to be returned
	 *
	 * @return mixed Returns whatever value was previously set for the named property
	 */
	public function get($name) {
		return $this->_get($name);
	}
        /**
	 * Expose the proeprty checker
	 *
	 * @param string $name The name of the property to be checked
	 *
	 * @return boolean true if the named property is set, else false
	 */
	public function chk($name) {
		return $this->_chk($name);
	}

	/**
	 * Expose the property deleter
	 *
	 * @param string $name The name of the property to be returned
	 */
	public function del($name) {
		return $this->_del($name);
	}
}

