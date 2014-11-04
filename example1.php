<?php
/**
 * PHPGoodies example1.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\CSV as CSV;

// 2) Load up our goodies
require('PHPGoodies.php');
PHPGoodies::import('lib.CSV.CSV');

// 3) Use the CSV goodie to print the tokenized data extracted from a CSV string
$csv = new CSV();
print_r($csv->tokenize('a,b,c,d'));

