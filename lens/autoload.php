<?php

namespace SpencerMortensen\Autoloader;

$project = dirname(__DIR__);

$classes = [
	'SpencerMortensen\\Filesystem' => 'src',
	'SpencerMortensen\\Exceptions' => 'vendor/spencer-mortensen/exceptions/src',
	'SpencerMortensen\\RegularExpressions' => 'vendor/spencer-mortensen/regular-expressions/src'
];

require_once "{$project}/vendor/spencer-mortensen/autoloader/src/Autoloader.php";

new Autoloader($project, $classes);
