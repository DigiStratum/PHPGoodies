<?php
/**
 * PHPGoodies example3.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Mysql as Mysql;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Db.Mysql.Mysql');

// 3) Make a database connection
$db = new Mysql();
if (! $db->connect('localhost', 'root', '', 'mysql')) {
	die("error connecting to database\n");
}

// 4) Use the Mysql Goodie to print schema info for the specified database table
$info = $db->schemaInfo('user');
print_r($info);

