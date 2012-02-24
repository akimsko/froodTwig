#!/usr/bin/php
<?php
/**
 * This file is part of the froodTwig Frood extension.
 * @link https://github.com/Ibmurai/zaphod
 *
 * @copyright Copyright 2011 Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
set_time_limit(0);

$libs = array(
    array(
        'lib' => 'twig',
        'url' => 'http://github.com/fabpot/Twig.git',
        'ver' => 'origin/master',
    ),
);

foreach ($libs as $lib) {
	$installPath = dirname(__FILE__) . "/{$lib['lib']}";

	if (!is_dir($installPath)) {
		echo " > Cloning {$lib['lib']}, version {$lib['ver']}\n";

		system('git clone ' . escapeshellarg($lib['url']) . ' ' . escapeshellarg($installPath));
	}

	echo " > Fetching {$lib['lib']}, version {$lib['ver']}\n";

	system('cd ' . escapeshellarg($installPath) . ' && git fetch origin && git reset --hard ' . escapeshellarg($lib['ver']));
}

// Make the cache folder
$cacheFolder = escapeshellarg(dirname(__FILE__) . '/cache');
`mkdir -p $cacheFolder`;
`chmod a+rw $cacheFolder`;

