<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Resource - Class interface for Resources
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * JSON:API Resource Interface
 */
interface Lib_Net_Api_Rest_JsonApi_Resource {
	public function create();
	public function retrieve();
	public function update();
	public function delete();
	public function validate();
	public function toJson();
	public function fromJson($json);
}

