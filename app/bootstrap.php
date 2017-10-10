<?php

$rootDir = __DIR__ . '/..';
$configDir = $rootDir . '/config';

require $rootDir . '/vendor/autoload.php';

$databaseConfig = require($configDir . '/database.config.php');

$databaseConnection = new Dibi\Connection($databaseConfig);

$repository = new App\Repository($databaseConnection);

$serviceLocator = new App\ServiceLocator($repository);

return $serviceLocator;
