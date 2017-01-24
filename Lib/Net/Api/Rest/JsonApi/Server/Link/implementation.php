<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Link - JSON:API Link class for response documents
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Net.Api.Rest.JsonApi.Server.Member');

/**
 * JSON:API Link class for response documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Link implements \JsonSerializable {

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
	 * @param $name String name for this link (must be a valid class property name)
	 * @param $href String HREF/URI for this link
	 * @param $meta Mixed object/primitive (anything other than a resource) (optional)
	 */
	public function __construct(string $name, string $href, $meta = null) {

		// Let's just use our own MemberName checker
		if (! Lib_Net_Api_Rest_JsonApi_Server_Member::isValidMemberName($name)) {
			throw new \Exception("Invalid JSON:API link name: '{$name}'");
		}

		// Is our HREF good?
		if (0 === strlen($href)) {
			throw new \Exception("Invalid JSON:API link href: '{$href}'");
		}

		$this->name = $name;
		$this->href = $href;
		$this->meta = $meta;
	}

	/**
	 * Getter for the name
	 *
	 * @return String $name for this link
	 */
	public function getName() {
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

