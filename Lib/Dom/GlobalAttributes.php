<?php
/**
 * PHPGoodies:GlobalAttributes - A collection of attribute traits global to all HTML elements
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

// HTML4 Attributes
PHPGoodies::import('Lib.Dom.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.ClassAttribute');
PHPGoodies::import('Lib.Dom.DirAttribute');
PHPGoodies::import('Lib.Dom.IdAttribute');
PHPGoodies::import('Lib.Dom.LangAttribute');
PHPGoodies::import('Lib.Dom.NodeAttribute');
PHPGoodies::import('Lib.Dom.StyleAttribute');
PHPGoodies::import('Lib.Dom.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.TitleAttribute');

// HTML5 Attributes
PHPGoodies::import('Lib.Dom.ContentEditable');
PHPGoodies::import('Lib.Dom.ContextMenu');
PHPGoodies::import('Lib.Dom.Draggable');
PHPGoodies::import('Lib.Dom.DropZone');
PHPGoodies::import('Lib.Dom.Hidden');
PHPGoodies::import('Lib.Dom.SpellCheck');
PHPGoodies::import('Lib.Dom.Translate');

/**
 * GlobalAttributes - A collection of attribute traits global to all HTML elements
 */
trait GlobalAttributes {

	// HTML4
	use AccessKeyAttribute, ClassAttribute, DirAttribute, IdAttribute, LangAttribute, NodeAttribute, StyleAttribute, TabIndexAttribute, TitleAttribute;

	// HTML5
	use ContentEditable, ContextMenu, Draggable, DropZone, Hidden, SpellCheck, Translate;
}

