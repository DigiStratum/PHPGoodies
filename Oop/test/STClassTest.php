<?php
/**
 * PHPGoodies:STClass class test cases
 *
 * @groups basic, types, data, magic, scope, names, functions
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
	 *
	 * @group basic
	 */
	public function testThatSTClassIsInstantiable() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$this->assertTrue(is_object($class));
		$this->assertTrue($class instanceof STClass);
	}

	/**
	 * Test that added public properties are accessible internally and externally
	 *
	 * @group data
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
	 *
	 * @group types
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
	 *
	 * @group types
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
	 *
	 * @group data
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
	 *
	 * @group names
	 */
	public function testThatInvalidPropertyNamesAddedAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('42', 42);
	}

	/**
	 * Test that additions with invalid types are rejected
	 *
	 * @expectedException InvalidArgumentException
	 *
	 * @group types
	 */
	public function testThatInvalidTypesAddedAreRejected() {
		$class = PHPGoodies::instantiate('Oop.STClass');
		$class->add('fortyTwo', 42, 'Baloney Sandwich');
	}

	/**
	 * Test that an extended STClass gets the expected classMembers set up
	 *
	 * @group data
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
	 *
	 * @group magic
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
	 *
	 * @group data
	 */
	public function testThatGettingNonexistentMemberIsRejected() {
		$class = new STClass();
		$value = $class->nonexistentMember;
	}

	/**
	 * Test that attempts to get an inaccessible member are rejected
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 *
	 * @group scope
	 */
	public function testThatGettingInaccessibleMemberIsRejected() {
		$classExt = new STClassExtended();
		$value = $classExt->privateProperty1;
	}

	/**
	 * Test that attempts to unset a nonexistent member are rejected
	 *
	 * @expectedException PHPGoodies\MemberDoesNotExistException
	 *
	 * @group data
	 */
	public function testThatUnsettingNonexistentMemberIsRejected() {
		$class = new STClass();
		unset($class->nonexistentMember);
	}

	/**
	 * Test that attempts to unset an inaccessible member are rejected
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 *
	 * @group scope
	 */
	public function testThatUnsettingInaccessibleMemberIsRejected() {
		$classExt = new STClassExtended();
		unset($classExt->privateProperty1);
	}

	/**
	 * Test that getType returns expected types
	 *
	 * @group types
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
	 *
	 * @group types
	 */
	public function testThatRequireTypeMatchRequiresMemeberToExist() {
		$classExt = new STClassExtended();
		$classExt->requireTypeMatch('nonexistentProperty', $v = 'Gummi Bears');
	}

	/**
	 * Test that requireTypeMatch() allows null regardless of the named member's type
	 *
	 * @group types
	 */
	public function testThatRequireTypeMatchAllowsNull() {
		$classExt = new STClassExtended();
		$res = $classExt->requireTypeMatch('privateProperty1', $v = null);
		$this->assertTrue(is_object($res));
	}

	/**
	 * Test that requireTypeMatch() allows matching types
	 *
	 * @group types
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
	 *
	 * @group names
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
	 *
	 * @group types
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
	 *
	 * @group scope
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
	 * Test that adding function members (without prototypes) work as expected
	 *
	 * @group functions
	 */
	public function testThatAddingFunctionMembersWorkAsExpected() {
		$classExt = new STClassExtended();

		// Define a public function
		$protoname = $prototype = $classExt->makePrototype('publicFunc', array(), true);
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
		$this->assertTrue(isset($classMembers[$protoname]));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers[$protoname]->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $classMembers[$protoname]->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers[$protoname]->returnType);
		$this->assertEquals($prototype, $classMembers[$protoname]->prototype);

		// Define a private function
		$protoname = $prototype = $classExt->makePrototype('privateFunc', array(), true);
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
		$this->assertTrue(isset($classMembers[$protoname]));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers[$protoname]->type);
		$this->assertEquals(ST_SCOPE_PRIVATE, $classMembers[$protoname]->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers[$protoname]->returnType);
		$this->assertEquals($prototype, $classMembers[$protoname]->prototype);

		// Try to redefine the public function with new code...
		$res = $classExt->set(
			$protoname,
			function () {
				return false;
			}
		);
		$this->assertTrue(is_object($res));
	}

	/**
	 * Test that a function being added with a prototype shows up with the expected details
	 *
	 * @group functions
	 */
	public function testThatAddingFunctionWithPrototypeLooksAsExpected() {
		$classExt = new STClassExtended();

		// Define a public function
		$func = 'publicFunc';
		$protoname = $prototype = $classExt->makePrototype($func, array(ST_TYPE_BOOLEAN));
		$res = $classExt->addClassMember(
			$func,
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PUBLIC,
			function ($value) {
				return $value;
			},
			$prototype
		);
		$this->assertTrue(is_object($res));
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];
		$this->assertTrue(isset($classMembers[$protoname]));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers[$protoname]->type);
		$this->assertEquals(ST_SCOPE_PUBLIC, $classMembers[$protoname]->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers[$protoname]->returnType);
		$this->assertEquals($prototype, $classMembers[$protoname]->prototype);

		// Define a private function
		$func = 'privateFunc';
		$protoname = $prototype = $classExt->makePrototype($func, array(ST_TYPE_BOOLEAN));
		$res = $classExt->addClassMember(
			$func,
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PRIVATE,
			function () {
				return true;
			},
			$prototype
		);
		$this->assertTrue(is_object($res));
		$data = $classExt->spy();
		$classMembers =& $data['classMembers'];
		$this->assertTrue(isset($classMembers[$protoname]));
		$this->assertEquals(ST_TYPE_FUNCTION, $classMembers[$protoname]->type);
		$this->assertEquals(ST_SCOPE_PRIVATE, $classMembers[$protoname]->scope);
		$this->assertEquals(ST_TYPE_BOOLEAN, $classMembers[$protoname]->returnType);
		$this->assertEquals($prototype, $classMembers[$protoname]->prototype);
	}

	/**
	 * Test that adding a (non-prototyped) function, the member is callable; exercises __call() magic function
	 *
	 * @group functions
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
	 * Test that adding a (prototyped) function, the member is callable
	 *
	 * @group functions
	 */
	public function testThatAddingPrototypedFunctionMemberIsCallable() {
		$classExt = new STClassExtended();

		// Define a public function
		$func = 'publicFunc';
		$protoname = $prototype = $classExt->makePrototype($func, array(ST_TYPE_BOOLEAN));
		$res = $classExt->addClassMember(
			$func,
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PUBLIC,
			function ($value) {
				return $value;
			},
			$prototype
		);
		$this->assertTrue(is_object($res));
		$this->assertTrue($classExt->publicFunc(true));
		$this->assertFalse($classExt->publicFunc(false));
	}

	/**
	 * Test that adding a (prototyped) function, the member rejects calls not matching the prototype
	 *
	 * @expectedException BadMethodCallException
	 *
	 * @group functions
	 */
	public function testThatAddingPrototypedFunctionMemberMismatchedCallsAreRejected() {
		$classExt = new STClassExtended();

		// Define a public function
		$func = 'publicFunc';
		$protoname = $prototype = $classExt->makePrototype($func, array(ST_TYPE_BOOLEAN));
		$res = $classExt->addClassMember(
			$func,
			ST_TYPE_BOOLEAN,
			ST_SCOPE_PUBLIC,
			function ($value) {
				return $value;
			},
			$prototype
		);
		$this->assertTrue(is_object($res));
		$this->assertTrue($classExt->publicFunc(1));
	}

	/**
	 * Test that ading a private function, the member is NOT externally callable
	 *
	 * @expectedException PHPGoodies\AccessDeniedException
	 *
	 * @group functions
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
	 *
	 * @group functions
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

	/**
	 * Test that adding a function, once added, it cannot be reassigned to null
	 *
	 * @expectedException InvalidArgumentException
	 *
	 * @group functions
	 */
	public function testThatAddingFunctionNullAssignmentIsRejected() {
		$class = new STClass();

		// Define a public function
		$class->add(
			'publicFunc',
			function ($value) {
				return $value;
			},
			ST_TYPE_BOOLEAN
		);

		$class->publicFunc = null;
	}

	/**
	 * Test that a public function may be unset
	 *
	 * @expectedException BadMethodCallException
	 *
	 * @group functions
	 */
	public function testThatUnsettingPublicFunctionIsAllowed() {
		$classExt = new STClassExtended();

		$func = 'publicFunc';
		$prototype = $classExt->makePrototype($func, array(ST_TYPE_BOOLEAN));

		// Define a public function
		$classExt->add(
			$func,
			function ($value) {
				return $value;
			},
			ST_TYPE_BOOLEAN,
			$prototype
		);

		$this->assertTrue($classExt->publicFunc(true));

		unset($classExt->$func);
		$classExt->publicFunc(false);
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

	// Expose all the protected methods of STClass
	public function getType() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function requireMember() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function requireTypeMatch() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function isLegalName() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function isLegalType() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function isLegalScope() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function addClassMember() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function hasClassMember() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function &getClassMember() {
		$res = call_user_func_array(array('parent', __FUNCTION__), func_get_args());
		return $res;
	}

	public function isClassMemberScopeAccessible() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function requireAccess() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function isFunction() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function requireFunction() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function set() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function call() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function has() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function chk() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function get() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function del() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function makePrototype() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}

	public function findProtoname() {
		return call_user_func_array(array('parent', __FUNCTION__), func_get_args());
	}
}

