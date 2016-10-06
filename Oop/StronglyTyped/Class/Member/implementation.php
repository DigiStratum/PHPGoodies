<?php
/**
 * PHPGoodies:Oop_StronglyTyped_Class_Member - A 'Strongly Typed' class member
 *
 * Initially ClassMembers of Oop_StronglyTyped_Class had only four basic properties which was easy
 * to handle with a generic object. But now we are adding more properties which this class will help
 * us keep nice and neat.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

const ST_ENFORCEMENT_DISABLED	= 'disabled';
const ST_ENFORCEMENT_STRICT	= 'strict';

/**
 * A 'Strongly Typed' class member
 */
class Oop_StronglyTyped_Class_Member {

	public $enforcement = ST_ENFORCEMENT_STRICT;
	public $isNullable = true;

	public $name;
	public $type;
	public $scope;
	public $value = null;

	// For functions
	public $returnType;
	public $prototype = null;

	/**
	 * Constructor
	 */
	public function __construct($name, $scope, $type, $returnType = null, $prototype = null) {
		$this->name = $name;
		$this->scope = $scope;
		$this->type = $type;
		$this->returnType = $returnType;

		// For functions, we have more work to do...
		if ($type == ST_TYPE_FUNCTION) {

			// Once created, we don't allow assigning them to null; this would replace
			// the working code with something non-callable and cause big-badda-boom if
			// invoked. If the user no longer wants the function, the correct thing to
			// do is to unset() it to get rid of it.
			$this->isNullable = false;

			// If no prototype was supplied then we'll generate a default which will
			// make it match any request; ad hoc polymorphism will be allowed, but this
			// will be the last thing to match if there are other more specific versions
			if (is_null($prototype)) {
				// Permit normal PHP behavior by allowing any arguments passed...
				$this->prototype = $name . '(' . ST_TYPE_VARARGS . ')';
			}
			else $this->prototype = $prototype;
		}
	}
}
