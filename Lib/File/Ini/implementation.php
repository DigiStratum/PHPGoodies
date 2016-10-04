<?php
/**
 * PHPGoodies:Ini - A class for working with INI files
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Ini - A class for working with INI files
 */
class Ini {

	/**
	 * Path to the INI file we'll be working with
	 */
	protected $filePath;

	/**
	 * Local INI Data cache
	 */
	protected $data = array();

	/**
	 * Constructor
	 *
	 * @param string $filePath Path to the INI file we'll be working with
	 */
	public function __construct($filePath) {

		$this->filePath = $filePath;
	}

	/**
	 * Load data from the INI file into our local cache
	 *
	 * @return boolean true on success, else false
	 */
	public function load() {
		$this->data = @parse_ini_file($this->filePath, true);
		if (false === $this->data) {
			$this->data = array();
			return false;
		}

		return true;
	}

	/**
	 * Save data from our local cache into the INI file
	 *
	 * @return boolean true on success, else false
	 */
	public function save() {
	}

	/**
	 * Reset thelocal cache to a fresh/empty state
	 *
	 * @return object Reference to this for chaining...
	 */
	public function &reset() {
		$this->data = array();
		return $this;
	}

	/**
	 * Check whether the supplied name is a currently defined section
	 *
	 * @param string $section Name of the section we want to check
	 *
	 * @return boolean true if it is a section, else false
	 */
	public function isSection($section) {
		return isset($this->data[$section]);
	}

	/**
	 * Check whether the supplied name is a currently defined setting under the named section
	 *
	 * @param string $section Name of the section we want to check
	 * @param string $setting Name of the setting we want to check
	 *
	 * @return boolean true if it is a setting under the named section, else false
	 */
	public function isSetting($section, $setting) {
		if (! $this->isSection($section)) return false;
		return isset($this->data[$section][$setting]);
	}

	/**
	 * Get a list of sections in the local cached
	 *
	 * @return array of string, each a distinct section name
	 */
	public function getSections() {
		return array_keys($this->data);
	}

	/**
	 * Get all the setting data for the named section from the local cache
	 *
	 * @param string $section Name of the section we want to pull data from
	 *
	 * @return array of name/value pairs where vlue is either a string or an array of strings
	 */
	public function getSettings($section) {
		if (! $this->isSection($section)) return null;
		return $this->data[$section];
	}

	/**
	 * Get a single setting for the named section from the local cache
	 *
	 * @param string $section Name of the section we want to pull data from
	 * @param string $setting Name of the setting under this section we want a value from
	 *
	 * @return mixed Single string or an array of strings that constitute the value for this setting
	 */
	public function getSetting($section, $setting) {
		if (! $this->isSetting($section, $setting)) return null;
		return $this->data[$section][$setting];
	}

	/**
	 * Add a section to our local data cache
	 *
	 * This method has the side effect that it will also clear out all the settings of an
	 * existing section by the same name if one is present.
	 *
	 * @param string $section Name of the section we want to add
	 *
	 * @return object Reference to this for chaining...
	 */
	public function &addSection($section) {
		$this->data[$section] = array();
		return $this;
	}

	/**
	 * Add a setting to the named section in our local cache
	 *
	 * Note that the section will be created automatically if it does not already exist.
	 *
	 * @todo validate the value to ensure that it is a simple number, string or array of either
	 *
	 * @param string $section Name of the section we want to add to
	 * @param string $setting Name of the setting we want to set a value for
	 * @param mixed $value Number/string or array of number/string to stoer as the setting value
	 *
	 * @return object Reference to this for chaining...
	 */
	public function &addSetting($section, $setting, $value) {
		if (! $this->isSection($section)) {
			$this->addSection($section);
		}
		$this->data[$section][$setting] = $value;
		return $this;
	}
}

