<?php
/**
 * PHPGoodies:Oop_Application - An application class interface to help get things running under OOP
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * An application class interface to help get things running under OOP
 */
interface Oop_Application {

	/**
	 * Main application entry point
	 *
	 * @return integer Application's exit code (0 for non-error)
	 */
	public function main();
}

