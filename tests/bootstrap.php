<?php

/**
 * Avisota newsletter and mailing system
 *
 * Copyright (C) Avisota
 *
 * @package   contao-css-to-inline-style
 * @file      config.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @license   LGPL-3.0+
 * @copyright Copyright 2016 Avisota
 */

error_reporting(E_ALL);

function includeIfExists($file)
{
    return file_exists($file) ? include $file : false;
}

if (// Locally installed dependencies.
    (!$loader = includeIfExists(__DIR__ . '/../vendor/autoload.php'))
    // We are within an composer install.
    && (!$loader = includeIfExists(__DIR__ . '/../../../autoload.php'))
) {
    echo 'You must set up the project dependencies, run the following commands:' . PHP_EOL .
         'curl -sS https://getcomposer.org/installer | php' . PHP_EOL .
         'php composer.phar install' . PHP_EOL;
    exit(1);
}
