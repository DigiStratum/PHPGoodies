<?php
/**
 * PHPGoodies:PHPGoodies
 *
 * Many of the PHPGoodies class implementations stand alone, however some of the more complex
 * implementations have external dependencies within the PHPGoodies family of code. The supporting
 * code found here provide a streamlined mechanism for accessing those dependencies.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

use ReflectionClass;

/**
 * PHPGoodies support code
 */
abstract class PHPGoodies {

	/**
	 * Get the base directory for all PHPGoodies
	 *
	 * @return string Directory that all PHPGoodies are relative to
	 */
	public static function baseDirectory() {
		return dirname(__FILE__);
	}

	/**
	 * Import the specified class/interface/trait resource definition with dotted notation
	 *
	 * This import implementation mimics Java's implementation by relativizing the path where classes
	 * can be loaded from, and enforcing the class name matching the filename.
	 *
	 * @todo - add support for an equivalent to CLASSPATH where import will attempt to do so from any
	 * directory specified in CLASSPATH and in the order provided.
	 *
	 * @param string $resource The dotted notation resource identifier to import
	 *
	 * @throws Exception
	 */
	public static function import($resource) {

		// Convert any slashes to dots then all slashes back to dots; prevents
		// users from putting slash into import() calls as if its a raw path
		$resourceName = str_replace(DIRECTORY_SEPARATOR, '.', $resource);
		$resourceparts = explode('.', $resourceName);

		// If no class parts, class missing
		$numParts = count($resourceparts);
		if ($numParts == 0) {
			throw new \Exception('Resource name cannot be empty');
		}

		// If expected fully qualified name has already been imported, no-op.
		$name = $resourceparts[$numParts - 1];
		if (static::isImported($name)) return;

		// Expected implementation will be located relative to this location
		$path = dirname(__FILE__) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $resourceparts) . '.php';

		// If resultant path invalid, class missing
		if (! @file_exists($path)) {
			throw new \Exception("Could not import implementation for '{$resource}'; not found at [{$path}]");
		}

		@require_once($path);

		// If expected name undefined after loading, class missing
		if (! static::isImported($name)) {
			throw new \Exception("Could not import implementation for '{$resource}'");
		}
	}

	/**
	 * Determine whether a class, interface, or trait with the specified name is already imported
	 *
	 * @todo Use newer NAMESPACE::CLASSNAME supported in PHP5.5+
	 *
	 * @param string $name PHP native string name to look for
	 *
	 * @return boolean true if the name is defined as a class, interface, or trace, else false
	 */
	public static function isImported($name) {
		$nsName = static::namespaced($name);
		return (class_exists($nsName) || interface_exists($nsName) || trait_exists($nsName));
	}

	/**
	 * Get the namespaced version of the specified name
	 *
	 * @param string $name PHP native string name to look for
	 *
	 * @return string The PHPGoodies namespaced name
	 */
	public static function namespaced($name) {
		return __NAMESPACE__ . '\\' . $name;
	}

	/**
	 * Factory method to get an instance of the named resource (class)
	 *
	 * Automatically imports the resource if it hasn't been already. This method is useful to
	 * make a single line of code out of your typical import/new() two-line operations.
	 *
	 * @param string $resource The dotted notation resource identifier to import
	 * @param ... Variable arguments follow to be passed to the resource class' constructor
	 *
	 * @return object Instance of the requested resource if all went well
	 */
	public static function instantiate($resource) {

		// Always try to import first
		static::import($resource);

		// Figure out the classname
		$resourceParts = explode('.', $resource);
		$className = $resourceParts[count($resourceParts) - 1];
		$nsClassName = static::namespaced($className);

		// Get the variable argument list ...
		$args = func_get_args();
		// ... less the first which is the resource identifier
		array_shift($args);

		// Reflect so that we can pass args
		// ref: http://stackoverflow.com/questions/2640208/call-a-constructor-from-variable-arguments-with-php
		$reflectedClass = new ReflectionClass($nsClassName);
		return $reflectedClass->newInstanceArgs($args);
	}
}

