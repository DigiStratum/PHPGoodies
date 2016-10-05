<?php
/**
 * PHPGoodies CompositeExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Composite as Composite;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));
PHPGoodies::import('Oop.Composite');

class A {
	public $a1 = 'a1';
	public $a2 = 'a2';
	public function aFunc($value) {
		return $value;
	}
}


class B {
	public $b1 = 'b1';
	public $b2 = 'b2';
	public function bFunc($value) {
		return $value;
	}
}

$both = new Composite();
$both->addObject(new A());
$both->addObject(new B());

print "a1 = [{$both->a1}]\n";
print "a2 = [{$both->a2}]\n";
print "aFunc = [{$both->aFunc('aFunc')}]\n";
print "b1 = [{$both->b1}]\n";
print "b2 = [{$both->b2}]\n";
print "bFunc = [{$both->bFunc('bFunc')}]\n";
unset($both->b1);
print "b1 is " . (isset($both->b1) ? 'set' : 'unset') . "\n";

// Note that this effectively adds b1 to the Composite instance,
// not to where it originally came from in the B instance
$both->b1 = 'B1';
print "b1 = [{$both->b1}]\n";

