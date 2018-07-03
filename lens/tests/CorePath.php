<?php

namespace SpencerMortensen\Filesystem;

use Exception;
use InvalidArgumentException;


// Test
$path = new CorePath($isAbsolute, $components, $delimiter);
$output = [$path->isAbsolute(), $path->getComponents()];

// Cause
$delimiter = '/';
$isAbsolute = false;
$components = ['etc', 'fstab'];

// Effect
$output = [$isAbsolute, $components];

// Cause
$delimiter = '\\';
$isAbsolute = true;
$components = ['Windows', 'win.ini'];

// Effect
$output = [$isAbsolute, $components];


// Test
$output = CorePath::fromString($path, $delimiter);

// Cause
$delimiter = '/';
$path = null;

// Effect
throw new InvalidArgumentException();

// Cause
$delimiter = '/';
$path = '';

// Effect
$output = new CorePath(false, [], $delimiter);

// Cause
$delimiter = '/';
$path = '.';

// Effect
$output = new CorePath(false, [], $delimiter);

// Cause
$delimiter = '/';
$path = '..';

// Effect
$output = new CorePath(false, ['..'], $delimiter);

// Cause
$delimiter = '/';
$path = 'etc';

// Effect
$output = new CorePath(false, ['etc'], $delimiter);

// Cause
$delimiter = '/';
$path = 'etc/fstab';

// Effect
$output = new CorePath(false, ['etc', 'fstab'], $delimiter);

// Cause
$delimiter = '/';
$path = 'etc/./fstab/../crontab/';

// Effect
$output = new CorePath(false, ['etc', 'crontab'], $delimiter);

// Cause
$delimiter = '/';
$path = '/';

// Effect
$output = new CorePath(true, [], $delimiter);

// Cause
$delimiter = '/';
$path = '/..';

// Effect
$output = new CorePath(true, [], $delimiter);

// Cause
$delimiter = '/';
$path = '/etc';

// Effect
$output = new CorePath(true, ['etc'], $delimiter);

// Cause
$delimiter = '/';
$path = '/etc/fstab';

// Effect
$output = new CorePath(true, ['etc', 'fstab'], $delimiter);

// Cause
$delimiter = '/';
$path = '/etc/./fstab/../crontab/';

// Effect
$output = new CorePath(true, ['etc', 'crontab'], $delimiter);

// Cause
$delimiter = '~';
$path = '/etc/fstab';

// Effect
$output = new CorePath(false, ['/etc/fstab'], $delimiter);

// Cause
$delimiter = '~';
$path = '~etc~fstab';

// Effect
$output = new CorePath(true, ['etc', 'fstab'], $delimiter);


// Test
$path = new CorePath($isAbsolute, $components, $delimiter);
$output = (string)$path;

// Cause
$delimiter = '/';
$isAbsolute = false;
$components = [];

// Effect
$output = '.';

// Cause
$delimiter = '/';
$isAbsolute = false;
$components = ['etc'];

// Effect
$output = 'etc';

// Cause
$delimiter = '/';
$isAbsolute = false;
$components = ['etc', 'fstab'];

// Effect
$output = 'etc/fstab';

// Cause
$delimiter = '\\';
$isAbsolute = false;
$components = ['etc', 'fstab'];

// Effect
$output = 'etc\\fstab';

// Cause
$delimiter = '/';
$isAbsolute = true;
$components = [];

// Effect
$output = '/';

// Cause
$delimiter = '/';
$isAbsolute = true;
$components = ['etc'];

// Effect
$output = '/etc';

// Cause
$delimiter = '/';
$isAbsolute = true;
$components = ['etc', 'fstab'];

// Effect
$output = '/etc/fstab';

// Cause
$delimiter = '\\';
$isAbsolute = true;
$components = ['etc', 'fstab'];

// Effect
$output = '\\etc\\fstab';


// Test
$object = CorePath::fromString($path, $delimiter);
$output = (string)$object->add($arguments);

// Cause
$path = '/';
$delimiter = '/';
$arguments = [];

// Effect
$output = '/';

// Cause
$path = '/';
$delimiter = '/';
$arguments = [
	CorePath::fromString('etc', $delimiter)
];

// Effect
$output = '/etc';

// Cause
$path = '/';
$delimiter = '/';
$arguments = [
	CorePath::fromString('etc', $delimiter),
	CorePath::fromString('fstab', $delimiter)
];

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$arguments = [];

// Effect
$output = '/etc';

// Cause
$path = '/etc';
$delimiter = '/';
$arguments = [
	CorePath::fromString('fstab', $delimiter)
];

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = [];

// Effect
$output = '/etc/fstab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = [
	CorePath::fromString('../crontab', $delimiter)
];

// Effect
$output = '/etc/crontab';

// Cause
$path = '/etc/fstab';
$delimiter = '/';
$arguments = [
	CorePath::fromString('..', $delimiter),
	CorePath::fromString('crontab', $delimiter)
];

// Effect
$output = '/etc/crontab';

// Cause
$path = '..';
$delimiter = '/';
$arguments = [
	CorePath::fromString('..', $delimiter),
	CorePath::fromString('.', $delimiter)
];

// Effect
$output = '../..';

// Cause
$path = '../crontab';
$delimiter = '/';
$arguments = [
	CorePath::fromString('/etc/crontab', $delimiter)
];

// Effect
$ouput = '/etc/crontab';


// Test
$object = CorePath::fromString($path, $delimiter);
$output = $object->contains($input);

// Cause
$path = '.';
$delimiter = '/';
$input = CorePath::fromString('/', $delimiter);

// Effect
throw new Exception();

// Cause
$path = '/etc';
$delimiter = '/';
$input = CorePath::fromString('/', $delimiter);

// Effect
$output = false;

// Cause
$path = '/etc';
$delimiter = '/';
$input = CorePath::fromString('/etc', $delimiter);

// Effect
$output = false;

// Cause
$path = '/etc';
$delimiter = '/';
$input = CorePath::fromString('/etc/fstab', $delimiter);

// Effect
$output = true;


// Test
$object = CorePath::fromString($path, $delimiter);
$output = (string)$object->getRelativePath($input);

// Cause
$path = '.';
$delimiter = '/';
$input = CorePath::fromString('/', $delimiter);

// Effect
throw new Exception();

// Cause
$path = '/';
$delimiter = '/';
$input = CorePath::fromString('.', $delimiter);

// Effect
throw new InvalidArgumentException();

// Cause
$path = '/';
$delimiter = '/';
$input = CorePath::fromString('/', $delimiter);

// Effect
$output = '.';

// Cause
$path = '/';
$delimiter = '/';
$input = CorePath::fromString('/etc/fstab', $delimiter);

// Effect
$output = 'etc/fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$input = CorePath::fromString('/etc/fstab', $delimiter);

// Effect
$output = 'fstab';

// Cause
$path = '/etc';
$delimiter = '/';
$input = CorePath::fromString('/tmp/file.txt', $delimiter);

// Effect
$output = '../tmp/file.txt';
