<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Controller - JSON:API Endpoint Service Layer
 *
 * The purpose of an endpoint service layer is provice an implementation which is HTTP agnostic - it
 * should not make any effort to expect HTTP requests or return anything special to suggest an HTTP
 * response. The controller does all the adapting between HTTP REST requests/responses and Service.
 *
 * @uses Oop_Type
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');

/**
 *  * JSON:API Endpoint Service Layer
 *   */
interface Lib_Net_Api_Rest_JsonApi_Server_Service {
	public function create($variables);
	public function retrieve($variables);
	public function update($variables);
	public function delete($variables);
	public function replace($variables);
	public function getMetaData($variables);
}

