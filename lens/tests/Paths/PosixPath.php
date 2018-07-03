<?php

namespace SpencerMortensen\Filesystem\Paths;

use InvalidArgumentException;
use SpencerMortensen\Filesystem\CorePath;


// Test
$path = new CorePath($isAbsolute, $components, $delimiter);
$object = new PosixPath($scheme, $path);
$output = [$object->getScheme(), $object->isAbsolute(), $object->getComponents()];

// Cause
$scheme = null;
$isAbsolute = false;
$components = [];
$delimiter = '/';

// Effect
$output = [$scheme, $isAbsolute, $components];

// Cause
$scheme = null;
$isAbsolute = true;
$components = ['etc', 'fstab'];
$delimiter = '/';

// Effect
$output = [$scheme, $isAbsolute, $components];

// Cause
$scheme = 'phar';
$isAbsolute = false;
$components = ['project', 'bootstrap.php'];
$delimiter = '/';

// Effect
$output = [$scheme, $isAbsolute, $components];

// Cause
$scheme = 'phar';
$isAbsolute = true;
$components = ['directory', 'project.phar', 'bootstrap.php'];
$delimiter = '/';

// Effect
$output = [$scheme, $isAbsolute, $components];


// Test
$object = PosixPath::fromString($input);
$output = [$object->getScheme(), $object->isAbsolute(), $object->getComponents()];

// Cause
$input = null;

// Effect
throw new InvalidArgumentException();

// Cause
$input = '.';

// Effect
$output = [null, false, []];

// Cause
$input = '/etc/fstab';

// Effect
$output = [null, true, ['etc', 'fstab']];

// Cause
$input = 'phar://project/bootstrap.php';

// Effect
$output = ['phar', false, ['project', 'bootstrap.php']];

// Cause
$input = 'phar:///directory/project.phar/bootstrap.php';

// Effect
$output = ['phar', true, ['directory', 'project.phar', 'bootstrap.php']];


// Test
$output = (string)PosixPath::fromString($input);

// Cause
$input = '.';

// Effect
$output = $input;

// Cause
$input = '/etc/fstab';

// Effect
$output = $input;

// Cause
$input = 'phar://project/bootstrap.php';

// Effect
$output = $input;

// Cause
$input = 'phar:///directory/project.phar/bootstrap.php';

// Effect
$output = $input;


// Test
$path = PosixPath::fromString($input);
$output = (string)$path->setComponents($components);

// Cause
$input = '.';
$components = ['etc', 'fstab'];

// Effect
$output = 'etc/fstab';

// Cause
$input = '/etc/fstab';
$components = [];

// Effect
$output = '/';

// Cause
$input = 'phar://project/bootstrap.php';
$components = ['project'];

// Effect
$output = 'phar://project';

// Cause
$input = 'phar:///directory/project.phar/bootstrap.php';
$components = ['directory', 'project.phar'];

// Effect
$output = 'phar:///directory/project.phar';


// Test
$path = PosixPath::fromString($input);
$output = (string)call_user_func_array([$path, 'add'], $arguments);

// Cause
$input = '/etc';
$arguments = [];

// Effect
$output = '/etc';

// Cause
$input = '/etc';
$arguments = ['fstab'];

// Effect
$output = '/etc/fstab';

// Cause
$input = '/etc';
$arguments = [
	PosixPath::fromString('fstab')
];

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
