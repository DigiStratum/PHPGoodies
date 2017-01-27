<?php
/**
 * PHPGoodies:Lib_Data_Collection_Keyed - Extend the capabilities of Collection class with unique indexes
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Collection.Keyed.Item');

/**
 * Collection with unique indexes
 */
class Lib_Data_Collection_Keyed extends Lib_Data_Collection {

	/**
	 * Indexes of keyed objects in the collection
	 */
	protected $indexes;

	/**
	 * Constructor
	 *
	 * @param $className the name of the class that this collection will hold
	 */
	public function __construct($className) {
		$this->indexes = Array();
		parent::__construct($className);
	}

	/**
	 * Add an object to the collection with the supplied unique key
	 *
	 * @param object $object An object implementing Keyed_Item; needs to be of type className...
	 *
	 * @return integer The index position in the collection for this object
	 *
	 * @throws Exception if there is already an object with the specified key
	 */
	public function add(Lib_Data_Collection_Keyed_Item $object) {
		$key = $object->getKey();
		if (isset($this->indexes[$key])) {
			throw new \Exception("Cannot add object to collection as key '{$key}' already exists inside");
		}
		$index = parent::add($object);
		$this->indexes[$key] = $index;
		return $index;
	}

	/**
	 * Check if our collection has an object with the supplied key
	 *
	 * @param string $key Unique key to identify this object within the collection
	 *
	 * @return boolean true if the collection has an object with this key, else false
	 */
	public function has($key) {
		return isset($this->indexes[$key]);
	}

	/**
	 * Replace the object with the supplied key with the supplied object
	 *
	 * @param object $object An object implementing Keyed_Item; needs to be of type className...
	 *
	 * @return object $this for chaining...
	 *
	 * @throws Exception if there is no such key in the collection, or if the object is the wrong type
	 */
	public function replace(Lib_Data_Collection_Keyed_Item $object) {
		$key = $object->getKey();
		if (! $this->has($key)) {
			throw new \Exception("Key '{$key}' is not in the collection");
		}
		$index = $this->indexes[$key];;
		$this->set($index, $object);
		return $this;
	}

	/**
	 * Deletes an object from the collection with the matching key
	 *
	 * @param string $key Unique key to identify this object within the collection
	 *
	 * @return object $this for chaining...
	 *
	 * @throws Exception if there is no such key in the collection
	 */
	public function del($key) {
		if (! $this->has($key)) {
			throw new \Exception("Key '{$key}' is not in the collection");
		}
		$index = $this->indexes[$key];;
		parent::del($index);
		return $this;
	}
}

