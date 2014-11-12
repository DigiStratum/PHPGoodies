<?php
/**
 * PHPGoodies GlobalSingletonsExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
$obj = PHPGoodies::instantiate('Lib.Oop.Obj');

// Use our global Obj to get a reference to an instance of Lib.Db.Mysql
$db =& $obj->get('Lib.Db.Mysql.Mysql');
if (! $db->connect('localhost', 'root', '', 'mysql')) {
	die("error connecting to database\n");
}

print "MySQL thinks the time is: " . myFunction() . "\n\n";
$db->close();

// Get at the db object via our global Obj
function myFunction() {
	global $obj;

	$db =& $obj->get('Lib.Db.Mysql.Mysql');

	$res = $db->query('SELECT NOW() AS `rightnow`;');
	return $res[0]['rightnow'];
}

