<?php

namespace SpencerMortensen\Filesystem\Paths;

use SpencerMortensen\Filesystem\AtomicPath;


// Test
$object = WindowsPath::fromString($path);
$drive = $object->getDrive();
$isAbsolute = $object->isAbsolute();
$atoms = $object->getAtoms();

// Cause
$path = '';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array();

// Cause
$path = '.';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array();

// Cause
$path = '..';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array('..');

// Cause
$path = 'Windows';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array('Windows');

// Cause
$path = 'Windows\\win.ini';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'win.ini');

// Cause
$path = 'Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'system.ini');

// Cause
$path = '\\';

// Effect
$drive = null;
$isAbsolute = true;
$atoms = array();

// Cause
$path = '\\..';

// Effect
$drive = null;
$isAbsolute = true;
$atoms = array();

// Cause
$path = '\\Windows';

// Effect
$drive = null;
$isAbsolute = true;
$atoms = array('Windows');

// Cause
$path = '\\Windows\\win.ini';

// Effect
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Cause
$path = '\\Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'system.ini');


// Test
$pathObject = new AtomicPath($isAbsolute, $atoms, '\\');
$object = new WindowsPath($drive, $pathObject);
$path = (string)$object;

// Cause
$drive = null;
$isAbsolute = false;
$atoms = array();

// Effect
$path = '.';

// Cause
$drive = null;
$isAbsolute = false;
$atoms = array('..');

// Effect
$path = '..';

// Cause
$drive = null;
$isAbsolute = false;
$atoms = array('Windows');

// Effect
$path = 'Windows';

// Cause
$drive = null;
$isAbsolute = false;
$atoms = array('Windows', 'win.ini');

// Effect
$path = 'Windows\\win.ini';

// Cause
$drive = null;
$isAbsolute = true;
$atoms = array();

// Effect
$path = '\\';

// Cause
$drive = null;
$isAbsolute = true;
$atoms = array('Windows');

// Effect
$path = '\\Windows';

// Cause
$drive = null;
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Effect
$path = '\\Windows\\win.ini';


// Test
$object = WindowsPath::fromString($path);
$output = call_user_func_array(array($object, 'add'), $arguments);

// Cause
$path = '\\Windows\\win.ini';
$arguments = array();

// Effect
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'win.ini'), '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = array('..\\system.ini');

// Effect
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = array('..', 'system.ini');

// Effect
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = array(new WindowsPath(null, new AtomicPath(false, array('..', 'system.ini'), '\\')));

// Effect
$output = new WindowsPath(null, new AtomicPath(true, array('Windows', 'system.ini'), '\\'));

// Cause
$path = '..';
$arguments = array('..', '.');

// Effect
$output = new WindowsPath(null, new AtomicPath(false, array('..', '..'), '\\'));


// Test
$object = WindowsPath::fromString($path);
$output = (string)$object->getRelativePath($input);

// Cause
$path = '\\';
$input = '\\';

// Effect
$output = '.';

// Cause
$path = '\\';
$input = '\\Windows\\win.ini';

// Effect
$output = 'Windows\\win.ini';

// Cause
$path = '\\Windows';
$input = '\\Windows\\win.ini';

// Effect
$output = 'win.ini';

// Cause
$path = '\\Windows';
$input = '\\tmp\\file.txt';

// Effect
$output = '..\\tmp\\file.txt';


// Test
$object = WindowsPath::fromString($path);
$output = $object->contains($input);

// Cause
$path = '\\Windows';
$input = '\\';

// Effect
$output = false;

// Cause
$path = '\\Windows';
$input = '\\Windows';

// Effect
$output = false;

// Cause
$path = '\\Windows';
$input = '\\Windows\\win.ini';

// Effect
$output = true;
