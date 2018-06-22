<?php

namespace SpencerMortensen\Filesystem;

use Exception;
use InvalidArgumentException;


// Test
$path = new AtomicPath($isAbsolute, $atoms, $delimiter);
$output = array($path->isAbsolute(), $path->getAtoms());

// Cause
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Effect
$output = array($isAbsolute, $atoms);

// Cause
$delimiter = '\\';
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Effect
$output = array($isAbsolute, $atoms);


// Test
$output = AtomicPath::fromString($path, $delimiter);

// Cause
$delimiter = '/';
$path = null;

// Effect
throw new InvalidArgumentException();

// Cause
$delimiter = '/';
$path = '';

// Effect
$output = new AtomicPath(false, array(), $delimiter);

// Cause
$delimiter = '/';
$path = '.';

// Effect
$output = new AtomicPath(false, array(), $delimiter);

// Cause
$delimiter = '/';
$path = '..';

// Effect
$output = new AtomicPath(false, array('..'), $delimiter);

// Cause
$delimiter = '/';
$path = 'etc';

// Effect
$output = new AtomicPath(false, array('etc'), $delimiter);

// Cause
$delimiter = '/';
$path = 'etc/fstab';

// Effect
$output = new AtomicPath(false, array('etc', 'fstab'), $delimiter);

// Cause
$delimiter = '/';
$path = 'etc/./fstab/../crontab/';

// Effect
$output = new AtomicPath(false, array('etc', 'crontab'), $delimiter);

// Cause
$delimiter = '/';
$path = '/';

// Effect
$output = new AtomicPath(true, array(), $delimiter);

// Cause
$delimiter = '/';
$path = '/..';

// Effect
$output = new AtomicPath(true, array(), $delimiter);

// Cause
$delimiter = '/';
$path = '/etc';

// Effect
$output = new AtomicPath(true, array('etc'), $delimiter);

// Cause
$delimiter = '/';
$path = '/etc/fstab';

// Effect
$output = new AtomicPath(true, array('etc', 'fstab'), $delimiter);

// Cause
$delimiter = '/';
$path = '/etc/./fstab/../crontab/';

// Effect
$output = new AtomicPath(true, array('etc', 'crontab'), $delimiter);

// Cause
$delimiter = '~';
$path = '/etc/fstab';

// Effect
$output = new AtomicPath(false, array('/etc/fstab'), $delimiter);

// Cause
$delimiter = '~';
$path = '~etc~fstab';

// Effect
$output = new AtomicPath(true, array('etc', 'fstab'), $delimiter);


// Test
$path = new AtomicPath($isAbsolute, $atoms, $delimiter);
$output = (string)$path;

// Cause
$delimiter = '/';
$isAbsolute = false;
$atoms = array();

// Effect
$output = '.';

// Cause
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc');

// Effect
$output = 'etc';

// Cause
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Effect
$output = 'etc/fstab';

// Cause
$delimiter = '\\';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Effect
$output = 'etc\\fstab';

// Cause
$delimiter = '/';
$isAbsolute = true;
$atoms = array();

// Effect
$output = '/';

// Cause
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc');

// Effect
$output = '/etc';

// Cause
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Effect
$output = '/etc/fstab';

// Cause
$delimiter = '\\';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Effect
$output = '\\etc\\fstab';


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = (string)$object->add($arguments);

/*
// Cause
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('.', $delimiter)
);

// Effect
throw new InvalidArgumentException();
*/

// Cause
$path = '/';
$delimiter = '/';
$arguments = array();

// Effect
$output = '/';

// Cause
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('etc', $delimiter)
);

// Effect
$output = '/etc';

// Cause
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('etc', $delimiter),
	AtomicPath::fromString('fstab', $delimiter)
);

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$arguments = array();

// Effect
$output = '/etc';

// Cause
$path = '/etc';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('fstab', $delimiter)
);

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array();

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('../crontab', $delimiter)
);

// Effect
$output = '/etc/crontab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('..', $delimiter),
	AtomicPath::fromString('crontab', $delimiter)
);

// Effect
$output = '/etc/crontab';

// Cause
$path = '..';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('..', $delimiter),
	AtomicPath::fromString('.', $delimiter)
);

// Effect
$output = '../..';


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = $object->contains($input);

// Cause
$path = '.';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Effect
throw new Exception();

// Cause
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Effect
$output = false;

// Cause
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc', $delimiter);

// Effect
$output = false;

// Cause
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Effect
$output = true;


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = (string)$object->getRelativePath($input);

// Cause
$path = '.';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Effect
throw new Exception();

// Cause
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('.', $delimiter);

// Effect
throw new InvalidArgumentException();

// Cause
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Effect
$output = '.';

// Cause
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Effect
$output = 'etc/fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Effect
$output = 'fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/tmp/file.txt', $delimiter);

// Effect
$output = '../tmp/file.txt';
