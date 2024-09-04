<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the INSERT statement
$stmt = $conn->prepare("INSERT INTO merit_list (topic, test_score) VALUES (?, ?)");
$stmt->bind_param("si", $topic, $testScore);

// Set parameters and execute the statement
$topic = $_POST['topic'];
$testScore = $_POST['testScore'];
$stmt->execute();

// Close statement and database connection
$stmt->close();
$conn->close();

// Redirect back to the form page
header("Location: index.php");
exit();
?>
