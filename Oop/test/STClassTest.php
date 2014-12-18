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

	/**
	 * Test that getType returns expected types
	 */
	public function testThatGetTypeReturnsExpectedTypes() {
		$classExt = new STClassExtended();
		$this->assertEquals(ST_TYPE_STRING, $classExt->getType($v = 'Jelly Beans'));
		$this->assertEquals(ST_TYPE_INTEGER, $classExt->getType($v = 42));
		$this->assertEquals(ST_TYPE_DOUBLE, $classExt->getType($v = 3.14159));
		$this->assertEquals(ST_TYPE_BOOLEAN, $classExt->getType($v = true));
		$this->assertEquals(ST_TYPE_ARRAY, $classExt->getType($v = array()));
		$this->assertEquals('class:stdClass', $classExt->getType($v = (object) array()));
		$this->assertEquals(ST_TYPE_FUNCTION, $classExt->getType($v = function () { return 1; }));
		$v = fopen(__FILE__, 'r');
		$this->assertEquals(ST_TYPE_RESOURCE, $classExt->getType($v));
		fclose($v);
		$this->assertEquals(ST_TYPE_UNKNOWN, $classExt->getType($v));
	}

	/**
	 * Test that requireTypeMatch() rejects requests for nonexistent members
	 *
	 * @expectedException PHPGoodies\MemberDoesNotExistException
	 */
	public function testThatRequireTypeMatchRequiresMemeberToExist() {
		$classExt = new STClassExtended();
		$classExt->requireTypeMatch('nonexistentProperty', $v = 'Gummi Bears');
	}

	/**
	 * Test that requireTypeMatch() allows null regardless of the named member's type
	 */
	public function testThatRequireTypeMatchAllowsNull() {
		$classExt = new STClassExtended();
		$res = $classExt->requireTypeMatch('privateProperty1', $v = null);
		$this->assertTrue(is_object($res));
	}

	/**
	 * Test that requireTypeMatch() allows matching types
	 */
	public function testThatRequireTypeMatchAllowsMatchingTypes() {
		$classExt = new STClassExtended();

		// Simple type direct comparison...
		$res = $classExt->requireTypeMatch('privateProperty1', $v = 'Cherry Pie');
		$this->assertTrue(is_object($res));

		// Class type, computed comparison...
		$classExt->publicObject = new \StdClass();
		$res = $classExt->requireTypeMatch('publicObject', $v = new \StdClass());
		$this->assertTrue(is_object($res));
	}

	/**
	 * Test that isLegalName() accepts only legal names
	 */
	public function testThatIsLegalNameAcceptsOnlyLegalNames() {
		$classExt = new STClassExtended();
		$this->assertTrue($classExt->isLegalName('apple'));
		$this->assertTrue($classExt->isLegalName('Banana'));
		$this->assertTrue($classExt->isLegalName('_'));
		$this->assertTrue($classExt->isLegalName('_2_0_1_4_'));
		$this->assertFalse($classExt->isLegalName(1));
		$this->assertFalse($classExt->isLegalName('1'));
		$this->assertFalse($classExt->isLegalName('1orange'));
		$this->assertFalse($classExt->isLegalName('fig-newton'));
	}

	/**
	 * Test that isLegalType() accepts only legal types
	 */
	public function testThatIsLegalTypeAcceptsOnlyLegalTypes() {
		$classExt = new STClassExtended();
		$this->assertFalse($classExt->isLegalType(1));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_STRING));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_INTEGER));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_DOUBLE));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_BOOLEAN));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_RESOURCE));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_OBJECT));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_ARRAY));
		$this->assertTrue($classExt->isLegalType(ST_TYPE_FUNCTION));
		$this->assertTrue($classExt->isLegalType('class:StdClass'));
		$this->assertTrue($classExt->isLegalType('class:PHPGoodies\STClassExtended'));
		$this->assertFalse($classExt->isLegalType('bogus type'));
		$this->assertFalse($classExt->isLegalType('class:bogusClassName'));
	}

	/**
	 * Test that isLegalScope() accepts only legal scopes
	 */
	public function testThatIsLegalScopeAcceptsOnlyLegalScopes() {
		$classExt = new STClassExtended();
		$this->assertFalse($classExt->isLegalScope(1));
		$this->assertFalse($classExt->isLegalScope('bogus scope'));
		$this->assertTrue($classExt->isLegalScope(ST_SCOPE_ANY));
		$this->assertTrue($classExt->isLegalScope(ST_SCOPE_PUBLIC));
		$this->assertTrue($classExt->isLegalScope(ST_SCOPE_PRIVATE));
	}

	/**
	 * Test that adding function members work as expected
	 */
	public function testThatAddingFunctionMembersWorkAsExpected() {
		$classExt = new STClassExtended();

		// Define a public function
		$res = $classExt->addClassMember(
			'publicFunc',
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PUBLIC,
			function () {
				return true;
			}
		);
		$this->assertTrue(is_object($res));
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];
		$this->assertTrue(isset($classMembers['publicFunc']));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers['publicFunc']->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $classMembers['publicFunc']->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers['publicFunc']->returnType);

		// Define a private function
		$res = $classExt->addClassMember(
			'privateFunc',
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PRIVATE,
			function () {
				return true;
			}
		);
		$this->assertTrue(is_object($res));
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];
		$this->assertTrue(isset($classMembers['privateFunc']));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers['privateFunc']->type);
		$this->assertEquals(ST_SCOPE_PRIVATE, $classMembers['privateFunc']->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers['privateFunc']->returnType);

		// Try to reassign the public function some new code...
		$res = $classExt->set(
			'publicFunc',
			function () {
				return false;
			}
		);
		$this->assertTrue(is_object($res));
	}

	/**
	 * Test that adding a function, the member is callable; exercises __call() magic function
	 */
	public function testThatAddingFunctionMemberIsCallable() {
		$class = new STClass();

		// Define a public function
		$res = $class->add(
			'publicFunc',
			function ($value) {
				return $value;
			},
			ST_TYPE_BOOLEAN
		);
		$this->assertTrue(is_object($res));
		$this->assertTrue($class->publicFunc(true));
		$this->assertFalse($class->publicFunc(false));
	}

	/**
	 * Test that ading a private function, the member is NOT externally callable
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 */
	public function testThatAddingFunctionPrivateMemberIsNotExternallyCallable() {
		$classExt = new STClassExtended();

		// Define a private function
		$res = $classExt->addClassMember(
			'privateFunc',
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PRIVATE,
			function ($value) {
				return $value;
			}
		);

		// Verify that it's callable privately...
		$this->assertTrue($classExt->call('privateFunc', array(true)));
		$this->assertFalse($classExt->call('privateFunc', array(false)));

		// Now trigger our error by trying to call the private function from the outside.
		$classExt->privateFunc(true);
	}

	/**
	 * Test that adding a function, the return value is type-enforced
	 *
	 * @expectedException UnexpectedValueException
	 */
	public function testThatAddingFunctionReturnValueIsTypeEnforced() {
		$class = new STClass();

		// Define a public function
		$class->add(
			'publicFunc',
			function ($value) {
				return $value;
			},
			ST_TYPE_BOOLEAN
		);

		// Jelly beans are, most decidedly, neither true, nor false
		$class->publicFunc('Jelly Beans');
	}
}

/**
 * Extends and populates STClass as it would be in a normal application
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

