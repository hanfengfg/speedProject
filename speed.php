#! /usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';


use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new Speed\Server\SwooleBase());
$application->run();
//return $app;
