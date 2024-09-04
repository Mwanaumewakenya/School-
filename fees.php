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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $studentId = $conn->real_escape_string($_POST['studentId']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $paymentOf = $conn->real_escape_string($_POST['paymentOf']);

    // Check if the student exists in the students table
    $check_query = "SELECT student_name FROM students WHERE admission_number = '$studentId'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Fetch student's name
        $row = $result->fetch_assoc();
        $studentName = $row['student_name'];

        // Insert payment into fee_payments table
        $insert_query = "INSERT INTO fee_payments (student_id, student_name, amount, payment_of)
                        VALUES ('$studentId', '$studentName', '$amount', '$paymentOf')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "Student with ID $studentId does not exist.";
    }
}

// Close database connection
$conn->close();
?>
