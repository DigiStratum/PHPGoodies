<?php
/**
 * PHPGoodies:GlobalAttributes - A collection of attribute traits global to all HTML elements
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

require_once(realpath(dirname(__FILE__) . '/../../PHPGoodies.php'));

// HTML4 Attributes
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ClassAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DirAttribute');
PHPGoodies::import('Lib.Dom.Attributes.IdAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LangAttribute');
PHPGoodies::import('Lib.Dom.Attributes.NodeAttribute');
PHPGoodies::import('Lib.Dom.Attributes.StyleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TitleAttribute');

// HTML5 Attributes
PHPGoodies::import('Lib.Dom.Attributes.ContentEditable');
PHPGoodies::import('Lib.Dom.Attributes.ContextMenu');
PHPGoodies::import('Lib.Dom.Attributes.Draggable');
PHPGoodies::import('Lib.Dom.Attributes.DropZone');
PHPGoodies::import('Lib.Dom.Attributes.Hidden');
PHPGoodies::import('Lib.Dom.Attributes.SpellCheck');
PHPGoodies::import('Lib.Dom.Attributes.Translate');

/**
 * GlobalAttributes - A collection of attribute traits global to all HTML elements
 */
trait GlobalAttributes {

	// HTML4
	use AccessKeyAttribute, ClassAttribute, DirAttribute, IdAttribute, LangAttribute, NodeAttribute, StyleAttribute, TabIndexAttribute, TitleAttribute;

	// HTML5
	use ContentEditable, ContextMenu, Draggable, DropZone, Hidden, SpellCheck, Translate;
}

