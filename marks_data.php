<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_management";

// Establishing connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Using $_POST to retrieve data sent via POST method
$admissionNumber = $_POST['admissionNumber'] ?? '';
$learnerName = $_POST['learnerName'] ?? '';
$examDate = $_POST['examDate'] ?? '';
$subject = $_POST['subject'] ?? '';
$grade = $_POST['grade'] ?? '';
$marks = $_POST['marks'] ?? '';
$remarks = $_POST['remarks'] ?? '';

// Check if the student exists in the students table
$stmt_check_student = $conn->prepare("SELECT student_id FROM students WHERE admission_number = ?");
$stmt_check_student->bind_param("s", $admissionNumber);
$stmt_check_student->execute();
$stmt_check_student->store_result();

if ($stmt_check_student->num_rows == 0) {
    echo "Error: Student with Admission Number $admissionNumber is not registered.";
    $stmt_check_student->close();
    $conn->close();
    exit; // Exit script if student is not registered
}

$stmt_check_student->close();

// Prepare SQL statement to insert exam record
$sql = "INSERT INTO exam_records (admissionNumber, learnerName, examDate, subject, grade, marks, remarks) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert_record = $conn->prepare($sql);

// Bind parameters with types for security
$stmt_insert_record->bind_param("sssssis", $admissionNumber, $learnerName, $examDate, $subject, $grade, $marks, $remarks);

// Execute the statement to insert exam record
if ($stmt_insert_record->execute()) {
    echo "Record added successfully";
} else {
    echo "Error: " . $stmt_insert_record->error;
}

// Close the statement and connection
$stmt_insert_record->close();
$conn->close();
?>
