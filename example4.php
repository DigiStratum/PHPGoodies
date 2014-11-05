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
PHPGoodies::import('lib.Mysql.Mysql');
PHPGoodies::import('util.db.TreeManager.TreeManager');

// 3) Make a database connection
$db = new Mysql();
$db->connect('hostname', 'username', 'password', 'databasename');

$tm = new TreeManager($db);
$tm->setup('tablename');

