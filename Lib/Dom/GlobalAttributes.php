<?php
/**
 * PHPGoodies:GlobalAttributes - A collection of attribute traits global to all HTML elements
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies::import('Lib.Dom.NodeAttribute');

// HTML4 Attributes
PHPGoodies::import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ClassAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DirAttribute');
PHPGoodies::import('Lib.Dom.Attributes.IdAttribute');
PHPGoodies::import('Lib.Dom.Attributes.LangAttribute');
PHPGoodies::import('Lib.Dom.Attributes.StyleAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TitleAttribute');

// HTML5 Attributes
PHPGoodies::import('Lib.Dom.Attributes.ContentEditableAttribute');
PHPGoodies::import('Lib.Dom.Attributes.ContextMenuAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DraggableAttribute');
PHPGoodies::import('Lib.Dom.Attributes.DropZoneAttribute');
PHPGoodies::import('Lib.Dom.Attributes.HiddenAttribute');
PHPGoodies::import('Lib.Dom.Attributes.SpellCheckAttribute');
PHPGoodies::import('Lib.Dom.Attributes.TranslateAttribute');

/**
 * GlobalAttributes - A collection of attribute traits global to all HTML elements
 */
trait GlobalAttributes {

	// HTML4
	use AccessKeyAttribute, ClassAttribute, DirAttribute, IdAttribute, LangAttribute;
       	use StyleAttribute, TabIndexAttribute, TitleAttribute;

	// HTML5
	use ContentEditableAttribute, ContextMenuAttribute, DraggableAttribute, DropZoneAttribute;
       	use HiddenAttribute, SpellCheckAttribute, TranslateAttribute;
}

