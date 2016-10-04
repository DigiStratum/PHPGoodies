<?php
/**
  * PHPGoodies:Hash - Extend the capabilities of an associative array with OOP
  *
  * @author Sean M. Kelly <smk@smkelly.com>
  */

namespace PHPGoodies;

/**
 * Hash
 */
class Hash {

	/**
	 * This is the actual hash data that all the methods below manipulate
	 */
	protected $hash = Array();

	/**
	 * Get the element with the specified key
	 *
	 * @param string $key The hash key for the element that we want to get
	 *
	 * @return mixed Whatever is stored in the hash with this key
	 */
	public function get($key) {
		if (! $this->has($key)) return null;
		return $this->hash[$key];
	}

	/**
	 * Set the element with the specified key to the supplied value
	 *
	 * @param string $key The hash key for the element that we want to set
	 * @param mixed $value Whatever PHP data we want to cram into the hash under this key
	 *
	 * return object $this for chainable support...
	 */
	public function set($key, $value) {
		$this->hash[$key] = $value;
		return $this;
	}

	/**
	 * Delete the element with the specified key from the hash
	 *
	 * @param string $key The hash key for the element that we want to delete
	 *
	 * return object $this for chainable support...
	 */
	public function del($key) {
		if ($this->has($key)) unset($this->hash[$key]);
		return $this;
	}

	/**
	 * Checks whether the hash has an element with the specified key
	 *
	 * @param string $key The hash key for the element that we want to check
	 *
	 * @return boolean true if the element is already set, else false
	 */
	public function has($key) {
		return isset($this->hash[$key]) ? true : false;
	}

	/**
	 * Checks the number of keys in the hash
	 *
	 * @return integer The number of keys currently set in the hash
	 */
	public function num() {
		return count($this->hash);
	}

	/**
	 * Resets the hash to empty (nil)
	 *
	 * return object $this for chainable support...
	 */
	public function nil() {
		$this->hash = Array();
		return $this;
	}

	/**
	 * Get all hash data
	 *
	 * @return array The entire hash is returned
	 */
	public function all() {
		return $this->hash;
	}

	/**
	 * Put supplied data in place of the hash
	 *
	 * better be a hash; we're not going to check it...
	 *
	 * @param array $data Associative array that we are going to replace ours with
	 *
	 * @return boolean true on success, else false
	 */
	public function put($data) {
		if (! is_array($data)) return(false);
		$this->hash = $data;
		return true;
	}

	/**
	 * See the hash contents as a plain text output
	 *
	 * @param string $name Optional debug label to put into the text output
	 *
	 * @return string The formatted output of the hash contents
	 */
	public function see($name = '') {
		$output = (strlen($name) ? "HASH {$name} : " : '') . "{\n";
		if (! count($this->hash)) return $output;
		foreach ($this->hash as $key => $value) {
			$output .= "\t\"{$key}\": \"{$value}\"\n";
		}
		$output .= "}\n";
		return $output;
	}

	/**
	 * Get the current keys defined for this hash
	 *
	 * @return array Set of key strings valid for get/has/del operations
	 */
	public function keys() {
		return array_keys($this->hash);
	}

	/**
	 * Merge in another Hash
	 *
	 * @param object $hash Another instance of Hash whose records we'll merge in
	 * @param boolean $replace Replaces any existing entries with supplied ones if true (default)
	 *
	 * @return object $this for chaining support...
	 */
	public function merge($hash, $replace = true) {

		if (! $hash instanceof Hash) {
			throw new \Exception('Attempted to merge with something other than another Hash');
		}

		// Protected members of $httpHeaders are accessible because we are the same class
		foreach ($hash->hash as $name => $value) {

			// If we are not replacing and we already have this one, skip it!
			if ((! $replace) && ($this->has($name))) continue;

			// Otherwise, set this one normally
			$this->set($name, $value);
		}

		return $this;
	}
}

