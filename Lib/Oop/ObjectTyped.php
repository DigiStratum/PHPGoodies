<?php
/**
 * PHPGoodies:ObjectTyped - An object class with named properties with type enforcement
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Oop.ObjectNamed');

/**
 * ObjectTyped - An object class with named properties with type enforcement
 */
class ObjectTyped extends ObjectNamed {

	/**
	 * The property types that we will enforce on set()
	 */
	protected $propertyTypes = array();

	/**
	 * Constructor
	 *
	 * @param array $properties The set of property types that we will enforce
	 */
	public function __construct($properties = array()) {
		if (! is_array($properties)) {
			throw new \Exception('Supplied properties must be an array - ' . gettype($properties) . ' provided.');
		}

		// Collect the property names for our parent
		parent::__construct(array_keys($properties));

		// Verify out and capture all the property types
		foreach ($properties as $name => $type) {
			if (! $this->isKnownType($type)) {
				throw new \Exception('Unknown type specified');
			}
			$this->propertyTypes[$name] = $type;
		}
	}

	/**
	 * Check whether the specified type name is a known one
	 *
	 * @param string $type The type name we want to check out
	 *
	 * @return boolean true if it is known (and therefore ok to use), else false
	 */
	protected function isKnownType($type) {
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
					// TODO: check that the class name is a legal one
					$name = $matches[1];
					return true;
				}
		}
		return false;
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

		// First make sure we're dealing with something we know about
		if (! $this->isValidProperty($name)) {
			throw new \Exception('Attempted to set unknown property');
		}

		// Require value's type to match unless it's null which is always ok
		if (! is_null($value)) {
			$type = gettype($value);
			if ($type == 'object') {
				if ($this->propertyTypes[$name] != 'object') {
					$class = get_class($value);
					if ($this->propertyTypes[$name] != "class:{$class}") {
						throw new \Exception("Type mismatch attempting to set property '{$name}' to class '{$class}'");
					}
				}
			}
			else if ($this->propertyTypes[$name] != $type) {
				throw new \Exception("Type mismatch attempting to set property '{$name}' to type '{$type}'");
			}
		}

		return parent::set($name, $value);
	}

	/**
	 * Magic property setter
	 *
	 * This magic function is used whenever there is any attempt to directly assign a property
	 * to the object. This logic forces any such attempt to be moderated by our set() method.
	 *
	 * @param string $name Name of the property we want to set
	 * @param mixed $value The value we want to set it to
	 *
	 * @return object $this for chaining support...
	 */
	public function __set($name, $value) {
		return $this->set($name, $value);
	}
}

