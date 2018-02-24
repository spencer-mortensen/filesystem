<?php

namespace SpencerMortensen\Paths;


// Test
$paths = new WindowsPaths();
$input = new WindowsPathData('C', array(), true);
$output = $paths->serialize($input);

// Output
$output = 'C:\\';


// Test
$paths = new WindowsPaths();
$input = new WindowsPathData('C', array(), false);
$output = $paths->serialize($input);

// Output
$output = 'C:.';


// Test
$paths = new WindowsPaths();
$input = new WindowsPathData('C', array('Windows', 'win.ini'), true);
$output = $paths->serialize($input);

// Output
$output = 'C:\\Windows\\win.ini';


// Test
$paths = new WindowsPaths();
$input = new WindowsPathData('C', array('Windows', 'win.ini'), false);
$output = $paths->serialize($input);

// Output
$output = 'C:Windows\\win.ini';


// Test
$paths = new WindowsPaths();
$output = $paths->deserialize($input);

// Input
$input = 'C:\\';

// Output
$output = new WindowsPathData('C', array(), true);

// Input
$input = 'C:';

// Output
$output = new WindowsPathData('C', array(), false);

// Input
$input = 'C:\\Windows\\win.ini';

// Output
$output = new WindowsPathData('C', array('Windows', 'win.ini'), true);

// Input
$input = 'C:Windows\\win.ini';

// Output
$output = new WindowsPathData('C', array('Windows', 'win.ini'), false);


// Test
$paths = new WindowsPaths();
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

// Input
$input = array(array('C:', 'Windows'));

// Output
$output = 'C:Windows';


// Test
$paths = new WindowsPaths();
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
$paths = new WindowsPaths();
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
