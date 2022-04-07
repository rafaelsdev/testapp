<?php
// application.php
namespace ASPTest;

require '..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR .'autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands

$application->run();