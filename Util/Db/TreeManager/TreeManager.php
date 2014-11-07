<?php
/**
 * PHPGoodies:TreeManager - A class for managing "tree" type database tables
 *
 * For purposes of this utility, we will consider a "tree" type database table to be one which is
 * self-referential via an "fk_parent" field which links to the parent node in the tree where any
 * root nodes have null for fk_parent.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

/**
 * TreeManager - A class for managing "tree" type database tables
 */
class TreeManager {

	/**
	 * Our reference to the PHPGoodies\Mysql database instance
	 */
	protected $db = null;

	/**
	 *
	 */
	protected $table;

	/**
	 *
	 */
	protected $fields;

	/**
	 * Constructor
	 *
	 * Because there is not a sensible/convenient way to structure two optional arguments for
	 * the setup method that won't require passing null for one argument or the other, the
	 * injected Mysql database MUST have the database pre-selected so that we can simply specify
	 * the table name to setup.
	 *
	 * @param object $mysql Dependency injection reference to PHPGoodies\Mysql instance
	 */
	public function __construct(&$mysql) {

		// Capture a reference to the Mysql instance
		$this->db =& $mysql;
	}

	/**
	 * Set up for operation against the specified table
	 *
	 * Automatically detects the managable fields if not supplied, but if they are known ahead
	 * of time, it would be more efficient not to ask the database for it every page load.
	 *
	 * @param string $table Name of the table we want to manage
	 * @param array $fields Collection of fields, name=type (optional)
	 */
	public function setup($table, $fields = array()) {

		$this->table = $table;

		// If the fields were supplied then we'll use them verbatim
		if (count($fields) > 0) {
			$this->fields = $fields;
		}
		// Otherwise do some work to discover the fields on our own
		else {
			$tableSchema = $this->db->schemaInfo($table);
			$this->fields = array();
			foreach ($tableSchema as $field => $info) {

				// ID and fk_parent fields are managed automatically
				if (('id' == $field) || ('fk_parent' == $field)) continue;

				// All else will be user-managed, and thus must be in the fields;
				// The type will determine the UI input form type
				$type = ('text' == $info['type']) ? 'text' : 'string';
				$this->fields[$field] = $type;
			}
		}
	}

	/**
	 *
	 */
	public function getChildNodes($parent) {
		return $this->db->query("SELECT * FROM {$db->identifier(null, $this->table)} WHERE `fk_parent` = '{$parent}';");
	}

	/**
	 *
	 */
	public function getNodeInfo($id) {
		return $this->db->query("SELECT * FROM {$db->identifier(null, $this->table)} WHERE `id` = '{$id}';");
	}
}

