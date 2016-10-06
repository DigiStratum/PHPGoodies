<?php
/**
 * PHPGoodies:Mustache - Mustache templating class
 *
 * ref: https://mustache.github.io/
 *
 * Note that to start, this will just be a partial implementation of the capabilities called out by
 * Mustache logicless templates specifications. There is at least one other PHP implementation of
 * Mustache templating out there, however one look at the source code made it clear that it was too
 * complicated. Here I attempt to get the same results with a simpler solution...
 *
 * PLAN B:
 *
 * Process the entire template and create a nested stack (partly stack, partly tree) to show order
 * and containment of the tags. So if section A comes BEFORE section B, then A.next = B (and B.prev
 * = A); if section C is INSIDE of B, then B.child = C (and C.parent = B); if section D is also
 * inside B, then C.next = D and D.prev = C.
 *
 * @uses Lib_Template_Renderer
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

/*
ref: https://github.com/janl/mustache.js
{{#section1}}
	section block
	{{escapedVariable1}}
	{{{unescapedVariable2}}}
	{{&unescapedVariable3}}
	{{=<% %>=}}
		{{delimiter changed}}
	<%={{ }}=%>
	{{#stringArray}}
		{{.}}
	{{/stringArray}}
	{{#objectCollection}}
		{{filterFunction}}
	{{/objectCollection}}
{{/section1}}
{{^invertedSection2}}
	section block
	{{! ignored comment}}
	{{> partialReference}}
{{/invertedSection2}}

*/

namespace PHPGoodies;

PHPGoodies::import('Lib.Template.Renderer');

/**
 * Mustache - Mustache templating class
 *
 */
class Lib_Template_Mustache implements Lib_Template_Renderer {

	/**
	 * Partial templates callable from the template supplied to render()
	 */
	protected $partials = array();

	/**
	 * Add the named partial to the set of partials for future use
	 *
	 * @param $name String name of the parial to add
	 * @param $partial String partial template text
	 */
	public function addPartial($name, $partial) {
		$partials[$name] = new \stdClass();
		$partials[$name]->raw = $partial;
		$partials[$name]->parsed = $this->parse($parial);
	}

	/**
	 * Parse the supplied template to speed up subsequent usage
	 */
	protected function parse($name, &$template) {
		// todo: parse the template into a tree and return it
	}

	/**
	 * Render the supplied template with the supplied data
	 *
	 * @param $template String mustache template we want to fill up with data
	 * @param $data object data to inject into the mustache template
	 *
	 * @return string template filled up with the supplied data
	 */
	public function render(&$template, &$data) {
		$parsed = $this->parse('base', $template);
		// todo: iterate over the parsed tree and flatten it back out into text with data
		//return $this->renderSections($template, $data);
	}

	/**
	 *
	 */
	protected function renderSections($template, &$data) {
		$sectionStack = array();
		$scanPos = 0;
		while ($scanPos < strlen($template)) {

			// Get the next tag
			$tag = $this->getNextTag(substr($template, $scanPos));
			if (null == $tag) break;

			// Is it a section opener?
			if ('#' == $tag{2}) {

				// Add this section opener to the stack
				$sectionStack[] = array(
					'outer' => $scanPos + $tag->pos,
					'name' => $tag->name,
					'inner' => $scanPos + $tag->pos + strlen($tag->name)
				);
			}
			// Is it a section closer?
			else if ('/' == $tag{2}) {

				// Expect the last opener on the stack to match this closer, or else
				$sectionOpener = array_pop($sectionStack);
				if ($sectionOpener['name'] == $tag->name) {

					// It matches!
					$sectionInnerStart = $sectionOpener['inner'];
					$sectionInnerEnd = $scanPos + $tag->pos;

					// The section will be rendered if the name evaluates to true,
					// otherwise it will be collapsed and made to disappear.
					$value = $this->getProperty($data, $name);

					// Falsey values will collapse the section into nothing
					if ((null == $value) || (false === $value) || (0 === $value)) {
						$renderedSection = '';
					}

					// An array of objects will be iterated over with each object's
					// properties being merged with the normal data into a temporary
					// data structure; we'll add a rendered copy of the section for
					// each object in the array.
					else if (is_array($value)) {
						$templateSection = substr($template, $sectionInnerStart, $sectionInnerEnd - $sectionInnerStart);
						$renderedSection = '';
						foreach ($value as $vObj) {

							// Composite properties of each of the value's objects with data (vObj wins name conflicts)
							$mdata = PHPGoodies::instantiate('Oop.Composite', Array($vObj, $data));

							// FIXME: this is wrong!
							//
							// We should be able to iterate an array of values where each iterated chunk of template may
							// have its own conditional sections; since each of those would be dependent on which element
							// of the array is being processed, they cannot be pre-rendered depth-first. Possible solution
							// is to handle array iterators on open, and non-array sections on close. This means we would
							// need to somehow pre-process the stack of tags so that we know what blocks start/end where
							// and THEN walk through the stack, processing the sections and iterators from the outside, in...
							//
							//
							// It is impossible for the section being
							// closed to have another descendant section
							// as we would be closing IT instea of this
							// one; thus it is not necessary to recursively
							// call ourselves and we can just render the
							// variables instead...
							$renderedSection .= $this->renderVariables($templateSection, $mdata);
						}
					}

					// Now get the parts before and after the section and connect
					// them to the newly rendered version of the section
					$preSection = substr($template, 0, $sectionOpener['outer']);
					$postSection = substr($template, $scanPos);
					$template = $preSection . $renderedSection;

					// Adjust scan position back to the start of the section plus
					// the size of the newly rendered section to put us past it
					$scanPos = strlen($template);
					$template .= $postSection;
				}
				else {
					// Complain about a malformed template; the closer doesn't match the opener
				}
			}
			else {
				// Some other, non-section tag to come back to later
			}

		}
	}

	/**
	 *
	 */
	protected function getProperty(&$data, $name) {
		if (property_exists($data, $name)) {
			return $data->$name;
		}
		else if (method_exists($data, $name)) {
			return $data->$name();
		}
		return null;
	}

	/**
	 *
	 */
	protected function renderVariables($templateFrag, &$data) {
		// Replace all the variable tags with their respective values
		while (($tag = $this->getNextTag($templateFrag)) != null) {
			$preSection = substr($templateFrag, 0, $tag->pos);
			$postSection = substr($templateFrag, $tag->pos + strlen($tag->tag));
			$templateFrag = $preSection . getProperty($data, $tag->name) . $postSection;
		}
		return $templateFrag;
	}

	/**
	 *
	 */
	protected function getNextTag($templateFrag) {
		// Look for any tag starts...
		$tagPos = strpos($templateFrag, '{{');
		if (false === $tagPos) return null;

		// See if it's a double or a triple closer...
		$closer = ($templateFrag{$tagPos+2} == '{') ? '}}}' : '}}';

		// Scan out to the end of the tag to get the section name
		$endPos = strpos($templateFrag, $closer, $tagPos + 2);
		if (false === $endPos) return null;

		// Return the complete tag
		$tag = substr($template, $tagPos, $endPos - $tagPos + strlen($closer));
		return (object) array(
			'pos' => $tagPos, 	// The position of the whole tag within the templateFrag
			'tag' => $tag,		// The whole tag, including the opening/closing braces
			'name' => substr($tag, strlen($closer), strlen($tag) - (2 * strlen($closer)))
		);
	}
}

