<?php

namespace SpencerMortensen\Filesystem;

use Exception;
use InvalidArgumentException;


// Test
$path = new AtomicPath($isAbsolute, $atoms, $delimiter);
$output = array($path->isAbsolute(), $path->getAtoms());

// Input
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Output
$output = array($isAbsolute, $atoms);

// Input
$delimiter = '\\';
$isAbsolute = true;
$atoms = array('Windows', 'win.ini');

// Output
$output = array($isAbsolute, $atoms);


// Test
$output = AtomicPath::fromString($path, $delimiter);

// Input
$delimiter = '/';
$path = null;

// Output
throw new InvalidArgumentException();

// Input
$delimiter = '/';
$path = '';

// Output
$output = new AtomicPath(false, array(), $delimiter);

// Input
$delimiter = '/';
$path = '.';

// Output
$output = new AtomicPath(false, array(), $delimiter);

// Input
$delimiter = '/';
$path = '..';

// Output
$output = new AtomicPath(false, array('..'), $delimiter);

// Input
$delimiter = '/';
$path = 'etc';

// Output
$output = new AtomicPath(false, array('etc'), $delimiter);

// Input
$delimiter = '/';
$path = 'etc/fstab';

// Output
$output = new AtomicPath(false, array('etc', 'fstab'), $delimiter);

// Input
$delimiter = '/';
$path = 'etc/./fstab/../crontab/';

// Output
$output = new AtomicPath(false, array('etc', 'crontab'), $delimiter);

// Input
$delimiter = '/';
$path = '/';

// Output
$output = new AtomicPath(true, array(), $delimiter);

// Input
$delimiter = '/';
$path = '/..';

// Output
$output = new AtomicPath(true, array(), $delimiter);

// Input
$delimiter = '/';
$path = '/etc';

// Output
$output = new AtomicPath(true, array('etc'), $delimiter);

// Input
$delimiter = '/';
$path = '/etc/fstab';

// Output
$output = new AtomicPath(true, array('etc', 'fstab'), $delimiter);

// Input
$delimiter = '/';
$path = '/etc/./fstab/../crontab/';

// Output
$output = new AtomicPath(true, array('etc', 'crontab'), $delimiter);

// Input
$delimiter = '~';
$path = '/etc/fstab';

// Output
$output = new AtomicPath(false, array('/etc/fstab'), $delimiter);

// Input
$delimiter = '~';
$path = '~etc~fstab';

// Output
$output = new AtomicPath(true, array('etc', 'fstab'), $delimiter);


// Test
$path = new AtomicPath($isAbsolute, $atoms, $delimiter);
$output = (string)$path;

// Input
$delimiter = '/';
$isAbsolute = false;
$atoms = array();

// Output
$output = '.';

// Input
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc');

// Output
$output = 'etc';

// Input
$delimiter = '/';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Output
$output = 'etc/fstab';

// Input
$delimiter = '\\';
$isAbsolute = false;
$atoms = array('etc', 'fstab');

// Output
$output = 'etc\\fstab';

// Input
$delimiter = '/';
$isAbsolute = true;
$atoms = array();

// Output
$output = '/';

// Input
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc');

// Output
$output = '/etc';

// Input
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Output
$output = '/etc/fstab';

// Input
$delimiter = '\\';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Output
$output = '\\etc\\fstab';


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = (string)$object->add($arguments);

/*
// Input
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('.', $delimiter)
);

// Output
throw new InvalidArgumentException();
*/

// Input
$path = '/';
$delimiter = '/';
$arguments = array();

// Output
$output = '/';

// Input
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('etc', $delimiter)
);

// Output
$output = '/etc';

// Input
$path = '/';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('etc', $delimiter),
	AtomicPath::fromString('fstab', $delimiter)
);

// Output
$output = '/etc/fstab';

// Input
$path = '/etc';
$delimiter = '/';
$arguments = array();

// Output
$output = '/etc';

// Input
$path = '/etc';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('fstab', $delimiter)
);

// Output
$output = '/etc/fstab';

// Input
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array();

// Output
$output = '/etc/fstab';

// Input
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('../crontab', $delimiter)
);

// Output
$output = '/etc/crontab';

// Input
$path = '/etc/fstab';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('..', $delimiter),
	AtomicPath::fromString('crontab', $delimiter)
);

// Output
$output = '/etc/crontab';

// Input
$path = '..';
$delimiter = '/';
$arguments = array(
	AtomicPath::fromString('..', $delimiter),
	AtomicPath::fromString('.', $delimiter)
);

// Output
$output = '../..';


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = $object->contains($input);

// Input
$path = '.';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Output
throw new Exception();

// Input
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Output
$output = false;

// Input
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc', $delimiter);

// Output
$output = false;

// Input
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Output
$output = true;


// Test
$object = AtomicPath::fromString($path, $delimiter);
$output = (string)$object->getRelativePath($input);

// Input
$path = '.';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Output
throw new Exception();

// Input
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('.', $delimiter);

// Output
throw new InvalidArgumentException();

// Input
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('/', $delimiter);

// Output
$output = '.';

// Input
$path = '/';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Output
$output = 'etc/fstab';

// Input
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/etc/fstab', $delimiter);

// Output
$output = 'fstab';

// Input
$path = '/etc';
$delimiter = '/';
$input = AtomicPath::fromString('/tmp/file.txt', $delimiter);

// Output
$output = '../tmp/file.txt';
