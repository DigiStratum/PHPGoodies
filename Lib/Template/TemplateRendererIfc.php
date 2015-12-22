<?php
/**
 * PHPGoodies:TemplateRendererIfc - Class interface for rendering text templates
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * TemplateRendererIfc - Class interface for rendering text templates
 */
interface TemplateRendererIfc {

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

