<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admission number or grade is provided
if (isset($_GET['admissionNumber'])) {
    $admissionNumber = $_GET['admissionNumber'];
    $sql = "SELECT * FROM exam_records WHERE admissionNumber = '$admissionNumber'";
} elseif (isset($_GET['grade'])) {
    $grade = $_GET['grade'];
    $sql = "SELECT * FROM exam_records WHERE grade = '$grade'";
} else {
    echo "Please provide admission number or grade.";
    exit();
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Admission Number</th><th>Learner Name</th><th>Exam Date</th><th>Subject</th><th>Grade</th><th>Marks</th><th>Remarks</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["admissionNumber"] . "</td>";
        echo "<td>" . $row["learnerName"] . "</td>";
        echo "<td>" . $row["examDate"] . "</td>";
        echo "<td>" . $row["subject"] . "</td>";
        echo "<td>" . $row["grade"] . "</td>";
        echo "<td>" . $row["marks"] . "</td>";
        echo "<td>" . $row["remarks"] . "</td>";
        // Pass admission number and subject to the editRecord function
        echo "<td><button onclick=\"editRecord('" . $row["admissionNumber"] . "', '" . $row["subject"] . "')\">Edit <i class='fas fa-edit'></i></button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>
