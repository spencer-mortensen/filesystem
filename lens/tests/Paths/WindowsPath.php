<?php

namespace SpencerMortensen\Filesystem\Paths;

use SpencerMortensen\Filesystem\AtomicPath;


// Test
$object = WindowsPath::fromString($path);
$drive = $object->getDrive();
$isAbsolute = $object->isAbsolute();
$atoms = $object->getAtoms();

// Input
$path = '';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array();

// Input
$path = '.';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array();

// Input
$path = '..';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array('..');

// Input
$path = 'Windows';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array('Windows');

// Input
$path = 'Windows\\win.ini';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'win.ini');

// Input
$path = 'Windows\\.\\win.ini\\..\\system.ini\\';

// Output
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'system.ini');

// Input
$path = '\\';

// Output
$drive = null;
$isAbsolute = true;
$atoms = array();

// Input
$path = '\\..';

// Output
$drive = null;
$isAbsolute = true;
$atoms = array();

// Input
$path = '\\Windows';

// Output
$drive = null;
$isAbsolute = true;
$atoms = array('Windows');

// Input
$path = '\\Windows\\win.ini';

// Output
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Input
$path = '\\Windows\\.\\win.ini\\..\\system.ini\\';

// Output
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'system.ini');


// Test
$pathObject = new AtomicPath($isAbsolute, $atoms, '\\');
$object = new WindowsPath($drive, $pathObject);
$path = (string)$object;

// Input
$drive = null;
$isAbsolute = false;
$atoms = array();

// Output
$path = '.';

// Input
$drive = null;
$isAbsolute = false;
$atoms = array('..');

// Output
$path = '..';

// Input
$drive = null;
$isAbsolute = false;
$atoms = array('Windows');

// Output
$path = 'Windows';

// Input
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'win.ini');

// Output
$path = 'Windows\\win.ini';

// Input
$drive = null;
$isAbsolute = true;
$atoms = array();

// Output
$path = '\\';

// Input
$drive = null;
$isAbsolute = true;
$atoms = array('Windows');

// Output
$path = '\\Windows';

// Input
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Output
$path = '\\Windows\\win.ini';


// Test
$object = WindowsPath::fromString($path);
$output = call_user_func_array(array($object, 'add'), $arguments);

// Input
$path = '\\Windows\\win.ini';
$arguments = array();

// Output
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'win.ini'), '\\'));

// Input
$path = '\\Windows\\win.ini';
$arguments = array('..\\system.ini');

// Output
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Input
$path = '\\Windows\\win.ini';
$arguments = array('..', 'system.ini');

// Output
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Input
$path = '\\Windows\\win.ini';
$arguments = array(new WindowsPath(null, new AtomicPath(false, array('..', 'system.ini'), '\\')));

// Output
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Input
$path = '..';
$arguments = array('..', '.');

// Output
$output = new WindowsPath(null, new AtomicPath(false, array('..', '..'), '\\'));


// Test
$object = WindowsPath::fromString($path);
$output = (string)$object->getRelativePath($input);

// Input
$path = '\\';
$input = '\\';

// Output
$output = '.';

// Input
$path = '\\';
$input = '\\Windows\\win.ini';

// Output
$output = 'Windows\\win.ini';

// Input
$path = '\\Windows';
$input = '\\Windows\\win.ini';

// Output
$output = 'win.ini';

// Input
$path = '\\Windows';
$input = '\\tmp\\file.txt';

// Output
$output = '..\\tmp\\file.txt';


// Test
$object = WindowsPath::fromString($path);
$output = $object->contains($input);

// Input
$path = '\\Windows';
$input = '\\';

// Output
$output = false;

// Input
$path = '\\Windows';
$input = '\\Windows';

// Output
$output = false;

// Input
$path = '\\Windows';
$input = '\\Windows\\win.ini';

// Output
$output = true;
