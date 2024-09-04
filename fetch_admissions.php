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

// SQL query to fetch all admissions
$sql = "SELECT student_name, student_age, classroom, admissionNumber FROM admissions";
$result = $conn->query($sql);

$admissions = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $admissions[] = $row;
    }
} else {
    echo "0 results";
}

// Return data as JSON
echo json_encode($admissions);

$conn->close();
?>
