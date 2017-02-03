<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Link - JSON:API Link class for response documents
 *
 * @uses Oop_Type
 * @uses Lib_Data_Collection_Keyed_Item
 * @uses Lib_Net_Api_Rest_JsonApi_Server_Member
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Oop.Type');
PHPGoodies::import('Lib.Data.Collection.Keyed.Item');
PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Member');

/**
 * JSON:API Link class for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Link implements Lib_Data_Collection_Keyed_Item, \JsonSerializable {

	/**
	 * Name for this link
	 */
	protected $name;

	/**
	 * Href for this link
	 */
	protected $href;

	/**
	 * Non-standard metadata for this link
	 */
	protected $meta;

	/**
	 * Constructor
	 *
	 * @param string $name name for this link (must be a valid class property name)
	 * @param string $href HREF/URI for this link
	 * @param object $meta Non-standard metadata about this link
	 */
	public function __construct($name, $href, $meta = null) {
		$this->name = Oop_Type::requireType($name, 'string');
		$this->href = Oop_Type::requireType($href, 'string');
		$this->meta = Oop_Type::optionalType($meta, 'class:Lib_Net_Api_Rest_JsonApi_Server_Meta');

		// Let's just use our own MemberName checker
		if (! Lib_Net_Api_Rest_JsonApi_Server_Member::isValidMemberName($name)) {
			throw new \Exception("Invalid JSON:API link name: '{$name}'");
		}

		// Is our HREF good?
		if (0 === strlen($href)) {
			throw new \Exception("Invalid JSON:API link href: '{$href}'");
		}
	}

	/**
	 * For Lib_Data_Collection_Keyed_Item interface...
	 */
	public function getKey() {
		return $this->name;
	}

	/**
	 * JsonSerializable Json Serializer
	 *
	 * @return Associative array of properties which will be encoded as the JSON representation
	 * of object instances of this class
	 */
	public function jsonSerialize() {
		return [
			'href' => $this->href,
			'meta' => $this->meta
		];
	}
}

