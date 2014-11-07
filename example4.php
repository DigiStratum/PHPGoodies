<?php
/**
 * PHPGoodies example4.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Mysql as Mysql;
use PHPGoodies\TreeManager as TreeManager;

// 2) Load up our goodies
require('PHPGoodies.php');
PHPGoodies::import('Lib.Db.Mysql.Mysql');
PHPGoodies::import('Util.Db.TreeManager.TreeManager');

// 3) Make a database connection
$db = new Mysql();
if (! $db->connect('hostname', 'username', 'password', 'databasename')) {
	die("error connecting to database\n");
}

$tm = new TreeManager($db);
$tm->setup('tablename');

