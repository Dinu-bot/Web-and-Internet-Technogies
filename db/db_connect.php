<?php
$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$database = "pet_clinic";


$conn = new mysqli($host, $username, $password, $database);

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
