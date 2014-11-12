<?php
/**
 * PHPGoodies TreeManagerBasicsExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../../PHPGoodies.php'));

// 3) Make a database connection
$db = PHPGoodies::instantiate('Lib.Db.Mysql.Mysql');
if (! $db->connect('localhost', 'root', '', 'taxonomy')) {
	die("error connecting to database\n");
}

$tm = PHPGoodies::instantiate('Util.Db.TreeManager.TreeManager', $db);
$tm->setup('node');

$roots = $tm->getRootNodes();
print_r($roots);

$data = array(
	'name' => 'testname',
	'description' => 'test description'
);
$tm->addNode(null, $data);

