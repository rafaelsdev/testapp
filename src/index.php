<?php
// application.php
namespace ASPTest;
use Symfony\Component\Console\Application;
use ASPTest\Command\CreateUserCommand;
use ASPTest\Command\CreatePasswordCommand;

$base = __DIR__ . '/../';

require $base.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR .'autoload.php';



$application = new Application();
#var_dump(get_included_files());exit;
// ... register commands

$application -> add(new CreateUserCommand());
$application -> add(new CreatePasswordCommand());

$application->run();