<?php
// Database connection parameters
$servername = "localhost"; // Change this to your MySQL server hostname if needed
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "school_management"; // Change this to the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the connection is successful, you can perform database operations here

// Close connection
$conn->close();
?>
