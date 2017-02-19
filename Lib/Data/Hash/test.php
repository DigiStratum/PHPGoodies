<?php
/**
 * PHPGoodies:Lib_Data_Hash class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

class Lib_Data_Hash_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * Constructor
	 */
	public function __construct() {
		PHPGoodies::import('Lib.Data.Hash');
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
	 * Test that newly instantiated Hash has no data in it
	 */
	public function testThatNewHashIsEmpty() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$this->assertEquals(0, $hash->num());
		$this->assertEquals(0, count($hash->keys()));
	}

	/**
	 * Test that a new hash with a single item added to it shows up in the count
	 */
	public function testThatNewHashSingleItemCounted() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash->set('name', 'value');
		$this->assertEquals(1, $hash->num());
		$this->assertEquals(1, count($hash->keys()));
	}

	/**
	 * Test that a hash with a single item goes empty when the item is deleted
	 */
	public function testThatSingleItemHashGoesEmptyWhenDeleted() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		// Set/chain
		$hasIt = $hash->set('name', 'value')->has('name');
		$this->assertTrue($hasIt);
		$this->assertEquals(1, $hash->num());

		// Del/chain
		$hasIt = $hash->del('name', 'value')->has('name');
		$this->assertFalse($hasIt);
		$this->assertEquals(0, $hash->num());
	}

	/**
	 * Test that a set item may be identically retrieved
	 */
	public function testThatASetItemGetsIdenticalValue() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$value = $hash->set('name', 'value')->get('name');
		$this->assertEquals('value', $value);
		$this->assertTrue(in_array('name', $hash->keys()));
	}

	/**
	 * Test that hash empties out correctly
	 */
	public function testThatHashEmptiesOut() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		// Set several/check
		$num = $hash->set('n1', 'v1')->set('n2', 'v2')->set('n3', 'v3')->num();
		$this->assertEquals(3, $num);

		// Empty/check
		$num = $hash->nil()->num();
		$this->assertEquals(0, $num);
		$this->assertEquals(0, count($hash->keys()));
	}

	/**
	 * Test that raw hash returns expected array contents
	 */
	public function testThatHashReturnsExpectedArrayContents() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');

		for ($xx = 0; $xx < 10; $xx++) $hash->set("n{$xx}", "v{$xx}");
		$num = $hash->num();
		$this->assertEquals(10, $num);

		$all = $hash->all();

		for ($xx = 0; $xx < 10; $xx++) {
			$this->assertTrue(isset($all["n{$xx}"]));
			$this->assertEquals("v{$xx}", $all["n{$xx}"]);
		}
	}

	/**
	 * Test that putting an array into the hash results in exactly that number of elements and all items retrievable with expected value
	 */
	public function testThatPuttingArrayContentsIsHandledProperly() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$all = array();
		for ($xx = 0; $xx < 10; $xx++) $all["n{$xx}"] = "v{$xx}";

		$hash->put($all);
		$num = $hash->num();
		$this->assertEquals(10, $num);

		foreach ($all as $name => $expected) {
			$this->assertTrue($hash->has($name));
			$this->assertEquals($expected, $hash->get($name));
		}
	}

	/**
	 * Test that merging in another hash does so by replacing duplicate keys by default
	 */
	public function testThatMergeReplacesDuplicatKeys() {
		$hash1 = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash2 = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash1->set('key1', 'value1');
		$hash1->set('key2', 'original');
		$hash2->set('key2', 'replaced');
		$hash2->set('key3', 'value3');
		$hash1->merge($hash2);
		$this->assertEquals(3, $hash1->num());
		$this->assertTrue($hash1->has('key1'));
		$this->assertEquals('value1', $hash1->get('key1'));
		$this->assertTrue($hash1->has('key2'));
		$this->assertEquals('replaced', $hash1->get('key2'));
		$this->assertTrue($hash1->has('key3'));
		$this->assertEquals('value3', $hash1->get('key3'));
	}

	/**
	 * Test that merging in another hash does so by skipping duplicate keys by request
	 */
	public function testThatMergeSkipsDuplicatKeys() {
		$hash1 = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash2 = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash1->set('key1', 'value1');
		$hash1->set('key2', 'original');
		$hash2->set('key2', 'replaced');
		$hash2->set('key3', 'value3');
		$hash1->merge($hash2, false);
		$this->assertEquals(3, $hash1->num());
		$this->assertTrue($hash1->has('key1'));
		$this->assertEquals('value1', $hash1->get('key1'));
		$this->assertTrue($hash1->has('key2'));
		$this->assertEquals('original', $hash1->get('key2'));
		$this->assertTrue($hash1->has('key3'));
		$this->assertEquals('value3', $hash1->get('key3'));
	}

	/**
	 * Test that the Iterator interface behaves as expected
	 */
	public function testThatIteratorInterfaceWorks() {
		$hash = PHPGoodies::instantiate('Lib.Data.Hash');
		$hash->set('key1', 'value1');
		$hash->set('key2', 'value2');
		$n = 0;
		foreach ($hash as $key => $value) {
			switch ($n++) {
				case 0:
					$this->assertEquals($key, 'key1');
					$this->assertEquals($value, 'value1');
					break;

				case 1:
					$this->assertEquals($key, 'key2');
					$this->assertEquals($value, 'value2');
					break;

				default:
					// If we got here then the iterator returned
					// something we didn't expect to exist!
					$this->assertTur(false);
			}
		}
	}
}

