<?php
/**
 * PHPGoodies:Obj - A class to manage a collection of object instances
 *
 * With only a single instance of this class, all the objects within its collection could be treated
 * as application-wide singletons; however multiple instances would enable multiple collections with
 * one instance of each object per.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Obj - A class to manage a collection of object instances
 */
class Obj {

	/**
	 * The collection of objects we are working with
	 */
	protected $objects = array();

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Get an instance of the specified resource identifier
	 *
	 * @param string $resource The resource identifier that we want to get an instance of
	 *
	 * @return object An instance of the requested resource identifier's class
	 */
	public function &get($resource) {
		if ($this->has($resource)) {
			return $this->objects[$resource];
		}
		$this->objects[$resource] = PHPGoodies::instantiate($resource);

		return $this->objects[$resource];
	}

	/**
	 * Destroy our instance of this resource identifier if we have it
	 *
	 * @param string $resource The resource identifier that we want to destroy
	 */
	public function destroy($resource) {
		if ($this->has($resource)) {
			unset($this->objects[$resource]);
		}
	}

	/**
	 * Check whether we have an instance of the specified resource identifier
	 *
	 * @param string $resource The resource identifier that we want to check
	 *
	 * @return boolen true if we have an instance, else false
	 */
	public function has($resource) {
		return isset($this->objects[$resource]);
	}
}

