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

// SQL query to count total students
$sql = "SELECT COUNT(*) AS totalStudents FROM students";

$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalStudents = $row["totalStudents"];
    echo json_encode(["totalStudents" => $totalStudents]);
} else {
    echo json_encode(["totalStudents" => 0]);
}

$conn->close();
?>
