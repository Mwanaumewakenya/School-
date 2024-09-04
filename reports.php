<?php
// Establish connection to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the report table
$sql = "SELECT * FROM report";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Report Type: " . $row["report_type"]. " - Total Count: " . $row["total_count"]. " - Total Payments: " . $row["total_payments"]. " - Payment Of: " . $row["payment_of"]. " - Staff Role: " . $row["staffRole"]. " - Total Staff: " . $row["total_staff"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
