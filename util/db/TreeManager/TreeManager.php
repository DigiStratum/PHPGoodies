<?php
/**
 * PHPGoodies:TreeManager - A class for managing "tree" type database tables
 *
 * For purposes of this utility, we will consider a "tree" type database table to be one which is
 * self-referential via an "fk_parent" field which links to the parent node in the tree where any
 * root nodes have null for fk_parent.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require(realpath(dirname(__FILE__) . '/../../../PHPGoodies.php'));

/**
 *
 */
class TreeManager {
}

