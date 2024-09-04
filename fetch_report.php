<?php
// Database connection details
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

// Fetching admission number from GET request (sanitize it)
$admissionNumber = isset($_GET['admissionNumber']) ? $conn->real_escape_string($_GET['admissionNumber']) : '';

// Prepare SQL statement to fetch student details and exam results based on admission number
$sql = "SELECT s.student_name, s.student_age, s.classroom, e.examDate, e.subject, e.grade, e.marks, e.remarks
        FROM students s
        INNER JOIN exam_records e ON s.admission_number = e.admissionNumber
        WHERE s.admission_number = '$admissionNumber'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $examResults = array();
    $studentDetails = array();

    // Fetching exam results and student details
    while ($row = $result->fetch_assoc()) {
        // Fetch student details only once
        if (empty($studentDetails)) {
            $studentDetails = array(
                'name' => $row['student_name'],
                'age' => $row['student_age'],
                'classroom' => $row['classroom'],
                'admission_number' => $admissionNumber
            );
        }

        // Append each exam record to examResults array
        $examResults[] = array(
            'exam_date' => $row['examDate'],
            'subject' => $row['subject'],
            'grade' => $row['grade'],
            'marks' => $row['marks'],
            'remarks' => $row['remarks']
        );
    }

    // Close connection
    $conn->close();

    // Prepare response as JSON
    $response = array(
        'studentDetails' => $studentDetails,
        'examResults' => $examResults
    );

    // Output JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Stop further execution
} else {
    $conn->close();
    // No records found with the given admission number
    echo json_encode(array('error' => 'No records found with the given admission number. Ensure the student is registered.'));
    exit; // Stop further execution
}
?>
