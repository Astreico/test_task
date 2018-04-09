<?php

require_once __DIR__ . '/vendor/autoload.php';

use Application\Application;

$app =  new Application();

try {
    Application::writeLn($app->run());
} catch (Exception $e) {
    Application::writeLn($e->getMessage());
}