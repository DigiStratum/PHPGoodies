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
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Mustache - Mustache templating class
 *
 */
class Mustache {

	/**
	 *
	 */
	public function __construct() {
	}

	/**
	 * ref: https://mustache.github.io/mustache.5.html
	 */
	public function render($template, &$data) {
		return $this->renderSections($template, $data);
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
					'inner' => $scanPos + $tag->pos + strlen($tag->name);
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
					if ($data->$name) {
						$renderedSection = $this->renderVariables(substr($template, $sectionInnerStart, $sectionInnerEnd - $sectionInnerStart));
					}
					else {
						$renderedSection = '';
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

	protected function renderVariables($templateFrag, &$data) {
		//TODO use getNextTag() to get variable tags and replace them with their values
	}

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
			'pos' => $tagPos,
			'tag' => $tag,
			'name' => substr($tag, strlen($closer), strlen($tag) - (2 * strlen($closer)))
		);
	}
}

