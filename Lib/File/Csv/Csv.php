<?php
/**
 * PHPGoodies:Csv - A class for manipulating CSV data
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Csv - A class for manipulating CSV data
 *
 * RFC-4180 Compliant implementation
 * ref: http://www.ietf.org/rfc/rfc4180.txt
 */
abstract class Csv {

	/**
	 * Tokenize a string of CSV text/data and return the fielded data as an indexed array
	 *
	 * Not as simple as it sounds because we have to find fields with and without quoted data,
	 * and track quoting according to escaping within the data. Note that this method does not
	 * go to any special length to process multi-byte characters, however it "should work" as
	 * long as a simple, single-byte character is used for the separator/delimiter...
	 *
	 * @param string $csvline A line of (hopefully valid) CSV text
	 * @param string $delimiter Single-character value delimiter; optional, defaults to double-quote
	 * @param string $separator Single-character value separator; optional, defaults to comma
	 *
	 * @return array An array representing the supplied CSV fields
	 */
	static public function tokenize($csvline, $delimiter = '"', $separator = ',') {
		$finalData = Array();
		$thisData = $ch = '';
		$infield = $escaped = $delimited = false;
		for ($pos = 0; $pos < strlen($csvline); $pos++) {

			// Get the current character
			$ch = $csvline{$pos};

			// If we're within a field's data...
			if ($infield) {

				// If we're escaped...
				if ($escaped) {

					// Kill escaping (it's only valid for the character immediately following)
					$escaped = false;

					// If this char IS the delimiter or another escape char...
					if (($ch == $delimiter) || ($ch == "\\")) {

						// Add the char to the output and move on
						$thisData .= $ch;
						continue;
					}
					// Otherwise it was an invalid escapement; pass on the original escape char and keep looking
					$thisData .= "\\";
					continue;
				}

				// If this is the escape char, we'll expect to see a delimiter next...
				if ($ch == "\\") {
					$escaped = true;
					continue;
				}

				// If this field has a delimiting character
				if ($delimited) {

					// If this is the delimiter character (non-escaped!) then this terminates the field
					if ($ch == $delimiter) {
						$infield = $escaped = $delimited = false;
						continue;
					}

					// The data gets this character then; the next char will
					// be separator (or EOL) which will trigger the completion
					$thisData .= $ch;
					continue;
				}

				// Non-delimited means that any character other than separator gets added to the field
				if ($ch != $separator) {
					$thisData .= $ch;
					continue;
				}

				// Else fall through because this ch IS separator and we need to break the data on it
				$infield = $escape = $delimited = false;
			}

			// Look for a separator or quoting delimiter to start the field, etc.
			if ($ch == $separator) {

				// The field separator - whatever is in thisData now goes to the final
				$finalData[] = $thisData;
				$thisData = '';
				continue;
			}

			// Opening delimeter only valid at beginning of a field
			if ((! strlen($thisData)) && ($ch == $delimiter)) {
				$delimiter = $ch;
				$infield = $delimited = true;
				continue;
			}

			// Anything else must be initial data!
			$thisData .= $ch;
		}

		// If there is still data lingering in thisData then it was the last field or if
		// the last char was separator then there is an empty field hanging off the end
		if (strlen($thisData) || ($ch == $separator)) $finalData[] = $thisData;

		return($finalData);
	}

	/**
	 * Convert an array of numeric/string values into a CSV string
	 *
	 * We will wrap all values, numeric or string, with delimiters since it is safe and easy.
	 *
	 * @param array $data An array with simple numeric and string values
	 * @param string $delimiter Single-character value delimiter; optional, defaults to double-quote
	 * @param string $separator Single-character value separator; optional, defaults to comma
	 *
	 * @return string A CSV string representing the supplied data array
	 */
	static public function csvize($data, $delimiter = '"', $separator = ',') {
		$csvline = '';

		foreach ($data as $value) {

			// \n and \r characters are not acceptable; convert to spaces
			$value = str_replace(Array("\n", "\r"), ' ', $value);

			// Escape the escape if any exist
			$value = str_replace("\\", "\\\\", $value);

			// Escape the delimiter if any exist
			$value = str_replace($delimiter, "\\{$delimiter}", $value);

			// Tack this value onto the end of the line
			$csvline .= (strlen($csvline) ? $separator : '') . "{$delimiter}{$value}{$delimiter}";
		}

		return $csvline;
	}
}
