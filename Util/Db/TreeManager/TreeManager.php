<?php
/**
 * PHPGoodies:TreeManager - A class for managing "tree" type database tables
 *
 * For purposes of this utility, we will consider a "tree" type database table to be one which is
 * self-referential via an "fk_parent" field which links to its parent node in the tree where any
 * root nodes have null for fk_parent.
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
	 * return array Of strings with valid field names for this table excluding id and fk_parent
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

		return array_keys($this->fields);
	}

	/**
	 * Get all the root nodes
	 *
	 * @return array of nodes for this table that have no parent node
	 */
	public function getRootNodes() {
		$table = $this->db->identifier(null, $this->table);
		return $this->db->query("SELECT * FROM {$table} WHERE `fk_parent` IS NULL;");
	}

	/**
	 * Get all child records for the specified parent node ID
	 *
	 * @param integer $nodeId ID of the parent node of interest
	 *
	 * @return array of nodes for this table linked to the specified node ID as the parent
	 */
	public function getChildNodes($nodeId) {
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('fk_parent', $nodeId, '=', $this->table);
		return $this->db->query("SELECT * FROM {$table} WHERE {$cond};");
	}

	/**
	 * Get the full record for the specified node ID
	 *
	 * @param integer $nodeId ID of the node of interest
	 *
	 * @return array Full node record of the specified node ID
	 */
	public function getNodeById($nodeId) {
		$table = $this->db->identifier(null, $this->table);
		$cond = $this->db->makeCondition('id', $nodeId, '=', $this->table);
		$res = $this->db->query("SELECT * FROM {$table} WHERE {$cond};");
		return $this->db->QC($res) ? $res[0] : null;
	}

	/**
	 * Get the full record for the specified node and parent ID
	 *
	 * @param string $node The value stored for this node's string identifier
	 * @param integer $parentNodeId The ID of the parent node, or null if this is a root node
	 *
	 * @return array Full node record, or null on error 
	 */
	public function getNode($node, $parentNodeId = null) {
		$table = $this->db->identifier(null, $this->table);
		$nodeCond = $this->db->makeCondition('node', $node, '=', $this->table);
		$parentCond = is_null($parentNodeId) ? '`fk_parent` IS NULL' : $this->db->makeCondition('fk_parent', $parentNodeId, '=', $this->table);
		$res = $this->db->query("SELECT * FROM {$table} WHERE {$nodeCond} AND {$parentCond};");
		return $this->db->QC($res) ? $res[0] : null;
	}

	/**
	 * Get the node whose hierarchical tree matches that of the supplied identifier
	 *
	 * Note: nodeIdentifier is dotted notation like 'root.parent.child' list of 'node' property
	 * values in order of hierarchy, starting with a root node. Any node in the chain that is
	 * not located will cause the request to fail. If there are two nodes with the same name
	 * and under the same parent (a violation of the "contract" for this form of tree which
	 * means our database integrity is broken), then the first in the list of results returned
	 * by the query, in whatever arbitrary ordering scheme the database uses, will win. And thus
	 * if those two nodes have different children beneath them, we may or may not be able to get
	 * at the originally desired node branch - "luck".
	 *
	 * @param string $nodeIdentifier Dotted notation hierarchical node identifier
	 *
	 * @return array Full node record of the node which was found or null if not
	 */
	public function findNode($nodeIdentifier) {

		// Get all the node parts lined up in sequence
		$parts = explode('.', $nodeIdentifier);
		if (count($parts) == 0) return null;

		// Get the starting node...
		$node = $this->getNode($parts[0]);

		// Treat each node as the parent of the next one until we find the last
		for ($part = 1; $part < count($parts); $part++) {

			// Find the next node in the chain...
			$node = $this->getNode($parts[$part], $node['id']);

			// And if any is null then the chain is broken
			if (null == $node) return null;
		}

		// The last one should be what we're after
		return $node;
	}

	/**
	 * Get the unique node identifier for the specified nodeId
	 *
	 * @param integer $nodeId ID of the node of interest
	 *
	 * @return string Unique hierarchical node identifier in dotted notation, or null on error
	 */
	public function getNodeIdentifier($nodeId) {

		// Pull the starting node and make sure it's good
		$node = $this->getNodeById($nodeId);
		if (null == $node) return null;
		$nodeIdentifier = $node['node'];

		// Now for each non-null parent, keep fetching parental nodes up the hierarchy
		while (null != $node['fk_parent']) {

			// Get this node's parent as the new node
			$node = $this->getNodeById($node['fk_parent']);
			if (null == $node) return null;
			$nodeIdentifier = "{$node['node']}.{$nodeIdentifier}";
		}

		return $nodeIdentifier;
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

		// Get the setters; require at least one; and add one for the parent nodeId
		$setters = $this->getDataSetters($data);
		if (! count($setters)) return false;
		if (! is_null($parentNodeId)) {
			$setters[] = $this->db->makeSetter('fk_parent', $parentNodeId, $this->table);
		}

		// Make a query out of it
		$qSetters = join(",\n", $setters);
		$table = $this->db->identifier(null, $this->table);
		$query = "INSERT INTO {$table} SET {$qSetters};";
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
		foreach ($this->fields as $field => $type) {
			if (! isset($data[$field])) continue;
			$setters[] = $this->db->makeSetter($field, $data[$field], $this->table);
		}
		return $setters;
	}
}

