<?php

namespace SpencerMortensen\Autoloader;

$project = dirname(__DIR__);

$classes = array(
	'SpencerMortensen\\Filesystem' => 'src',
	'SpencerMortensen\\RegularExpressions' => 'vendor/spencer-mortensen/regular-expressions/src'
);

require_once "{$project}/vendor/spencer-mortensen/autoloader/src/Autoloader.php";

new Autoloader($project, $classes);
