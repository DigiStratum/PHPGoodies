<?php
/**
 * PHPGoodies good class to load for import test
 *
 * import()/instantiate() are expected to successfully load/instantiate this class successfully
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

class test_GoodClass {
	public $arg;

	public function __construct($arg = null) {
		$this->arg = $arg;
	}
}

