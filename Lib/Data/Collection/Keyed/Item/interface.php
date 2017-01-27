<?php
/**
 * PHPGoodies:Lib_Data_Collection_Keyed_Item - An interface required for Collection_Keyed objects
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * An interface required for Collection_Keyed objects
 */
interface Lib_Data_Collection_Keyed_Item {

	/**
	 * Return the unique identifier key for this object
	 *
	 * @return string key for this object
	 */
	public function getKey();
}

