<?php
/**
 * PHPGoodies:ApplicationIfc - An application class interface to help get things running under OOP
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * An application class interface to help get things running under OOP
 */
interface  ApplicationIfc {

	/**
	 * Main application entry point
	 *
	 * @return integer Application's exit code (0 for non-error)
	 */
	public function main();
}

