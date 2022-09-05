<?php
require __DIR__ . '/../vendor/autoload.php';


use App\Command\Parser;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Parser());
$application->run();