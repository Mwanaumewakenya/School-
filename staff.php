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

// Assume you have received data from a form
$staffName = mysqli_real_escape_string($conn, $_POST['staffName']);
$staffId = mysqli_real_escape_string($conn, $_POST['staffId']);
$staffPhone = mysqli_real_escape_string($conn, $_POST['staffPhone']);
$staffRole = mysqli_real_escape_string($conn, $_POST['staffRole']);
$subjects = mysqli_real_escape_string($conn, $_POST['subjects']);

// Example SQL query
$sql = "INSERT INTO staff (staffName, staffId, staffPhone, staffRole, subjects) VALUES ('$staffName', '$staffId', '$staffPhone', '$staffRole', '$subjects')";

// Execute query
if ($conn->query($sql) === TRUE) {
    // Close connection
    $conn->close();
    // Success message
    echo "<script>
            alert('New record created successfully');
            window.location.href = 'dashboard.php'; // Redirect to a page after the message
          </script>";
} else {
    // Error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
