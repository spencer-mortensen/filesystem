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
$output= $paths->implode($input);

// Input
$input = array(
	'drive' => 'C',
	'atoms' => array(),
	'isAbsolute' => true
);

// Output
$output = 'C:\\';

// Input
$input = array(
	'drive' => 'C',
	'atoms' => array(),
	'isAbsolute' => false
);

// Output
$output = 'C:.';

// Input
$input = array(
	'drive' => 'C',
	'atoms' => array('Windows', 'win.ini'),
	'isAbsolute' => true
);

// Output
$output = 'C:\\Windows\\win.ini';

// Input
$input = array(
	'drive' => 'C',
	'atoms' => array('Windows', 'win.ini'),
	'isAbsolute' => false
);

// Output
$output = 'C:Windows\\win.ini';


// Test
$output = call_user_func_array(array($paths, 'join'), $input);

// Input
$input = array();

// Output
$output = null;

// Input
$input = array('C:\\');

// Output
$output = 'C:\\';

// Input
$input = array('C:\\', 'Windows');

// Output
$output = 'C:\\Windows';

// Input
$input = array('C:', 'Windows');

// Output
$output = 'C:Windows';


// Test
$c = $paths->isChildPath($a, $b);

// Input
$a = 'C:';
$b = 'C:';

// Output
$c = false;

// Input
$a = 'C:\\';
$b = 'C:';

// Output
$c = false;

// Input
$a = 'C:';
$b = 'C:\\';

// Output
$c = false;

// Input
$a = 'C:\\';
$b = 'C:\\';

// Output
$c = true;

// Input
$a = 'C:\\Windows';
$b = 'C:\\';

// Output
$c = false;

// Input
$a = 'C:\\Windows';
$b = 'C:\\Users';

// Output
$c = false;

// Input
$a = 'C:\\Windows';
$b = 'C:\\Windows';

// Output
$c = true;

// Input
$a = 'C:\\Windows';
$b = 'C:\\Windows\\win.ini';

// Output
$c = true;


// Test
$c = $paths->getRelativePath($a, $b);

// Input
$a = 'C:';
$b = 'C:';

// Output
$c = null;

// Input
$a = 'C:\\';
$b = 'C:';

// Output
$c = null;

// Input
$a = 'C:';
$b = 'C:\\';

// Output
$c = null;

// Input
$a = 'C:\\';
$b = 'C:\\';

// Output
$c = '.';

// Input
$a = 'C:\\Windows';
$b = 'C:\\';

// Output
$c = '..';

// Input
$a = 'C:\\Windows';
$b = 'C:\\Users';

// Output
$c = '..\\Users';

// Input
$a = 'C:\\Windows';
$b = 'C:\\Windows';

// Output
$c = '.';

// Input
$a = 'C:\\Windows';
$b = 'C:\\Windows\\win.ini';

// Output
$c = 'win.ini';

// Input
$a = 'C:\\Windows\\system';
$b = 'C:\\Users\\Public';

// Output
$c = '..\\..\\Users\\Public';

// Input
$a = 'C:\\Windows\\system';
$b = 'C:\\Windows\\system.ini';

// Output
$c = '..\\system.ini';
