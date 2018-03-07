<?php
/**
 * PHPGoodies:Lib_File_Json class test cases
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('test.TestFramework.TestCase');

class Lib_File_Json_Test extends test_TestFramework_TestCase {

	protected $sut;

	/**
	 * Setup to occur ahead of each test method invocation
	 */
	public function setup() {
		$this->sut = PHPGoodies::instantiate('Lib.File.Json');
	}

	/**
	 * Teardown to occur after each test method invocation
	 */
	public function teardown() {
	}

	public function testThatComposeJsonPassesThroughNull() {
		$res = $this->sut->composeJson(null);
		$this->assertNull($res);
	}

	public function testThatComposeJsonReturnsEmptyStringAsNull() {
		$res = $this->sut->composeJson('');
		$this->assertNull($res);
	}

	public function testThatComposeJsonParsesEmptyObject() {
		$res = $this->sut->composeJson('{}');
		$this->assertTrue(is_object($res));
	}

	public function testThatComposeJsonPassesThroughObjectPrimitives() {
		$res = $this->sut->composeJson('{"string":"value","int":1,"float":3.14159,"bool":true}');
		$this->assertTrue(is_object($res));
		$this->assertEquals("value", $res->string);
		$this->assertEquals(1, $res->int);
		$this->assertEquals(3.14159, $res->float);
		$this->assertEquals(true, $res->bool);
	}

	public function testThatComposeJsonPassesThroughObjectObjects() {
		$res = $this->sut->composeJson('{"obj":{"string":"value"}}');
		$this->assertTrue(is_object($res));
		$this->assertTrue(is_object($res->obj));
		$this->assertEquals("value", $res->obj->string);
	}

	public function testThatComposeJsonPassesThroughObjectArrays() {
		$res = $this->sut->composeJson('{"arr":["value",1,3.14159,true]}');
		$this->assertTrue(is_object($res));
		$this->assertTrue(is_array($res->arr));
		$this->assertEquals("value", $res->arr[0]);
		$this->assertEquals(1, $res->arr[1]);
		$this->assertEquals(3.14159, $res->arr[2]);
		$this->assertEquals(true, $res->arr[3]);
	}

	public function testThatComposeJsonParsesEmptyArray() {
		$res = $this->sut->composeJson('[]');
		$this->assertTrue(is_array($res));
	}

	public function testThatComposeJsonPassesThroughArrayObjects() {
		$res = $this->sut->composeJson('[{"name":0},{"name":1}]');
		$this->assertTrue(is_array($res));
		$this->assertTrue(is_object($res[0]));
		$this->assertTrue(is_object($res[1]));
		$this->assertEquals(0, $res[0]->name);
		$this->assertEquals(1, $res[1]->name);
	}

	// TODO: Test composition of files now!
}

