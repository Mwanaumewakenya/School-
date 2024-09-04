<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "school_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to count total staff
$sql = "SELECT COUNT(*) AS totalStaff FROM staff";

$result = $conn->query($sql);

if ($result === FALSE) {
    // Handle query execution error
    $error_message = "Error executing query: " . $conn->error;
    die(json_encode(["error" => $error_message]));
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalStaff = $row["totalStaff"];
    echo json_encode(["totalStaff" => $totalStaff]);
} else {
    echo json_encode(["totalStaff" => 0]);
}

$conn->close();
?>
