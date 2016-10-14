<?php
/**
 * PHPGoodies abstract class to load for instantiate test
 *
 * instantiate() is expected to fail to load this class since the class is abstract (non-instantiable)
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

abstract class test_AbstractClass {

	// This should never be called
	public function __construct() { }
}

