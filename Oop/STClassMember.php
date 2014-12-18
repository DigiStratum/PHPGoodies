<?php
/**
 * PHPGoodies:STClassMember - A 'Strongly Typed' class member
 *
 * Initially ClassMembers of STClass had only four basic properties which was easy to handle with a
 * generic object. But now we are adding more properties which this class will help us keep nice and
 * neat.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

const ST_ENFORCEMENT_DISABLED	= 'disabled';
const ST_ENFORCEMENT_STRICT	= 'strict';

/**
 * A 'Strongly Typed' class member
 */
class STClassMember {

	public $enforcement = ST_ENFORCEMENT_STRICT;
	public $isNullable = true;

	public $type;
	public $scope;
	public $value = null;

	// For functions
	public $returnType;

	/**
	 * Constructor
	 */
	public function __construct($scope, $type, $returnType) {
		$this->scope = $scope;
		$this->type = $type;
		$this->returnType = $returnType;
		if ($type == ST_TYPE_FUNCTION) {
			$this->isNullable = false;
		}
	}
}
