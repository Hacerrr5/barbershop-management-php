<?php
// Universal database configuration file
// Set your own database credentials here or use environment variables for security

$DB_HOST = 'localhost';
$DB_USER = 'YOUR_DATABASE_USER';
$DB_PASS = 'YOUR_DATABASE_PASSWORD';
$DB_NAME = 'YOUR_DATABASE_NAME';

$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($connection->connect_error) {
    die("Database connection error: " . $connection->connect_error);
}
$connection->set_charset("utf8");
?>