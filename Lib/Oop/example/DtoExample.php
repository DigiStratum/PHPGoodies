<?php
/**
 * PHPGoodies DtoExample.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Dto as Dto;

// 2) Load up our goodies
require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));
PHPGoodies::import('Lib.Oop.Dto');

/**
 * Message Dto
 */
class MessageDto extends Dto {
	
	/**
	 * Constructor
	 *
	 * @param integer $code The numeric message code
	 * @param string $message Plain text message
	 */
	public function __construct($code, $message) {

		// Define the valid properties for this DTO
		parent::__construct(array(
			'code',
			'message'
		));

		$this->setCode($code);
		$this->setMessage($message);
	}

	/**
	 * Code property setter
	 *
	 * @param integer $code The numeric message code
	 */
	public function setCode($code) {
		$this->_set('code', $code);
	}

	/**
	 * Message property setter
	 *
	 * @param string $message Plain text message
	 */
	public function setMessage($message) {
		$this->_set('message', $message);
	}
}

$response = new MessageDto(200, 'OK');
print $response->toJson() . "\n\n";

