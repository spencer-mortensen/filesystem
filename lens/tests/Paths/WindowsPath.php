<?php

namespace SpencerMortensen\Filesystem\Paths;

use InvalidArgumentException;
use SpencerMortensen\Filesystem\CorePath;


// Test
$path = new CorePath($isAbsolute, $components, $delimiter);
$object = new WindowsPath($scheme, $prefix, $path);
$output = [$object->getScheme(), $object->getPrefix(), $object->isAbsolute(), $object->getComponents()];

// Cause
$scheme = null;
$prefix = null;
$isAbsolute = false;
$components = [];
$delimiter = '\\';

// Effect
$output = [$scheme, $prefix, $isAbsolute, $components];

// Cause
$scheme = 'phar';
$prefix = 'C';
$isAbsolute = true;
$components = ['Windows', 'win.ini'];
$delimiter = '\\';

// Effect
$output = [$scheme, $prefix, $isAbsolute, $components];


// Test
$object = WindowsPath::fromString($path);
$output = [$object->getScheme(), $object->getPrefix(), $object->isAbsolute(), $object->getComponents()];

// Cause
$path = null;

// Effect
throw new InvalidArgumentException();

// Cause
$path = '';

// Effect
$output = [null, null, false, []];

// Cause
$path = '.';

// Effect
$output = [null, null, false, []];

// Cause
$path = '..';

// Effect
$output = [null, null, false, ['..']];

// Cause
$path = 'Windows';

// Effect
$output = [null, null, false, ['Windows']];

// Cause
$path = 'Windows\\win.ini';

// Effect
$output = [null, null, false, ['Windows', 'win.ini']];

// Cause
$path = 'Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$output = [null, null, false, ['Windows', 'system.ini']];

// Cause
$path = '\\';

// Effect
$output = [null, null, true, []];

// Cause
$path = '\\..';

// Effect
$output = [null, null, true, []];

// Cause
$path = '\\Windows';

// Effect
$output = [null, null, true, ['Windows']];

// Cause
$path = '\\Windows\\win.ini';

// Effect
$output = [null, null, true, ['Windows', 'win.ini']];

// Cause
$path = '\\Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$output = [null, null, true, ['Windows', 'system.ini']];

// Cause
$path = 'C:win.ini';

// Effect
$output = [null, 'C', false, ['win.ini']];

// Cause
$path = 'C:\\Windows\\win.ini';

// Effect
$output = [null, 'C', true, ['Windows', 'win.ini']];

// Cause
$path = 'phar://project\\bootstrap.php';

// Effect
$output = ['phar', null, false, ['project', 'bootstrap.php']];

// Cause
$path = 'phar://C:\\project.phar\\bootstrap.php';

// Effect
$output = ['phar', 'C', true, ['project.phar', 'bootstrap.php']];


//////
// Test
$output = (string)WindowsPath::fromString($input);

// Cause
$input = '';

// Effect
$output = '.';

// Cause
$input = '.';

// Effect
$output = '.';

// Cause
$input = '..';

// Effect
$output = '..';

// Cause
$input = 'Windows';

// Effect
$output = 'Windows';

// Cause
$input = 'Windows\\win.ini';

// Effect
$output = 'Windows\\win.ini';

// Cause
$input = 'Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$output = 'Windows\\system.ini';

// Cause
$input = '\\';

// Effect
$output = '\\';

// Cause
$input = '\\..';

// Effect
$output = '\\';

// Cause
$input = '\\Windows';

// Effect
$output = '\\Windows';

// Cause
$input = '\\Windows\\win.ini';

// Effect
$output = '\\Windows\\win.ini';

// Cause
$input = '\\Windows/win.ini';

// Effect
$output = '\\Windows\\win.ini';

// Cause
$input = '\\Windows\\.\\win.ini\\..\\system.ini\\';

// Effect
$output = '\\Windows\\system.ini';

// Cause
$input = 'C:win.ini';

// Effect
$output = 'C:win.ini';

// Cause
$input = 'C:\\Windows\\win.ini';

// Effect
$output = 'C:\\Windows\\win.ini';

// Cause
$input = 'phar://project\\bootstrap.php';

// Effect
$output = 'phar://project\\bootstrap.php';

// Cause
$input = 'phar://C:\\project.phar\\bootstrap.php';

// Effect
$output = 'phar://C:\\project.phar\\bootstrap.php';


// Test
$path = WindowsPath::fromString($input);
$output = (string)$path->setComponents($components);

// Cause
$input = '.';
$components = ['Windows', 'win.ini'];

// Effect
$output = 'Windows\\win.ini';

// Cause
$input = '\\Windows\\win.ini';
$components = [];

// Effect
$output = '\\';

// Cause
$input = 'phar://project\\bootstrap.php';
$components = ['project'];

// Effect
$output = 'phar://project';

// Cause
$input = 'phar://\\directory\\project.phar\\bootstrap.php';
$components = ['directory', 'project.phar'];

// Effect
$output = 'phar://\\directory\\project.phar';


// Test
$object = WindowsPath::fromString($path);
$output = call_user_func_array([$object, 'add'], $arguments);

// Cause
$path = '\\Windows\\win.ini';
$arguments = [];

// Effect
$output = new WindowsPath(null, null, new CorePath(true, ['Windows', 'win.ini'], '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = ['..\\system.ini'];

// Effect
$output = new WindowsPath(null, null, new CorePath(true, ['Windows', 'system.ini'], '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = ['..', 'system.ini'];

// Effect
$output = new WindowsPath(null, null, new CorePath(true, ['Windows', 'system.ini'], '\\'));

// Cause
$path = '\\Windows\\win.ini';
$arguments = [new WindowsPath(null, null, new CorePath(false, ['..', 'system.ini'], '\\'))];

// Effect
$output = new WindowsPath(null, null, new CorePath(true, ['Windows', 'system.ini'], '\\'));

// Cause
$path = '..';
$arguments = ['..', '.'];

// Effect
$output = new WindowsPath(null, null, new CorePath(false, ['..', '..'], '\\'));


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
