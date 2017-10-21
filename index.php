<?php

namespace SpencerMortensen\Paths;

require __DIR__ . '/testing/autoload.php';

/*
$path = new WindowsPath('http://example.org');
$path = new WindowsPath('/hey/there');
*/

$paths = new WindowsPaths();

/*
$output = $paths->explode('C:\\Lens\\lens');
$output = $paths->explode('C:lens');
$output = $paths->explode('\\Lens\\lens');
$output = $paths->explode('lens');
*/

$output = $paths->getRelativePath('C:\\Lens', 'C:\\Programs\\lens\\file.txt');

echo "output: ", json_encode($output), "\n";
