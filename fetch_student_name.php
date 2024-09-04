<?php
// Database configuration
$servername = "localhost"; // Your database server name or IP
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "school_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the admission number from the query string
if (isset($_GET['admissionNumber'])) {
    $admissionNumber = $_GET['admissionNumber'];

    // Prepare and execute the query
    $sql = "SELECT student_name FROM students WHERE admission_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admissionNumber);
    $stmt->execute();
    $stmt->bind_result($studentName);
    $stmt->fetch();

    // Check if a student name was found and output it
    if ($studentName) {
        echo $studentName;
    } else {
        echo "Learner not found";
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
