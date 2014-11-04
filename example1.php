<?php
/**
 * PHPGoodies example1.php
 *
 * @author Sean M. Kelly <smk@smkelly.com>
 */

// 1) Adapt the name-spaced goodies to the global namespace
use PHPGoodies\PHPGoodies as PHPGoodies;
use PHPGoodies\Csv as Csv;

// 2) Load up our goodies
require('PHPGoodies.php');
PHPGoodies::import('lib.Csv.Csv');

// 3) Use the Csv Goodie to print the tokenized data extracted from a CSV string
print_r(Csv::tokenize('a,b,c,d'));

