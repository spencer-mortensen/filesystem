<?php

namespace SpencerMortensen\Filesystem\Paths;

use SpencerMortensen\Filesystem\AtomicPath;


// Test
$object = new PosixPath(new AtomicPath($isAbsolute, $atoms, $delimiter));
$output = array($object->isAbsolute(), $object->getAtoms());

// Input
$delimiter = '/';
$isAbsolute = false;
$atoms = array();

// Output
$output = array($isAbsolute, $atoms);

// Input
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Output
$output = array($isAbsolute, $atoms);


// Test
$object = PosixPath::fromString($path);
$output = array($object->isAbsolute(), $object->getAtoms());

// Input
$path = '.';

// Output
$output = array(false, array());

// Input
$path = '/etc/fstab';

// Output
$output = array(true, array('etc', 'fstab'));


// Test
$output = (string)PosixPath::fromString($path);

// Input
$path = '.';

// Output
$output = $path;

// Input
$path = '/etc/fstab';

// Output
$output = $path;


// Test
$object = PosixPath::fromString($path);
$output = (string)call_user_func_array(array($object, 'add'), $arguments);

// Input
$path = '/etc';
$arguments = array();

// Output
$output = '/etc';

// Input
$path = '/etc';
$arguments = array('fstab');

// Output
$output = '/etc/fstab';

// Input
$path = '/etc';
$arguments = array(
	PosixPath::fromString('fstab')
);

// Output
$output = '/etc/fstab';


// Test
$object = PosixPath::fromString($aPath);
$output = $object->contains($bPath);

// Input
$aPath = '/etc';
$bPath = '/';

// Output
$output = false;

// Input
$aPath = '/etc';
$bPath = '/etc';

// Output
$output = false;

// Input
$aPath = '/etc';
$bPath = '/etc/fstab';

// Output
$output = true;

// Input
$aPath = '/etc';
$bPath = PosixPath::fromString('/');

// Output
$output = false;

// Input
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc');

// Output
$output = false;

// Input
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc/fstab');

// Output
$output = true;


// Test
$object = PosixPath::fromString($aPath);
$output = $object->getRelativePath($bPath);

// Input
$aPath = '/etc';
$bPath = '/etc/fstab';

// Output
$output = PosixPath::fromString('fstab');


// Input
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc/fstab');

// Output
$output = PosixPath::fromString('fstab');
