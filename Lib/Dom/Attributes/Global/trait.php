<?php
/**
 * PHPGoodies:Lib_Dom_Attributes_GlobalAttributes - A collection of attribute traits global to all HTML elements
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.NodeAttribute');

// HTML4 Attributes
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.AccessKeyAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.ClassAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.DirAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.IdAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.LangAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.StyleAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.TabIndexAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.TitleAttribute');

// HTML5 Attributes
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.ContentEditableAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.ContextMenuAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.DraggableAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.DropZoneAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.HiddenAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.SpellCheckAttribute');
PHPGoodies:Lib_Dom_Attributes_:import('Lib.Dom.Attributes.TranslateAttribute');

/**
 * GlobalAttributes - A collection of attribute traits global to all HTML elements
 */
trait Lib_Dom_Attributes_GlobalAttributes {

	// HTML4
	use AccessKeyAttribute, ClassAttribute, DirAttribute, IdAttribute, LangAttribute;
       	use StyleAttribute, TabIndexAttribute, TitleAttribute;

	// HTML5
	use ContentEditableAttribute, ContextMenuAttribute, DraggableAttribute, DropZoneAttribute;
       	use HiddenAttribute, SpellCheckAttribute, TranslateAttribute;
}

