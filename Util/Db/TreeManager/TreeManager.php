<?php
/**
 * PHPGoodies:TreeManager - A class for managing "tree" type database tables
 *
 * For purposes of this utility, we will consider a "tree" type database table to be one which is
 * self-referential via an "fk_node" field which links to its parent node in the tree where any
 * root nodes have null for fk_node.
 *
 * @todo Rework to support specification of a database name instead of requiring that the correct
 * database has already been selected.
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
	 * Name of the table we'll be working with
	 */
	protected $table;

	/**
	 * fieldname/type pairs to describe the fields we know about
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
	 *
	 * return array Of strings with valid field names for this table excluding id and fk_node
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

				// ID and fk_node fields are managed automatically
				if (('id' == $field) || ('fk_node' == $field)) continue;

				// All else will be user-managed, and thus must be in the fields;
				// The type will determine the UI input form type
				$type = ('text' == $info['type']) ? 'text' : 'string';
				$this->fields[$field] = $type;
			}
		}

		return array_keys($this->fields);
	}

	/**
	 * Get all the root nodes
	 *
	 * @return array of nodes for this table that have no parent node
	 */
	public function getRootNodes() {
		$table = $this->db->identifier(null, $this->table);
		return $this->db->query("SELECT * FROM {$table} WHERE `fk_node` IS NULL;");
	}

	/**
	 * Get all child nodes for the specified parent node ID
	 *
	 * @param integer $nodeId ID of the parent node of interest
	 *
	 * @return array of nodes for this table linked to the specified node ID as the parent
	 */
	public function getChildNodes($nodeId) {
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('fk_node', $nodeId, '=', $this->table);
		return $this->db->query("SELECT * FROM {$table} WHERE {$cond};");
	}

	/**
	 * Get the full node record for the specified node ID
	 *
	 * @param integer $nodeId ID of the node of interest
	 *
	 * @return array Full node record of the specified node ID
	 */
	public function getNode($nodeId) {
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('id', $nodeId, '=', $this->table);
		return $this->db->query("SELECT * FROM {$table} WHERE {$cond};");
	}

	/**
	 * Add a new node to the database
	 *
	 * @param integer $parentNodeId The ID for the parent node (nullable)
	 * @param array $data Array of name/value pairs where both are strings
	 *
	 * @return boolean true on success, else false
	 */
	public function addNode($parentNodeId, &$data) {
print_r($data);		
print "1\n";
		// Get the setters; require at least one; and add one for the parent nodeId
		$setters = $this->getDataSetters($data);
print "2\n";
		if (! count($setters)) return false;
print "3\n";
		if (! is_null($parentNodeId)) {
print "4\n";
			$setters[] = $this->db->makeSetter('fk_node', $parentNodeId, $this->table);
		}
print "5\n";

		// Make a query out of it
		$qSetters = join(",\n", $setters);
print "6\n";
		$table = $this->db->identifier(null, $this->table);
print "7\n";
		$query = "INSERT INTO {$table} SET {$qSetters}";
print "Q=[{$query}]\n";
		return $this->db->query($query);
	}

	/**
	 * Delete the specified nodeId from the database
	 *
	 * Note that if the database has proper key constraints and cascade configuration, any
	 * childe nodes pointing to this one as their parent will be deleted automatically.
	 *
	 * @param integer $nodeId ID of the node of interest
	 *
	 * @return boolean true on success, else false
	 */
	public function deleteNode($nodeId) {
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('id', $nodeId, '=', $this->table);
		return $this->db->query("DELETE FROM {$table} WHERE {$cond};");
	}

	/**
	 * Update the field data for the specified nodeId record
	 *
	 * @param integer $nodeId ID of the node of interest
	 * @param array $data Array of name/value pairs where both are strings
	 *
	 * @return boolean true on success, else false
	 */
	public function updateNode($nodeId, &$data) {

		// Get the setters; require at least one for this operation to do something
		$setters = $this->getDataSetters($data);
		if (! count($setters)) return false;

		// Do the update!
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('id', $nodeId, '=', $this->table);
		return $this->db->query("UPDATE {$table} SET {$setters} WHERE {$cond};");
	}

	/**
	 * Fromat a set of data setters for the supplied data
	 *
	 * Note that the only setters created/returned will be for those data fields whose names
	 * match known field names for this table.
	 *
	 * @param array $data Array of name/value pairs where both are strings
	 *
	 * @return array Setter strings ready to drop into a query
	 */
	protected function getDataSetters(&$data) {
		// Only accept data for fields we recognize
		$setters = array();
		foreach ($this->fields as $field) {
			if (! isset($data[$field])) continue;
			$setters[] = $this->db->makeSetter($field, $data[$field], $this->table);
		}
		return $setters;
	}
}

