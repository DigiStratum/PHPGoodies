<?php
/**
 * PHPGoodies:Lib_Template_Renderer - Class interface for rendering text templates
 *
 * The idea here is that we can supply some form of text-encoded template along with a data object
 * and that the implenting renderer class will transform the data according to the template and the
 * custom logic of that renderer. The logic of the renderer could convert plain text, html, xml, or
 * any other format desired.
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Lib_Template_Renderer - Class interface for rendering text templates
 */
interface Lib_Template_Renderer {

	/**
	 * Render the supplied template using the supplied data
	 *
	 * @param $template String text template to inject with properties from the data
	 * @param $data Object whose properties are available to the template renderer
	 *
	 * @return string rendered result of injecting the data into the template
	 */
	public function render(&$template, &$data);
}

