<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'heis';

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
