<?php
/**
 * PHPGoodies:Object - A general purpose object class with some shortcuts
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Obj - A general purpose object class with some shortcuts
 */
class Object {

	/**
	 * Sets the named property to the supplied value
	 *
	 * @param string $name Name of the property we want to set
	 * @param mixed $value The value we want to set it to
	 *
	 * @return object $this for chaining support...
	 */
	public function set($name, $value) {
		$this->$name = $value;
		return $this;
	}

	/**
	 * Check whether the named property is defined
	 *
	 * @param string $name Name of the property we want to check
	 *
	 * @return boolean true if the property is defined, else false
	 */
	public function has($name) {
		return property_exists($this, $name);
	}

	/**
	 * Get the value of the named property
	 *
	 * @param string $name Name of the property we want to get
	 *
	 * @return mixed The value of the named property, or null if it is not set
	 */
	public function get($name) {
		if ($this->has($name)) {
			return $this->$name;
		}
		return null;
	}

	/**
	 * Delete the named property if it is defined
	 *
	 * @param string $name Name of the property we want to delete
	 *
	 * @return object $this for chaining support...
	 */
	public function del($name) {
		if ($this->has($name)) {
			unset($this->$name);
		}
		return $this;
	}
}

