<?php

namespace SpencerMortensen\Autoloader;

$project = dirname(__DIR__);

$classes = array(
	'SpencerMortensen\\Paths' => 'src',
	'SpencerMortensen\\RegularExpressions' => 'vendor/spencer-mortensen/regular-expressions/src'
);

require "{$project}/vendor/spencer-mortensen/autoloader/src/Autoloader.php";

new Autoloader($project, $classes);
