<?php
/**
 * PHPGoodies example2.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\CsvDb as CsvDb;
use PHPGoodies\Mysql as Mysql;

// 2) Load up our goodies
require(dirname(__FILE__) . '/../../../../PHPGoodies.php');
PHPGoodies::import('Lib.Db.Mysql.Mysql');
PHPGoodies::import('Util.Db.CsvDb.CsvDb');

// 3) Make a database connection
$db = new Mysql();
if (! $db->connect('localhost', 'root', '', 'mysql')) {
	die("error connecting to database\n");
}

// 4) Make a new CsvDb utility; dependency inject the Mysql database instance
$csvDb = new CsvDb($db);

// 5) Use the CsvDb Goodie to export data from the database
$csvDb->exportToCsv(sys_get_temp_dir() . '/user.csv', 'user');

