<?php
/**
 * PHPGoodies:STClass class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

PHPGoodies::import('Oop.STClass');

class STClassTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
	}

	/**
	 * Just verify that we can instantiate such a class
	 */
	public function testThatSTClassIsInstantiable() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$this->assertTrue(is_object($class));
		$this->assertTrue($class instanceof STClass);
	}

	/**
	 * Test that added public properties are accessible internally and externally
	 */
	public function testThatPublicPropertiesAreAccessible() {
		$class = PHPGoodies::instantiate('Oop.STClass');

		// Add properties
		$class->add('fortyTwo', 42);
		$class->F00 = 0xF00;

		// External acccess
		$this->assertEquals(42, $class->fortyTwo);
		$this->assertEquals(0xF00, $class->F00);
	}

	/**
	 * Test that attempts to set a different value type after the property is added are rejected
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testThatMismatchedDataAssignmentsAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('fortyTwo', 42);		// Add a number
		$class->fortyTwo = 'Forty Two!';	// Try to set it to a string!
	}

	/**
	 * Test that attempts to add a property with an overridden type that does not match are rejected
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testThatMismatchedTypeAdditionsAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		// A number can't be a string, you silly goose!
		$class->add('fortyTwo', 42, ST_TYPE_STRING);
	}

	/**
	 * Test that an attempt to add the same member twice are rejected
	 *
	 * @expectedException LogicException
	 */
	public function testThatDuplicateAddsAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('fortyTwo', 42);
		$class->add('fortyTwo', 42);
	}

	/**
	 * Test that invalid property names are rejected for addition
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testThatInvalidPropertyNamesAddedAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('42', 42);
	}

	/**
	 * Test that additions with invalid types are rejected
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testThatInvalidTypesAddedAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('fortyTwo', 42, 'Baloney Sandwich');
	}

	/**
	 * Test that an extended STClass gets the expected classMembers set up
	 */
	public function testThatSTClassExtendedHasExpectedClassMembers() {
		$classExt = new STClassExtended();
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];

		// It should be an array
		$this->assertTrue(is_array($classMembers));

		// With N elements
		$this->assertEquals(2, count($classMembers));

		// It should have a privateProperty1 object
		$this->assertTrue(isset($classMembers['privateProperty1']));
		$tmp =& $classMembers['privateProperty1'];
		$this->assertTrue(is_object($tmp));
		$this->assertEquals(ST_TYPE_STRING, $tmp->type);
		$this->assertEquals(ST_SCOPE_PRIVATE, $tmp->scope);
		$this->assertNull($tmp->returnType);
		$this->assertEquals('Hot Tamales', $tmp->value);
		$this->assertEquals('Hot Tamales', $classExt->get('privateProperty1'));

		// It should have a publicProperty1 object
		$this->assertTrue(isset($classMembers['publicProperty1']));
		$tmp =& $classMembers['publicProperty1'];
		$this->assertTrue(is_object($tmp));
		$this->assertEquals(ST_TYPE_STRING, $tmp->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $tmp->scope);
		$this->assertNull($tmp->returnType);
		$this->assertEquals('Lemon Drops', $tmp->value);
		$this->assertEquals('Lemon Drops', $classExt->get('publicProperty1'));
		$this->assertEquals('Lemon Drops', $classExt->publicProperty1);
	}

	/**
	 * Test that the magic __set(), __get(), __isset(), and __unset() do what is expected
	 */
	public function testThatMagicMethodsBehave() {
		$classExt = new STClassExtended();
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];

		// Ensure that our test value does not exist to start
		$this->assertFalse(isset($classMembers['publicProperty2']));

		// Make sure __isset() can NOT see it there...
		$this->assertFalse(isset($classExt->publicProperty2));
		$this->assertFalse(isset($classExt->privateProperty1));
		$this->assertFalse(isset($classExt->nonexistentProperty));
		$this->assertTrue(isset($classExt->publicProperty1));

		// use __set() to it and make sure it showed up
		$classExt->publicProperty2 = 'Graham Crackers';
		$this->assertTrue(isset($classMembers['publicProperty2']));
		$tmp =& $classMembers['publicProperty2'];
		$this->assertTrue(is_object($tmp));
		$this->assertEquals(ST_TYPE_STRING, $tmp->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $tmp->scope);
		$this->assertNull($tmp->returnType);
		$this->assertEquals('Graham Crackers', $tmp->value);

		// Make sure __get() can get it...
		$this->assertEquals('Graham Crackers', $classExt->publicProperty2);

		// Use __set() to update it (assign)
		$classExt->publicProperty2 = 'Gumballs';
		$this->assertTrue(isset($classMembers['publicProperty2']));
		$tmp =& $classMembers['publicProperty2'];
		$this->assertTrue(is_object($tmp));
		$this->assertEquals(ST_TYPE_STRING, $tmp->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $tmp->scope);
		$this->assertNull($tmp->returnType);
		$this->assertEquals('Gumballs', $tmp->value);

		// Make sure __get() sees the change...
		$this->assertEquals('Gumballs', $classExt->publicProperty2);

		// Make sure __isset() can see it is there...
		$this->assertTrue(isset($classExt->publicProperty2));

		// Make sure __unset() can successfully remove it
		unset($classExt->publicProperty2);
		$this->assertFalse(isset($classMembers['publicProperty2']));
		$this->assertFalse(isset($classExt->publicProperty2));
	}

	/**
	 * Test that attempts to get a nonexistent member are rejected
	 *
	 * @expectedException PHPGoodies\MemberDoesNotExistException
	 */
	public function testThatGettingNonexistentMemberIsRejected() {
		$class = new STClass();
		$value = $class->nonexistentMember;
	}

	/**
	 * Test that attempts to get an inaccessible member are rejected
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 */
	public function testThatGettingInaccessibleMemberIsRejected() {
		$classExt = new STClassExtended();
		$value = $classExt->privateProperty1;
	}

	/**
	 * Test that attempts to unset a nonexistent member are rejected
	 *
	 * @expectedException PHPGoodies\MemberDoesNotExistException
	 */
	public function testThatUnsettingNonexistentMemberIsRejected() {
		$class = new STClass();
		unset($class->nonexistentMember);
	}

	/**
	 * Test that attempts to unset an inaccessible member are rejected
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 */
	public function testThatUnsettingInaccessibleMemberIsRejected() {
		$classExt = new STClassExtended();
		unset($classExt->privateProperty1);
	}
}

/**
 * Extends and populares STClass as it would be in a normal application
 *
 * Note: update tests in f.testThatSTClassExtendedHasExpectedClassMembers() when additions are made:
 */
class STClassPopulated extends STClass {

	/**
	 * Constructor
	 */
	public function __construct() {

		// Add a private property
		$this->addClassMember('privateProperty1', ST_TYPE_STRING, ST_SCOPE_PRIVATE, 'Hot Tamales');

		// Add a public property
		$this->addClassMember('publicProperty1', ST_TYPE_STRING, ST_SCOPE_PUBLIC, 'Lemon Drops');
	}
}

/**
 * Extends the populated STClass for testing to expose all protected members
 */
class STClassExtended extends STClassPopulated {

	/**
	 * A spy method for testing that allows us to inspect the non-public data structures
	 */
	public function &spy() {
		$data = array();
		$data['classMembers'] =& $this->classMembers;
		return $data;
	}

	// Expose all the protected features of STClass
	public function getType(&$obj) {
		return parent::getType($obj);
	}

	public function requireMember($name) {
		return parent::requireMember($name);
	}

	public function requireTypeMatch($name, &$value) {
		return parent::requireTypeMatch($name, $value);
	}

	public function isLegalName($name) {
		return parent::isLegalName($name);
	}

	public function isLegalType($type) {
		return parent::isLegalType($type);
	}

	public function isLegalScope($scope) {
		return parent::isLegalScope($scope);
	}

	public function addClassMember($name, $type, $scope, $value = null) {
		return parent::addClassMember($name, $type, $scope, $value);
	}

	public function hasClassMember($name) {
		return parent::hasClassMember($name);
	}

	public function &getClassMember($name) {
		$member = parent::getClassMember($name);
		return $member;
	}

	public function isClassMemberScopeAccessible($name, $scope) {
		return parent::isClassMemberScopeAccessible($name, $scope);
	}

	public function requireAccess($name, $scope) {
		return parent::requireAccess($name, $scope);
	}

	public function isFunction($name) {
		return parent::isFunction($name);
	}

	public function requireFunction($name) {
		return parent::requireFunction($name);
	}

	public function set($name, $value, $scope = ST_SCOPE_ANY) {
		return parent::set($name, $value, $scope);
	}

	public function call($name, $args, $scope = ST_SCOPE_ANY) {
		return parent::call($name, $args, $scope);
	}

	public function has($name) {
		return parent::has($name);
	}

	public function chk($name, $scope = ST_SCOPE_ANY) {
		return parent::chk($name, $scope);
	}

	public function get($name, $scope = ST_SCOPE_ANY) {
		return parent::get($name, $scope);
	}

	public function del($name, $scope = ST_SCOPE_ANY) {
		return parent::del($name, $scope);
	}
}

