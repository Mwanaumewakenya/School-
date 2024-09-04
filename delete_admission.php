<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the admission number from the request
$admissionNumber = $_POST['admissionNumber'];

// SQL query to delete the admission
$sql = "DELETE FROM students WHERE admissionNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admissionNumber);

if ($stmt->execute() === TRUE) {
    echo "Admission deleted successfully";
} else {
    echo "Error deleting admission: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
