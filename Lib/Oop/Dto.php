<?php
/**
 * PHPGoodies:Dto - Data Transfer Object class
 *
 * Standardizes the way that we prepare API responses
 *
 * The point here is that it will allow us to make global changes to the response structure across
 * the entire application with a single change here instead of having to touch everything that
 * formulates its own response in a custom way.
 *
 * Note that the properties are handled as an associative array because it seemed natural/easy at
 * the time that it was implemented. This could be refactored to use a generic object instead, but
 * pretty much the entire class here will need to change to accommodate that, and it is unclear that
 * there will be much, if any, tangible benefit other than to simplify the to/fromJson methods since
 * the properties iwll already be in object form.
 *
 * Also note that property names is currently implemented as a simple array of name strings; the
 * thinking for the future of this is to change the names to be the keys and the value would be a
 * simple data structure that describes the nature of the property (expected type, any validation or
 * other rules for setting/getting it, etc.) to make the properties "smart" and enable validation
 * of data as it is being set, or all at once in a single call. The individual properties may have
 * separate validation from the entire Dto which may have its own (such as having a business
 * requirement that if propertyA is set, propertyB must be too, otherwise neither must be set, etc.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Data Transfer Object class
 */
abstract class Dto {

	/**
	 * Associative array that will hold the name/value pairs for the response properties
	 */
	private $properties;

	/**
	 * Keys that define valid property names; anything goes if this is an empty set
	 */
	private $propertyNames;

	/**
	 * Default constructor
	 *
	 * @param $propertyNames Array of strings that define valid property names for this DTO
	 */
	public function __construct($propertyNames = array()) {
		$this->_setPropertyNames($propertyNames);
	}

	/**
	 * Empty out all the properties to start fresh
	 */
	protected function _reset() {
		$this->properties = array();
	}

	/**
	 * Set the property names for this Dto
	 *
	 * Note: this also destructively resets the Dto's properties, so must be done early on.
	 *
	 * @param $propertyNames Array of strings that define valid property names for this DTO
	 */
	protected function _setPropertyNames($propertyNames = array()) {

		if (! is_array($propertyNames)) {
			throw new Exception("Property Names must be supplied as an array of strings; " . gettype($propertyNames) . " was supplied instead.");
		}

		// Reset everything and then fill up the property names...
		$this->_reset();
		$this->propertyNames = array();
		foreach ($propertyNames as $name) {
			$this->_addProperty($name);
		}
	}

	/**
	 * Add a property to the set of valid property names
	 *
	 * @param string $name The name of the property we want to add
	 *
	 * @return boolean true on success, else false
	 */
	protected function _addProperty($name) {
		$propertyName = $this->_clean($name);
		if (! strlen($propertyName)) return false;
		$this->propertyNames[] = $propertyName;
		return true;
	}

	/**
	 * Convert the properties of this Dto into JSON
	 *
	 * @return string with JSON representation of our properties
	 */
	protected function _toJson() {
		return json_encode((object) $this->properties);
	}

	/**
	 * Fill the properties of this Dto from the supplied JSON
	 *
	 * @param string $json The JSON text string to use as our data source
	 */
	protected function _fromJson($json) {

		// Clear out the existing properties, if any
		$this->reset();

		// Turn the JSON into a PHP data structure
		$obj = json_decode($json);
		if (! is_object($obj)) return;

		// Capture the properties of the object
		foreach ($obj as $name => $value) {
			$this->_set($name, $value);
		}
	}

	/**
	 * Set the named property to the specified value
	 *
	 * Note that the $value will most commonly/simply be another string or integer value, but
	 * it would be possible to set it to, for example, another object or array which the JSON
	 * encoder will nest below the top level response object. This more advanced usage would
	 * need to be handled carefully, and some consideration should be given to making a more
	 * advanced interface for this class to allow Responses to be nested within each other so
	 * that it will know when or when not to automatically embellish the top-level or child
	 * responses, etc. empty names are not allowable.
	 *
	 * @param string $name The name of the property to be set
	 * @param mixed $value The value of the property to be set
	 *
	 * @return string The propertyName that was actually used to identify the property, same as
	 * $name unless there was a problem with it.
	 *
	 * @throws Exception for empty names
	 */
	protected function  _set($name, $value) {
		$propertyName = $this->_clean($name);
		if (! strlen($propertyName)) {
			throw new Exception("Attempted to set a property with no name to value: [{$value}]");
		}

		if (! $this->_valid($propertyName)) {
			throw new Exception("Attempted to set a property with an invalid name ('{$propertyName}') to value: [{$value}]");
		}

		$this->properties[$propertyName] = $value;

		return $propertyName;
	}

	/**
	 * Get the currently set value for the named property.
	 *
	 * @param string $name The name of the property to be returned
	 *
	 * @return mixed Returns whatever value was previously set for the named property
	 *
	 * @throws Exception for undefined properties
	 */
	protected function  _get($name) {
		if (! $this->_chk($name)) {
			throw new Exception("Requested property ({$name}) is undefined");
		}
		return $this->properties[$name];
	}

	/**
	 * Check whether the named property is defined
	 *
	 * @param string $name The name of the property to be returned
	 *
	 * @return boolean true if the named property is set, else false
	 */
	protected function  _chk($name) {
		return isset($this->properties[$name]);
	}

	/**
	 * Determine whether the specified name is valid for this DTO instance
	 *
	 * This method constrains the selection of property names to those specified at the time of
	 * construction. If none were supplied to the constructor then there are no limitations for
	 * non-empty strings. If they name provided is in the set of valid ones, then we're good,
	 * otherwise not!
	 *
	 * @param string $name The property name to be checked for validity
	 *
	 * @return boolean true if the name is valid for properties, else false
	 */
	protected function  _valid($name) {
		$propertyName = $this->_clean($name);
		if (! strlen($propertyName)) return false;

		if (0 == count($this->propertyNames)) return true;

		if (in_array($propertyName, $this->propertyNames)) return true;

		return false;
	}

	/**
	 * Clean up the supplied name to make it suitable for use as a property name
	 *
	 * Note: we do not check for an empty result here; this is so the method may be used by a
	 * variety of callers, some of which may or may not want to throw an exception depending on
	 * the application.
	 *
	 * @param string $name The property name to be cleaned
	 *
	 * @return string Cleaned name, may be empty, not guaranteed to be valid()
	 */
	protected function  _clean($name) {
		return trim((string) $name);
	}

	/**
	 * Delete the named property
	 *
	 * Note that the property will no longer be defined after deletion. Any objects derived from
	 * the properties of this response which are held externally to this class as a result of
	 * prior calls to obj() will not be affected - if they had the named property defined,
	 * deleting it here will NOT cause the property to be deleted from them as well.
	 *
	 * @param string $name The name of the property to be returned
	 *
	 * @throws Exception for undefined properties
	 */
	protected function  _del($name) {
		if (! $this->_chk($name)) {
			throw new Exception("Requested property ({$name}) is undefined");
		}
		unset($this->properties[$name]);
	}

	/**
	 * Get the names of all the currently defined properties
	 *
	 * @return array of strings for all the currently defined properties; may be empty
	 */
	protected function  _definedProperties() {
		return array_keys($this->properties);
	}
}

