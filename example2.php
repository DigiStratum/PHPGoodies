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
require('PHPGoodies.php');
PHPGoodies::import('lib.Mysql.Mysql');
PHPGoodies::import('util.db.CsvDb.CsvDb');

// 3) Make a database connection
$db = new Mysql();
$db->connect('hostname', 'username', 'password', 'databasename');

// 4) Make a new CsvDb utility; dependency inject the Mysql database instance
$csvDb = new CsvDb($db);

// 5) Use the CsvDb Goodie to export data from the database
$csvDb->exportToCsv('tablename.csv', 'tablename');

