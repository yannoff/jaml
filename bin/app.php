#!/usr/bin/env php
<?php

/**
 * This file is part of the JAML utility project
 *
 * (c) Yannoff (https://github.com/yannoff)
 *
 * @project   yannoff/jaml
 * @link      https://github.com/yannoff/jaml
 * @license   https://github.com/yannoff/jaml/blob/master/LICENSE
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

error_reporting(E_ERROR);

// Redirect error messages to standard error output
ini_set('display_errors', 'stderr');

require __DIR__ . '/../vendor/autoload.php';

use Yannoff\Component\Console\Application;
use Yannoff\Jaml\Command\JamlCommand;

define('APP_NAME', 'jaml');

$application = new Application('jaml', '@@version@@');

$application->addCommands([
    new JamlCommand(APP_NAME),
]);

$args = $_SERVER['argv'];
$app = array_shift($args);

$application
    ->get(APP_NAME)
    ->run($args);
