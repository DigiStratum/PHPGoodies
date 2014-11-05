<?php
/**
 * PHPGoodies:Mysql - DB access for MySQL connections
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Mysql - DB access for MySQL connections
 *
 * For pconnect, mysqld kills idle sessions based on this timer value:
 * set global interactive_timeout = 300;
 *
 * @todo Refactor to use Mysqli instead of legacy, global mysql functions
 */
class Mysql {

	/**
	 * Max number of retries to attempt for failed operations
	 */
	const RETRIES = 3;

	/**
	 * Number of seconds to sleep between retry attempts
	 */
	const RETRY_SLEEP = 1;

	/**
	 * Mysql connection link handle
	 */
	protected $link = null;

	/**
	 * Mysql connection state (cached)
	 */
	protected $connected = false;

	/**
	 * Mysql connection persistence control (on connect)
	 */
	protected $enablePersistence = true;

	/**
	 * Mysql connection flags (on connect)
	 */
	protected $flags = 0;

	/**
	 * Mysql connection hostname
	 */
	protected $host = '';

	/**
	 * Mysql connection database name
	 */
	protected $name = '';

	/**
	 * Mysql connection credential username
	 */
	protected $user = '';

	/**
	 * Mysql connection credential password
	 */
	protected $pass = '';

	/**
	 * Previously executed query
	 */
	protected $queryString = '';

	/**
	 * Constructor; does nothing because we want a couple different initialization methods
	 */
	public function __construct() {
	}

	/**
	 * Use the link from an already-established mysql connection
	 *
	 * @param resource $link The mysql connection resource already established by the caller
	 *
	 * @return boolean true on success, else false
	 */
	public function useLink($link) {
		if (is_resource($link)) {
			$this->link = $link;
			$this->ping();
			return true;
		}
		return false;
	}

	/**
	 * Get the link currently in use
	 *
	 * Allows us to play host to database connection management and pass the link back out to
	 * the caller so that other application code may use the same connection.
	 *
	 * @return resource Mysql connection resource handle currently in use or null if none
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Set the flags before making a connection
	 *
	 * @param int $flags The binary-encoded flags to activate for this connection
	 */
	public function setFlags($flags) {
		$this->flags = $flags;
	}

	/**
	 * Establish a Mysql database connection with the specified connection info
	 *
	 * Note that a small-but-busy Mysql host benefits from the retries; retries happen when the
	 * database host is too busy servicing other requests and has exhausted its connection pool.
	 * This gives your operation an opportunity to succeed despite the busy environment simply
	 * by waiting 1 second between requests instead of failing instantly.
	 *
	 * @param string $host Hostname for the Mysql database
	 * @param string $user Username for the conneciton credential
	 * @param string $pass Password for the connection credential
	 * @param string $name Database name to pre-select upon successful connection (optional)
	 * @param int $retries Number of times to retry making the connection (default 3)
	 *
	 * @return boolean true on successful connection, else false
	 */
	public function connect($host, $user, $pass, $name = '', $retries = self::RETRIES) {

		for ($retry = 0; $retry < $retries; $retry++) {

			// After the first failed attempt...
			if ($retry > 0) sleep(self::RETRY_SLEEP);

			if ($this->enablePersistence) {
		                $this->flags != MYSQL_CLIENT_INTERACTIVE;
				if ($this->link = @mysql_pconnect($host, $user, $pass, $this->flags)) {
					if ((strlen($name) == 0) || @mysql_select_db($name)) {
						$this->host = $host;
						$this->user = $user;
						$this->pass = $pass;
						$this->name = $name;
						$this->connected = true;
						mysql_query("SET `time_zone` = 'SYSTEM'", $this->link);

						return true;
					}
					break;
				}
			}
			else {
				if ($this->link = @mysql_connect($host, $user, $pass, true, $this->flags)) {
					if ((strlen($name) == 0) || @mysql_select_db($name)) {
						$this->host = $host;
						$this->user = $user;
						$this->pass = $pass;
						$this->name = $name;
						$this->connected = true;
						mysql_query("SET `time_zone` = 'SYSTEM'", $this->link);
						return true;
					}
					break;
				}
			}
		}

		return false;
	}

	/**
	 * Reconnect with the connection details already cached
	 *
	 * @return boolean true on sucessful reconnect, else false
	 */
	public function reconnect() {
		return $this->connect($this->host, $this->user, $this->pass, $this->name);
	}

	/**
	 * Check whether we think we are connected
	 *
	 * @param boolean $verify Optionally verify that we are actually connected (default false)
	 *
	 * @return boolean true if it looks like we are connected, else false
	 */
	public function isConnected($verify = false) {
		if (! $this->connected) return false;
		if ($verify) return $this->ping();
		return true;
	}

	/**
	 * Run a ping operation to the database connection
	 *
	 * Also caches the result of this operation into the connected state since, if ping fails
	 * then we are most decidedly NOT connected, otherwise we are.
	 *
	 * @return boolean true if we got a ping response, else false
	 */
	public function ping() {
		$this->connected = @mysql_ping($this->link);
		return $this->connected;
	}

	/**
	 * Close our mysql connection
	 *
	 * This should probably not be used for links that we have taken from another application
	 * via the useLink() method. Resets our status indicators so that it is clear we are not
	 * connected any longer.
	 *
	 * @return boolean true if we think we closed our connection normally, else false
	 */
	public function close() {
		if (is_resource($this->link)) {
			mysql_close($this->link);
			$this->link = null;
			$this->connected = false;
			return true;
		}
		return false;
	}

	/**
	 * Execute a query against the current connection
	 *
	 * @param string $query The SQL to execute
	 *
	 * @return mixed Result set array for queries that return data, otherwise boolean result
	 */
	public function query($query) {

		// If we're not connected, then there's nothing to do
		if (! $this->isConnected()) return false;

		// Cache the query and execute it
		$this->queryString = $query;
		$result = @mysql_query($query, $this->link);

		// There are few types of results that can come out...
		switch (gettype($result)) {

			// Queries that return row data come here (SELECT, SHOW, DESCRIBE, EXPLAIN, etc.)
			case 'resource':

				// Make an associative array out of the results if rows are returned
				$sqlrows = array();

				// Get the number of rows - if it's 0, don't bother iterating
				if (($numrows = @mysql_num_rows($result)) == 0) return $sqlrows;

				// More than 0 results, we fetch them iteratively
				while ($row = @mysql_fetch_assoc($result)) {

					// Capture the row into an accumulating result array
					$sqlrows[] = $row;
				}
		
				@mysql_free_result($result);

				// The return result from callbacks is either true or false only
				return$sqlrows;

			// Queries that return no row data come here (INSERT, UPDATE, DELETE, DROP, etc.)
			case 'boolean':
				return $result;

			// Strange; according to spec, this should be impossible
			default:
				throw new Exception('Unexpected response type from database query');
		}
	}

	/**
	 * Escape the supplied string for suitable inclusion in a query as a quoted data value
	 *	
	 * @param string $str The string to be escaped
	 *	
	 * @return string A safe version of the string for inclusion in a query
	 */
	public function escapeString($str) {
		return mysql_real_escape_string($str, $this->link);
	}

	/**
	 * Quote the supplied string for suitable inclusion in a query directly
	 *
	 * @param string $str The string to be quoted
	 *
	 * @return string A quoted version of the string for inclusion in a query
	 */
	public function quoteValue($str) {
		return "'{$this->escapeString($str)}'";
	}

	/**
	 * Helper function to make a conditional clause out of field/value
	 *
	 * This can reduce some boiler-plate code for dealing with name/value pairs where the value
	 * may be a single value or an array of values.
	 *
	 * @param string $field The name of the conditional field
	 * @param mixed $value A single numeric/string value or an array of numeric/string values
	 * @param string $comparator A conditional comparator to use (!=<>..., defaults to '=')
	 * @param string $table Name of table to compare against (optional)
	 * @param string $database Name of database to compare against (optional, requires table)
	 *
	 * @return string Conditional statement for inclusion in a query, or null on some problem
	 */
	public function makeCondition($field, $value, $comparator = '=', $table = null, $database = null) {
		$res = $this->identifier($database, $table, $field);

		// If the value is an array
		if (is_array($value)) {

			// Translate equality comparators for sets...
			switch (strtolower($comparator)) {
				case '=':
				case 'in':
					$comparator = 'IN';
					break;

				case '!=':
				case 'not in':
					$comparator = 'NOT IN';
					break;

				default:
					return null;
			}

			// Assemble the comparator and quoted values
			$values = '';
			foreach ($value as $val) {
				$values .= (strlen($values) ? ', ' : '') . $this->quoteString($val);
			}
			$res .= "{$comparator} ({$values})";
		}
		else {
			// Otherwise single values are pretty straightforward...
			$res . "{$comparator} " . $this->quoteString($value);
		}

		return $res;
	}

	/**
	 * Helper function to set a field equal to the supplied value
	 *
	 * This expects the supplied value to be a single number/string, not an array; current
	 * implementation is a simple wrapper of the makeCondition() method which is intended for
	 * checking rather than setting, but they are syntactically identical.
	 *
	 * @param string $field The name of the field to set
	 * @param mixed $value A single numeric/string value
	 * @param string $table Name of table to set the field on (optional)
	 * @param string $database Name of database to set the field on (optional, requires table)
	 *
	 * @return string Setter statement for inclusion in a query, or null on some problem
	 */
	public function makeSetter($field, $value, $table = null, $database = null) {
		if (is_array($value)) return null;
		return $this->makeCondition($field, $value, '=', $table, $database);
	}

	/**
	 * Get the number of affected rows by the previous query
	 *
	 * Typically, queries that don't return data, but affect stored data such as delete, update,
	 * etc. this is useful for verifying the result.
	 *
	 * @return integer Number of affected rows for the previous query
	 */
	public function affectedRows() {
		return mysql_affected_rows($this->link);
	}

	/**
	 * Get the ID for the previously inserted record
	 *
	 * Note PHP's native mysql function is limited to 32 bit integer which fails to return a
	 * proper value for bigint ID's on tables with high ID counts. Use a query with @@IDENTITY
	 * instead if a table name has been provided
	 *
	 * @param string $table Table to check for the insert ID (optional)
	 * @param string $database Database to look for the table in (optional)
	 *
	 * @return integer ID of the last inserted record according to mysql
	 */
	public function insertId($table = null, $database = null) {
		if (! is_null($table)) {
			$ident = $this->identifier($database, $table, $field);
			$query = "SELECT @@IDENTITY AS `newid` FROM `{$ident}` LIMIT 1;";
			if ($this->QC($res = $this->query($query))) {
				return (int) $res[0]['newid'];
			}
		}
		// note: MySQL's function does not accept a table name parameter
		return (int) @mysql_insert_id($this->link);
	}

	/**
	 * Make a properly escaped SQL identifier out of supplied database/table/field names
	 *
	 * Note that it does not make sense to supply database/field name but not table name. If no
	 * table name is supplied in this scenario, the result will be database.field which is
	 * definitely a logic error, and may or may not deliver some unexpected result (if you 
	 * happen to have a table with the same name as the field and the query doesn't break), or
	 * a SQL error for the query this gets added to. Either way, we make no attempt at error
	 * checking here.
	 *
	 * @param string $database Database for the identifier
	 * @param string $table Table for the identifier
	 * @param string $field Field name for the identifier
	 *
	 * @return string SQL identifier
	 */
	public function identifier($database = null, $table = null, $field = null) {
		$parts = array();
		if (! is_null($database)) $parts[] = $database;
		if (! is_null($table)) $parts[] = $table;
		if (! is_null($field)) $parts[] = $field;
		return (count($parts) > 0) ? '`' . join('`.`', $parts) . '`' : '';
	}

	/**
	 * Query Check! Make sure the supplied value is a non-empty array
	 *
	 * @param array $arr An arrary to check
	 *
	 * @return boolean true if the supplied value is a non-empty array, else false
	 */
	public function QC($arr) {
		return (is_array($arr) && (count($arr) > 0));
	}

	/**
	 * Get the error number resulting from the previous query
	 *
	 * @return integer error number for previous query, 0 if there was no error
	 */
	public function errorNumber() {
		return mysql_errno($this->link);
	}

	/**
	 * Get the error string resulting from the previous query
	 *
	 * @return string With the error message for previous query, empty if there was no error
	 */
	public function error() {
		return mysql_error($this->link);
	}

	/**
	 * Get schema info for the specified table
	 *
	 * Initial implementation is just formatting the DESCRIBE details for the table, however it
	 * will be possible to add further details in the future without disrupting these details
	 * as they are currently provided when needed.
	 *
	 * @param string $table Name of the table we want schema info for
	 * @param string $database Name of the database that the table is in (optional)
	 *
	 * @return array Associtive array with schema info for the table or null on error
	 */
	public function schemaInfo($table, $database = null) {
		$tableIdent = $this->identifier($database, $table);
		$tableInfo = $this->query("DESCRIBE {$tableIdent};");
                if (false === $tableInfo) return null;
                $schema = array();
                foreach ($tableInfo as $fieldInfo) {
			if (preg_match('/(.*?)\((.*?)\)/', $fieldInfo['Type'], $matches)) {
				$type = $matches[1];
				$size = $matches[2];
			}
			else {
				$type = $fieldInfo['Type'];
				$size = 0;
			}

			$nullable = ($fieldInfo['Null'] == 'YES') ? true : false;

			$schema[$fieldInfo['Field']] = array(
				'type' => $type,
				'size' => $size,
				'nullable' => $nullable,
				'default' => $fieldInfo['Default']
			);
                }

		return $schema;
	}
}

