<?php
/**
 * PHPGoodies:PHPGoodies
 *
 * Many of the PHPGoodies class implementations stand alone, however some of the more complex
 * implementations have external dependencies within the PHPGoodies family of code. The supporting
 * functions and constants found here provide a streamlined mechanism for accessing those
 * dependencies.
 *
- * @author Sean M. Kelly <smk@smkelly.com>
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
			throw new \Exception("Could not import implementation for '{$resource}'");
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
		$nsName = __NAMESPACE__ . '\\' . $name;
		return (class_exists($nsName) || interface_exists($nsName || trait_exists($nsName)));
	}
}

