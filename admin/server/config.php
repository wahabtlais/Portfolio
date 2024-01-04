<?php
// Error Reporting Turn On
ini_set("error_reporting", E_ALL);


// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = 'portfolio';

// Database User
$dbuser = 'root';

// Database Password
$dbpass = '';

// Defining Root Url
define('ROOT_URL', 'http://localhost/Portfolio/');

// Defining Admin Url
define('ADMIN_URL', 'http://localhost/Portfolio/admin/');

try {
    $PDO = new PDO("mysql:host={$dbhost}; dbname={$dbname}", $dbuser, $dbpass);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection Error: " . $exception->getMessage();
}
