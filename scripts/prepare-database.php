<?php

$databaseConfig = require(__DIR__ . '/../config/database.config.php');

$conn = new mysqli(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password']
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE forecast");

$conn->query("USE forecast");

$query = 'CREATE TABLE items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(50) NOT NULL,
    min INT(3) NOT NULL,
    max INT(3) NOT NULL
    )';

$conn->query($query);

echo 'Prepare database is done.';
