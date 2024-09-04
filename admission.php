<?php
// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your database connection details
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

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO students (student_name, student_age, classroom, admission_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $studentName, $studentAge, $classroom, $admissionNumber);

    // Set parameters from POST data
    $studentName = $_POST["studentName"];
    $studentAge = $_POST["studentAge"];
    $classroom = $_POST["classroom"];
    $admissionNumber = $_POST["admissionNumber"];

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        // Return success message as JSON response
        $response = array("message" => "Admission submitted successfully");
        echo json_encode($response);
    } else {
        // Return error message as JSON response
        $response = array("message" => "Error submitting admission: " . $conn->error);
        echo json_encode($response);
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // Handle non-POST requests (optional)
    $response = array("message" => "Method not allowed");
    echo json_encode($response);
}
?>
