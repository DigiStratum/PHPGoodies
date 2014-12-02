<?php
/**
 * PHPGoodies:Collection - Extend the capabilities of an indexed array with OOP
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Collection
 */
class Collection {

	/**
	 * The name o the class that this collection will hold
	 */
	protected $className;

	/**
	 * The collection of objects of type className that we are maintaining
	 */
	protected $collection = array();

	/**
	 * Constructor, locks in the class type for the collection
	 *
	 * Note that we want Collections to work with classes that may or may not be PHPGoodies, so
	 * we need to check for a class that exists either in the global namespace or the PHPGoodies
	 * one and capture accordingly. It seems strange, but even with "use" in the calling code to
	 * bring a PHPGoodies namespace scoped Classname into the global namespace, class_exists()
	 * method cannot see it.
	 *
	 * @param string $className the name of the class that this collection will hold
	 */
	public function __construct($className) {
		if (class_exists($className)) {
			$this->className = $className;
		}
		else if (class_exists(PHPGoodies::namespaced($className))) {
			$this->className = PHPGoodies::namespaced($className);
		}
		else {
			throw new \Exception("Attempted to create a collection of a non-existent class ('{$className}')");
		}
	}

	/**
	 * Getter for the class name
	 *
	 * Class cannot be modified post-instantiation, so there is no matching setter.
	 *
	 * @return string name of the class for this collection
	 */
	public function getClassName() {
		return $this->className;
	}

	/**
	 * Add the supplied object to the collection
	 *
	 * @param object $object An object; needs to be of type className...
	 *
	 * @return integer The index position in the collection for this object
	 */
	public function add($object) {
		$this->requireType($object);
		$num = count($this->collection);
		$this->collection[$num] = $object;
		return $num;
	}

	/**
	 * Get the object from the collection at the specified index
	 *
	 * @param integer $index The index for the desired object in the collection
	 *
	 * @return object A reference to the requested object instance, or null if it doesn't exist
	 */
	public function &get($index) {
		if (! $this->has($index)) return null;
		return $this->collection[$index];
	}

	/**
	 * Delete the object from the collection at the specified index
	 *
	 * @param integer $index The index for the desired object in the collection
	 *
	 * @return boolean true if it was there and deleted, else false
	 */
	public function del($index) {
		if (! $this->has($index)) return false;
		unset($this->collection[$index]);
		return true;
	}

	/**
	 * Check if the collection has any object at the specified index
	 *
	 * @param integer $index The index for the desired object in the collection
	 *
	 * @return boolean true if there is an object there, else false
	 */
	public function has($index) {
		return isset($this->collection[$index]);
	}

	/**
	 * Get the number of objects in the collection
	 *
	 * @return integer Count of objects in the collection array
	 */
	public function num() {
		return count($this->collection);
	}

	/**
	 * Pluck out the named value from each object in the collection
	 *
	 * $name may be either a property or method (like a getter), and must be publicly scoped in
	 * order to be able to get at the value.
	 *
	 * @param string $name Name of the public property/method that we want to pluck out
	 *
	 * @return array All the values extracted from the collection
	 */
	public function pluck($name) {
		$values = array();
		if (property_exists($this->className, $name)) {
			$this->iterate(function ($object) use (&$values, $name) {
				$values[] = $object->$name;
			});
		}
		else if (method_exists($this->className, $name)) {
			$this->iterate(function ($object) use (&$values, $name) {
				$values[] = call_user_func(array($object, $name));
			});
		}
		else {
			throw new \Exception("Attempted to pluck a non-existent property/method ('{$name}') from collection of '{$this->className}' objects");
		}
		return $values;
	}

	/**
	 * Iterate over the collection passing each object to the callback function
	 *
	 * If the callback function returns false, then iteration will stop there and return the
	 * collection index of the stopping point.
	 *
	 * @param function $callback Callback function with a single argument to receive the object
	 *
	 * @return integer collection index where we stopped, or null if entire collection iterated
	 */
	public function iterate($callback) {
		if (! is_callable($callback)) {
			throw new \Exception("Attempted to iterate with a non-callable callback; it must be a function!");
		}
		foreach ($this->collection as $index => $object) {
			$res = call_user_func($callback, $object);
			if ($res === false) return $index;
		}
	}

	/**
	 * Find the index of object in the collection with the named property == value
	 *
	 * @param string $name Name of the public property/method that we want to pluck out
	 * @param mixed $value String/number or other directly comparable data type value
	 *
	 * @return integer collection index where we found a match, or null if no match found
	 */
	public function findIndex($name, $value) {
		if (property_exists($this->className, $name)) {
			return $this->iterate(function ($object) use ($value, $name) {
				if ($value == $object->$name) return false;
			});
		}
		else if (method_exists($this->className, $name)) {
			return $this->iterate(function ($object) use ($value, $name) {
				if ($value == call_user_func(array($object, $name))) return false;
			});
		}
		else {
			throw new \Exception("Attempted to find a a value for a non-existent property/method ('{$name}') from collection of '{$this->className}' objects");
		}
	}

	/**
	 * Find the object in the collection with the named property == value
	 *
	 * @param string $name Name of the public property/method that we want to pluck out
	 * @param mixed $value String/number or other directly comparable data type value
	 *
	 * @return object Reference to the object in the collection or null
	 */
	public function &find($name, $value) {
		$index = $this->findIndex($name, $value);
		if (is_null($index)) {
			$null = null;
			return $null;
		}
		$obj =& $this->get($index);
		return $obj;
	}

	/**
	 * Does the collection have an object with named property == value?
	 *
	 * Implemented as a simple wrapper of find()
	 *
	 * @param string $name Name of the public property/method that we want to pluck out
	 * @param mixed $value String/number or other directly comparable data type value
	 *
	 * @return boolean true if there is an object with property/method with that value, else false
	 */
	public function hasWith($name, $value) {
		return is_null($this->findIndex($name, $value)) ? false : true;
	}

	/**
	 * Require the supplied object to be of the type that we were constructed with
	 *
	 * @param obejct $object Reference to an object (proably being added)
	 */
	protected function requireType(&$object) {
		if (! is_object($object)) {
			throw new \Exception("Attempted to use a non-object of type '" . gettype($object) . "' in a collection of '{$this->className}'");
		}
		if (! is_a($object, $this->className)) {
			throw new \Exception("Attempted to use an object of type '" . get_class($object) . "' in a collection of '{$this->className}'");
		}
	}
}

