<?php
/**
 * PHPGoodies:Lib_File_IOWrapper - A wrapper for PHP disk/file IO operations (WORK IN PROGRESS)
 *
 * This is made necessary by inconsistency of calling and return data of PHP's built-in disk/file IO
 * operations as well as total absence of error handling, retry support, etc.
 *
 * TODO: Decide whether we really want this or if we want a more OOP approach to File and Directory
 * access such that, for a given path, a File/Dir can be checked, created, deleted, opened, read,
 * written to, etc...
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * IOWrapper - A wrapper for PHP disk/file IO operations
 */
class Lib_File_IOWrapper {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	// DIRECTORIES
	// -----------------------------------------------------------------------------------------

	/**
	 * Check whether the specified path is a directory
	 *
	 * @param string $path The path we want to check
	 *
	 * @return boolean true if $path is a directory, else false
	 */
	public function isDir($path) {
		return is_dir($path);
	}

	// FILES
	// -----------------------------------------------------------------------------------------

	/**
	 * Check whether the specified path is a file
	 *
	 * @param string $path The path we want to check
	 *
	 * @return boolean true if $path is a file, else false
	 */
	public function isFile($path) {
		if (! file_exists($path)) return false;
		return is_file($path);
	}

	// LINKS
	// -----------------------------------------------------------------------------------------

	/**
	 * Check whether the specified path is a link
	 *
	 * @param string $path The path we want to check
	 *
	 * @return boolean true if $path is a link, else false
	 */
	public function isLink($path) {
		if (! file_exists($path)) return false;
		return is_link($path);
	}
}

