<?php
// Database configuration
// $dbHost     = "localhost";
// $dbUsername = "id10181295_ritik";
// $dbPassword = "phpintern";
// $dbName     = "id10181295_resume";

$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "job";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>