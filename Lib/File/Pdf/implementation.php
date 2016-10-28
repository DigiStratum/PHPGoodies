<?php
/**
 * PHPGoodies:Lib_File_Csv - A class for manipulating CSV data
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

namespace PHPGoodies;

/**
 * Pdf - A class for parsing or creating PDF files
 *
 * RFC-4180 Compliant implementation
 * ref: http://www.ietf.org/rfc/rfc4180.txt
 */
class Lib_File_Pdf {
	const MODE_PARSING = 0;
	const MODE_CREATING = 1;

	protected $pdf = null;
	protected $mode = null;
	protected $data = null;

	protected $path;

	/**
	 * Constructor
	 */
	public function __construct($path = null) {
		$this->path = $path;
	}

	/**
	 * Parse an existing PDF either from a file or BLOB data supplied
	 *
	 * @param pdfData BLOB contents of a PDF to parse (optional)
	 */
	public function parse($pdfData = null) {

		// Was a path specified?
		if (! is_null($this->path)) {

			// Is the file readable?
			if (! is_readable($this->path)) {
				throw new \Exception("Unable to read PDF file at ['{$this->path}']");
			}

			// Read in the entire file as data
			// TODO: work out a way to read the file a bit at a time and parse
			// on-the-fly so that we don't exhaust process RAM for large files
			$this->data = file_get_contents($this->path);
		}

		// Was data supplied to us?
		else if (! is_null($pdfData)) {

			// Capture it by reference so that we don't need to memcpy it around
			$this->data =& $pdfData;
		}

		// No data was supplied!
		else {
			throw new \Exception('No PDF data was supplied to parse');
		}

		$this->mode = self::MODE_PARSING;

		// TODO: Implement parse for $this->data
	}

	/**
	 * Create a new PDF
	 */
	public function create() {
		$this->mode = self::MODE_CREATING;
		// TODO: implement this!
	}
}

