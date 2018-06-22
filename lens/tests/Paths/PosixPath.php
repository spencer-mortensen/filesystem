<?php

namespace SpencerMortensen\Filesystem\Paths;

use SpencerMortensen\Filesystem\AtomicPath;


// Test
$object = new PosixPath(null, new AtomicPath($isAbsolute, $atoms, $delimiter));
$output = array($object->isAbsolute(), $object->getAtoms());

// Cause
$delimiter = '/';
$isAbsolute = false;
$atoms = array();

// Effect
$output = array($isAbsolute, $atoms);

// Cause
$delimiter = '/';
$isAbsolute = true;
$atoms = array('etc', 'fstab');

// Effect
$output = array($isAbsolute, $atoms);


// Test
$object = PosixPath::fromString($path);
$output = array($object->isAbsolute(), $object->getAtoms());

// Cause
$path = '.';

// Effect
$output = array(false, array());

// Cause
$path = '/etc/fstab';

// Effect
$output = array(true, array('etc', 'fstab'));


// Test
$output = (string)PosixPath::fromString($path);

// Cause
$path = '.';

// Effect
$output = $path;

// Cause
$path = '/etc/fstab';

// Effect
$output = $path;


// Test
$object = PosixPath::fromString($path);
$output = (string)call_user_func_array(array($object, 'add'), $arguments);

// Cause
$path = '/etc';
$arguments = array();

// Effect
$output = '/etc';

// Cause
$path = '/etc';
$arguments = array('fstab');

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc';
$arguments = array(
	PosixPath::fromString('fstab')
);

// Effect
$output = '/etc/fstab';


// Test
$object = PosixPath::fromString($aPath);
$output = $object->contains($bPath);

// Cause
$aPath = '/etc';
$bPath = '/';

// Effect
$output = false;

// Cause
$aPath = '/etc';
$bPath = '/etc';

// Effect
$output = false;

// Cause
$aPath = '/etc';
$bPath = '/etc/fstab';

// Effect
$output = true;

// Cause
$aPath = '/etc';
$bPath = PosixPath::fromString('/');

// Effect
$output = false;

// Cause
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc');

// Effect
$output = false;

// Cause
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc/fstab');

// Effect
$output = true;


// Test
$object = PosixPath::fromString($aPath);
$output = $object->getRelativePath($bPath);

// Cause
$aPath = '/etc';
$bPath = '/etc/fstab';

// Effect
$output = PosixPath::fromString('fstab');


// Cause
$aPath = '/etc';
$bPath = PosixPath::fromString('/etc/fstab');

// Effect
$output = PosixPath::fromString('fstab');
