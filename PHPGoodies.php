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
	 * This import implementation mimics Java's implementation by relativizing the path where
	 * classes can be loaded from, and enforcing the class name matching the filename.
	 *
	 * @todo - add support for an equivalent to CLASSPATH where import will attempt to do so
	 * from any directory specified in CLASSPATH and in the order provided.
	 *
	 * @param string $resource The dotted notation resource specifier to import
	 *
	 * @throws Exception
	 */
	public static function import($resource) {

		$resourceInfo = static::resourceInfo($resource);

		// If resultant path invalid, class missing
		if (! @file_exists($resourceInfo->path)) {
			$msg = "Could not import implementation for '{$resource}'; not found at [{$resourceInfo->path}]; checked [";
			$msg .= print_r($resourceInfo->checked, true) . "]";
			throw new \Exception($msg);
		}

		if (! (@include_once $resourceInfo->path)) {
			$msg = "Could not import implementation for '{$resource}'; include failed for [{$resourceInfo->path}]";
			throw new \Exception($msg);
		}

		// If expected name undefined after loading, class missing
		if (! static::isImported($resourceInfo->name)) {
			$msg = "Could not import implementation for '{$resource}'";
			throw new \Exception($msg);
		}
	}

	/**
	 * Get some information about the named resource identifier
	 *
	 * @param string $resource The dotted notation resource specifier to import
	 *
	 * @return object StdClass object with name & path properties populated if possible
	 */
	public static function resourceInfo($resource) {
		$resourceInfo = new \StdClass();
		$resourceInfo->name = null;
		$resourceInfo->path = null;
		$resourceInfo->checked = Array();

		// Convert any slashes to dots then all slashes back to dots; prevents
		// users from putting slash into import() calls as if its a raw path
		$resourceName = str_replace(DIRECTORY_SEPARATOR, '.', $resource);
		$resourceparts = explode('.', $resourceName);

		// If no class parts, class missing
		$numParts = count($resourceparts);
		if ($numParts == 0) return $resourceInfo;

		// If expected fully qualified name has already been imported, no-op.
		$resourceInfo->name = $resourceparts[$numParts - 1];

		// Expected implementation will be located relative to this location
		$path = dirname(__FILE__) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $resourceparts);

		// If resultant path exists and is a directory, look for the
		// implementation or interface inside there (directory load model)
		if (@file_exists($path) && @is_dir($path)) {
			$possibilities = Array('implementation.php', 'interface.php');
			foreach ($possibilities as $possibility) {
				$tpath = $path . $possibility;
				$resourceInfo->checked[] = $tpath;
				if (@file_exists($tpath) && @is_file($tpath)) {
					$resourceInfo->path = $tpath;
					break;
				}
			}
		}

		// If resultant path exists and is a file, capture it
		else {
			// Everything here gets a PHP file extension!
			$path .= '.php';
			$resourceInfo->checked[] = $path;
			if (@file_exists($path) && @is_file($path)) $resourceInfo->path = $path;
		}

		return $resourceInfo;
	}

	/**
	 * Determine whether a class, interface, or trait with the specified name is already imported
	 *
	 * @todo Use newer NAMESPACE::CLASSNAME supported in PHP5.5+
	 *
	 * @param string $name PHP native string name to look for
	 * @param boolean $requireClass set to true to require the name to be a class (and not an
	 * interface or trait)
	 *
	 * @return boolean true if the name is defined as a class, interface, or trace, else false
	 */
	public static function isImported($name, $requireClass = false) {
		$nsName = static::namespaced($name);
		return (
			class_exists($nsName) ||
			(! $requireClass && (interface_exists($nsName) || trait_exists($nsName)))
		);
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
	 * Simple helper to snag just the class name off the end of a resource specifier
	 *
	 * @param string $resource The dotted notation resource specifier to import
	 *
	 * @return string Just the last segment, or null if it ends up being nothing
	 */
	public static function specifierClassName($resource) {
		$resourceParts = explode('.', $resource);
		if (count($resourceParts) == 0) return null;
		$lastPart = trim($resourceParts[count($resourceParts) - 1]);
		return strlen($lastPart) > 0 ? $lastPart : null;
	}

	/**
	 * Factory method to get an instance of the named resource (class)
	 *
	 * Automatically imports the resource if it hasn't been already. This method is useful to
	 * make a single line of code out of your typical import/new() two-line operations.
	 *
	 * @param string $resource The dotted notation resource specifier to import
	 * @param ... Variable arguments follow to be passed to the resource class' constructor
	 *
	 * @return object Instance of the requested resource if all went well
	 */
	public static function instantiate($resource) {

		// Always try to import first
		static::import($resource);

		// Figure out the classname
		$className = static::specifierClassName($resource);
		if (! static::isImported($className, true)) {
			$msg = 'Attempted to instantiate something other than an instantiable class';
			throw new \Exception($msg);
		}
		$nsClassName = static::namespaced($className);

		// Reflect so that we can pass args
		// ref: http://stackoverflow.com/questions/2640208/call-a-constructor-from-variable-arguments-with-php
		$reflectedClass = new \ReflectionClass($nsClassName);
		if ($reflectedClass->isAbstract()) {
			$msg = 'Attempted to instantiate an abstract (non-instantiable) class';
			throw new \Exception($msg);
		}

		// Get the variable argument list ...
		$args = func_get_args();
		// ... less the first which is the resource specifier
		array_shift($args);

		return $reflectedClass->newInstanceArgs($args);
	}

	/**
	 * Run an application's main function
	 *
	 * @param object $app A class instance that implements ApplicationIfc inerface
	 *
	 * @return integer The application's exit code (0 for non-error)
	 */
	public static function run($app) {

		// If $app is legit this will already be imported, but if not...
		static::import('Oop.ApplicationIfc');
		if (! $app instanceof ApplicationIfc) {
			$msg = 'Attempted to run something other than an application instance';
			throw new \Exception($msg);
		}

		return $app->main();
	}
}

