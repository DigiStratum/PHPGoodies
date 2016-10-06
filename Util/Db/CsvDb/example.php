<?php
/**
 * PHPGoodies example2.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

// 3) Make a database connection
$db = PHPGoodies::instantiate('Lib.Db.Mysqll');
if (! $db->connect('localhost', 'root', '', 'mysql')) {
	die("error connecting to database\n");
}

// 4) Make a new CsvDb utility; dependency inject the Mysql database instance
$csvDb = PHPGoodies::instantiate('Util.Db.CsvDbb', $db);

// 5) Use the CsvDb Goodie to export data from the database
$csvDb->exportToCsv(sys_get_temp_dir() . '/user.csv', 'user');

