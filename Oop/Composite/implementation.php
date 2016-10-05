<?php
/**
 * PHPGoodies:Composite - Merge the public properties of multiple objects into one, big object
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Composite - Merge the properties of multiple objects into one, big object
 *
 * ref: http://stackoverflow.com/questions/455700/what-is-the-best-method-to-merge-two-php-objects
 * ref: http://php.net/manual/en/language.oop5.magic.php
 *
 * Note that we don't support static calls since we don't have any properties until instantiated...
 * 
 * If two objects added to the collection have properties or methods with the same name, the object
 * added to the collection FIRST will take precedence.
 *
 * Since this class has an addObject method, it will not be possible to access a method by the same
 * name on an object added to the collection.
 */
class Composite {

	protected $cache;
	protected $objects;

	/**
	 * Constructor
	 *
	 * @param array $objects Optional array of objects/instances to add from the get-go
	 */
	public function __construct($objects = Array()) {
		$this->objects = Array();
		foreach ($objects as $object) {
			$this->addObject($object);
		}
		$cache = Array(
			'properties' => array(),
			'methods' => array()
		);
	}

	/**
	 * Add an object to the collection
	 *
	 * @param object $obj An object instance to add to the collection
	 *
	 * @return object $this for chaining...
	 *
	 * @throws Exception if what was supplied was not an object after all (including null)
	 */
	public function addObject($obj) {
		if (gettype($obj) != 'object') {
			throw new Exception('Attempted to add a non-object to Composite');
		}
		$this->objects[] = $obj;
		return $this;
	}

	/**
	 * Magic method to get the value of the named property
	 *
	 * We will iterate over all the objects in the collection until we find one with the name we
	 * want. If no objects in the collection have a property with this name, we return null. We
	 * cache the location of the property in case it is requested again.
	 *
	 * @param string $name The name of the property we want
	 *
	 * @return mixed Whatever value the property holds will be returned
	 */
	public function __get($name) {

		// If we have not looked for this name previously, we'll
		// have to find (and cache) the associated object index
		if (! isset($this->cache['properties'][$name])) {
			foreach ($this->objects as $index => $object) {
				if (property_exists($object, $name)) {
					$this->cache['properties'][$name] = $index;
					break;
				}
			}
		}
		// If it's still not cached then it doesn't exist
		if (! isset($this->cache['properties'][$name])) return null;

		$objIndex = $this->cache['properties'][$name];
		return $this->objects[$objIndex]->$name;
	}

	/**
	 * Magic method to set the named property to the supplied value
	 *
	 * We will iterate over all the objects in the collection until we find one with the name we
	 * want. If no objects in the collection have a property with this name, we give up. We
	 * cache the location of the property in case it is requested again.
	 *
	 * @param string $name The name of the property we want
	 * @param mixed $value Any value to set on the property
	 */
	public function __set($name, $value) {

		// If we have not looked for this name previously, we'll
		// have to find (and cache) the associated object index
		if (! isset($this->cache['properties'][$name])) {
			foreach ($this->objects as $index => $object) {
				if (property_exists($object, $name)) {
					$this->cache['properties'][$name] = $index;
					break;
				}
			}
		}
		// If it's still not cached then it doesn't exist
		if (! isset($this->cache['properties'][$name])) return;

		$objIndex = $this->cache['properties'][$name];
		$this->objects[$objIndex]->$name = $value;
	}

	/**
	 * Magic method to check whether the named property is set (exists, and non-null)
	 *
	 * We will iterate over all the objects in the collection until we find one with the name we
	 * want. If no objects in the collection have a property with this name, we return false. We
	 * cache the location of the property in case it is requested again.
	 *
	 * @param string $name The name of the property we want
	 *
	 * @return boolean true if the property is set (somewhere), else false
	 */
	public function __isset($name) {

		// If we have not looked for this name previously, we'll
		// have to find (and cache) the associated object index
		if (! isset($this->cache['properties'][$name])) {
			foreach ($this->objects as $index => $object) {
				if (property_exists($object, $name)) {
					$this->cache['properties'][$name] = $index;
					break;
				}
			}
		}
		// If it's still not cached then it doesn't exist
		if (! isset($this->cache['properties'][$name])) return false;

		$objIndex = $this->cache['properties'][$name];
		return isset($this->objects[$objIndex]->$name);
	}

	/**
	 * Magic method to unset the named property
	 *
	 * We will iterate over all the objects in the collection until we find one with the name we
	 * want. If no objects in the collection have a property with this name, we give up. We
	 * cache the location of the property in case it is requested again.
	 *
	 * @param string $name The name of the property we want
	 */
	public function __unset($name) {

		// If we have not looked for this name previously, we'll
		// have to find (and cache) the associated object index
		if (! isset($this->cache['properties'][$name])) {
			foreach ($this->objects as $index => $object) {
				if (property_exists($object, $name)) {
					$this->cache['properties'][$name] = $index;
					break;
				}
			}
		}
		// If it's still not cached then it doesn't exist
		if (! isset($this->cache['properties'][$name])) return;

		$objIndex = $this->cache['properties'][$name];
		unset($this->objects[$objIndex]->$name);
	}

	/**
	 * Magic method to call the named method with the supplied arguments
	 *
	 * We will iterate over all the objects in the collection until we find one with the name we
	 * want. If no objects in the collection have a property with this name, we return null. We
	 * cache the location of the property in case it is requested again.
	 *
	 * @param string $name The name of the method we want
	 * @param array $args Optional array of mixed argument types to pass to the method call
	 *
	 * @return mixed Whatever the method is coded to return will be returned unmodified
	 */
	public function __call($name, $args = array()) {

		// If we have not looked for this name previously, we'll
		// have to find (and cache) the associated object index
		if (! isset($this->cache['methods'][$name])) {
			foreach ($this->objects as $index => $object) {
				if (method_exists($object, $name)) {
					$this->cache['methods'][$name] = $index;
					break;
				}
			}
		}
		// If it's still not cached then it doesn't exist
		if (! isset($this->cache['methods'][$name])) return null;

		$objIndex = $this->cache['methods'][$name];
		return call_user_func_array(array($this->objects[$objIndex], $name), $args);
	}

	/**
	 * Magic method to convert the entire thing to a string
	 *
	 * @todo Implement this; maybe an array of strings from each object and then serialize that??
	 */
	public function __toString() {
		return '';
	}
}

