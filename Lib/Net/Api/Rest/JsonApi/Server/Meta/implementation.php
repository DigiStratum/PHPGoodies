<?php
/**
 * PHPGoodies:Lib_Api_Rest_JsonApi_Server_Meta - JSON:API Meta class for non-standard information in documents
 *
 * This class is of questionable value; it's just a renamed Hash class, so maybe we should just allow the Hash
 * class directly wherever this is used?
 *
 * @uses Lib_Data_Hash
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Data.Hash');

/**
 * JSON:API Meta class for non-standard information in documents
 */
class Lib_Net_Api_Rest_JsonApi_Server_Meta extends Lib_Data_Hash { }

