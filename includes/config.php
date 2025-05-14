<?php
// Detect environment
$is_localhost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

// Set DB credentials based on environment
if ($is_localhost) {
    $host = 'localhost';
    $dbname = 'cur_database';
    $username = 'root';
    $password = '';
    $port = 4306; // Localhost port (e.g., XAMPP)
    define('SITE_URL', 'http://localhost/cur');
} else {
    $host = 'sql211.infinityfree.com';
    $dbname = 'if0_38886317_cur_database';
    $username = 'if0_38886317';
    $password = 'Kimisagara';
    $port = 3306; // Default MySQL port for InfinityFree
    define('SITE_URL', 'https://' . $_SERVER['HTTP_HOST']);
}

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Site name
define('SITE_NAME', 'Center for Entrepreneurship');
?>
