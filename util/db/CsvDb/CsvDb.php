<?php
/**
 * PHPGoodies:CsvDb - A class for using CSV data with a Mysql Database
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

/**
 * CsvDb - A class for using CSV data with a Mysql Database
 */
class CsvDb {

	/**
	 * The default batch size for bulk database operations
	 */
	const DEFAULT_BATCH_SIZE = 10;

	/**
	 * The batch size we'll actually use for bulk database operations
	 */
	protected $batchSize = self::DEFAULT_BATCH_SIZE;

	/**
	 * Our reference to the PHPGoodies\Mysql database instance
	 */
	protected $db = null;

	/**
	 * Constructor
	 *
	 * @param object $mysql Dependency injection reference to PHPGoodies\Mysql instance
	 */
	public function __construct(&$mysql) {

		// Capture a reference to the Mysql instance
		$this->db =& $mysql;

		// We don't need to dependency inject CSV since it is stateless
		PHPGoodies::import('lib.Csv.Csv');
	}

	/**
	 * Override the batch size that will be used for bulk database operations
	 *
	 * A small value is safe but inefficient, a larger value may be more efficcient... or may
	 * run you out of RAM or hammer your database. You need to experiment with this to determine
	 * a good batch size for your specific database table/needs.
	 *
	 * @param integer $size Count of database records to acces per batch
	 */
	public function setBatchSize($size) {
		$this->batchSize = $size;
	}

	/**
	 * Import data from CSV file into the named table
	 *
	 * Requirements:
	 *   1. First line MUST contain column headings
	 *   2. Column headings must be table fields (query will fail if any of them are wrong)
	 *   3. Every line that follows must have the same number of fields, except blank ones
	 *
	 * @param string $path Source path to the CSV file we want to import data from
	 * @param string $table Destination name of the table we want to insert CSV data into
	 * @param string $database Name of the database that the table is in (optional if default)
	 *
	 * @return boolean true on successful data import, else false
	 */
	public function importFromCsv($path, $table, $database = null) {

		// Open the CSV file or fail
		if (! ($fin = fopen($path, 'r'))) return false;

		// Default return result assumes failure
		$result = false;

		// Make everything breakable in here for common cleanup at the end...
		do {

			// Expect a non-empty header row
			$fields = Csv::tokenize(fgets($fin));
			$num = count($fields);
			if ($num == 0) break;

			while ($line = fgets($fin)) {

				// Make sure the extracted CSV data matches the expected column count
				$values = Csv::tokenize($line);
				if (count($data) == 0) continue; // ... but skip blank lines quietly
				if (count($data) != $num) break(2);

				// Convert the CSV data into quoted/escaped name/value setter pairs
				$sqlData = array();
				foreach ($values as $index => $value) {
					$sqlData[] = $this->db->makeSetter($fields[$index], $values[$index]);
				}
				$sqlValues = join(',', $sqlData);

				// Insert the data into the database
				$query = <<<END
					INSERT INTO
						{$this->db->identifier($database, $table)}
					SET
						{$sqlValues};
END;
				$res = $this->db->query($query);
				if (false === $res) break(2);
			}

			// Successful processing completed
			$result = true;
		} while (false);

		fclose($fin);
		return $result;
	}

	/**
	 * Export data from the named table to CSV file
	 *
	 * @param string $path Destination path to the CSV file we want to export data to
	 * @param string $table Source name of the table we want to read the CSV data from
	 * @param string $database Name of the database that the table is in (optional if default)
	 *
	 * @return boolean true on successful data export, else false
	 */
	public function exportToCsv($path, $table, $database = null) {

		// Turn the table fields into a header row
		$tableIdent = $this->db->identifier($database, $table);
		$tableInfo = $this->db->query("DESCRIBE {$tableIdent};");
		if (! $this->db->QC($tableInfo)) return false;
		$fields = array();
		foreach ($tableInfo as $fieldInfo) {
			$fields[] = $fieldInfo['Field'];
		}

		// Open the CSV file or fail
		if (! ($fout = fopen($path, 'w'))) return false;

		// Default return result assumes failure
		$result = false;

		// Make everything breakable in here for common cleanup at the end...
		do {

			// write out the header line
			$res = fputs($fout, Csv::csvize($fields) . "\n");
			if (false === $res) break;

			$batchNum = 0;

			// Keep reading batches until one with a lower record count than requested
			do {

				// Format the LIMIT clause for this batch
				$skipCount = $this->batchSize * $batchNum;
				$limit = ($batchNum == 0) ? '' : "{$skipCount}, ";
				$limit .= "{$this->batchSize}";

				// Pull a batch from the database
				$res = $this->db->query("SELECT * FROM {$tableIdent} LIMIT {$limit};");
				if (false === $res) break(2);

				// Convert each row into CSV output
				foreach ($res as $row) {

					// Note that csvize() just accesses array_values()
					$res2 = fputs($fout, Csv::csvize($row) . "\n");
					if (false === $res2) break(3);
				}

				// this was the last batch if it was not full
				if (count($res) < $this->batchSize) break;
				$batchNum++;
			} while (true);

			// Successful completion
			$result = true;
		} while (false);

		fclose($fout);
		return $result;
	}
}

