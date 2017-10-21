<?php

namespace SpencerMortensen\Paths;

$paths = new WindowsPaths();


// Test
$output = $paths->explode($input);

// Input
$input = 'C:\\';

// Output
$output = array(
	'drive' => 'C',
	'atoms' => array(),
	'isAbsolute' => true
);

// Input
$input = 'C:';

// Output
$output = array(
	'drive' => 'C',
	'atoms' => array(),
	'isAbsolute' => false
);

// Input
$input = 'C:\\Windows\\win.ini';

// Output
$output = array(
	'drive' => 'C',
	'atoms' => array('Windows', 'win.ini'),
	'isAbsolute' => true
);

// Input
$input = 'C:Windows\\win.ini';

// Output
$output = array(
	'drive' => 'C',
	'atoms' => array('Windows', 'win.ini'),
	'isAbsolute' => false
);


// Test
$output = $paths->join();

// Output
$output = null;


// Test
$output = $paths->join($aPath);

// Input
$aPath = 'C:\\';

// Output
$output = 'C:\\';


// Test
$output = $paths->join($aPath, $bPath);

// Input
$aPath = 'C:\\';
$bPath = 'Windows';

// Output
$output = 'C:\\Windows';

// Input
$aPath = 'C:';
$bPath = 'Windows';

// Output
$output = 'C:Windows';
