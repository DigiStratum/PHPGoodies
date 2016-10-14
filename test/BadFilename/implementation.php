<?php
/**
 * PHPGoodies bad class to load for import test
 *
 * import() is expected to fail to load this class since the class name doesn't match the filename.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

class test_BadClass {

	// This should never be called
	public function __construct() { }
}

