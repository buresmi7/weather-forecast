<?php

$serviceLocator = require(__DIR__ . '/../app/bootstrap.php');

$repository = $serviceLocator->getRepository();

$selectedDate = urldecode($_GET['selectedValue']);

$item['item'] = $repository->getByDate($selectedDate);

header('Content-Type: application/json');
echo json_encode($item);
