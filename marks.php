<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Learner Exam Record</title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/LOGOOOO.png">
<style>
    /* Internal CSS for styling */
    body {
        background-color: whitesmoke;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: fantasy,sans-serif;
        color: black;
        flex-direction: column;
          background-image: url(images/L12.webp);
              background-size: cover; /* Adjust the background image size to cover the entire body */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
    }

    /* Header Styles */
    .header-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: springgreen; /* semi-transparent background */
        padding: 10px 0; /* adjust padding as needed */
        z-index: 999; /* ensure it's above other content */
        transition: top 0.3s; /* smooth transition effect */
    }

    .header-container img {
        width: 50px;
        height: 50px;
        vertical-align: middle;
        margin-left: 10px;
    }

    .header-container h1 {
        display: inline;
        margin-left: 10px;
        font-size: 36px;
        vertical-align: middle;
        color: black; /* text color */
    }

    /* Container to center content */
    .container {
        text-align: center;
        background-color: mediumspringgreen;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        width: 90%;
        max-width: 800px;
        margin-top: 200px; /* Adjust this value according to the height of your header */
    }

    /* Styles for form */
    form {
        margin-bottom: 20px;
        text-align: left;
    }

    /* Styles for form fields */
    label, input, select, textarea, button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }

    input, select, textarea {
        padding: 8px;
        border-radius: 4px;
        border: none;
        margin-top: 5px;
    }

    button {
        padding: 10px;
        background-color: black;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: darkgreen;
    }

    /* Success Message */
    #successMessage {
        display: none;
        text-align: center;
        color: lawngreen;
        margin-top: 20px;
    }

    /* Validation Styles */
    .error {
        color: red;
        font-size: 18px;
    }
</style>
</head>
<body>

<!-- Header with school logo -->
<div class="header-container" id="header">
    <img src="images/LOGOOOO.png" alt="School Logo">
    <h1>Learner Exam Record System</h1>
</div>

<div class="container">
    <header id="headerTitle"><b>Learner Exam Record</b></header>

    <!-- Form to add exam record -->
    <form id="examForm" method="post" action="marks_data.php">
        
        <label for="admissionNumber">Admission Number:</label>
        <input type="text" id="admissionNumber" name="admissionNumber" required>
        <span class="error" id="admissionNumberError"></span><br>
        
        <label for="learnerName">Learner Name:</label>
        <input type="text" id="learnerName" name="learnerName" readonly>
        
        <label for="examDate">Exam Date:</label>
        <input type="date" id="examDate" name="examDate" required>
        <span class="error" id="examDateError"></span>
        
        <label for="subject">Subject:</label>
        <select id="subject" name="subject" required>
            <option value="" disabled selected>Select Subject</option>
            <option value="Maths">Maths</option>
            <option value="English">English</option>
            <option value="Pretechnical">Pretechnical</option>
            <option value="Social Studies">Social Studies</option>
            <option value="Creative Arts">Creative Arts</option>
        </select>
        <span class="error" id="subjectError"></span>
        
        <label for="grade">Grade:</label>
        <select id="grade" name="grade" required>
            <option value="" disabled selected>Select Grade</option>
            <option value="Grade 7 Blue">Grade 7 Blue</option>
                        <option value="Grade 7 Green">Grade 7 Green</option>
                        <option value="Grade 7 Red">Grade 7 Red</option>
                        <option value="Grade 8 Blue">Grade 8 Blue</option>
                        <option value="Grade 8 Green">Grade 8 Green</option>
                        <option value="Grade 8 Red">Grade 8 Red</option>
        </select>
        <span class="error" id="gradeError"></span>
        
        <label for="marks">Marks:</label>
        <input type="number" id="marks" name="marks" min="0" max="100" required>
        <span class="error" id="marksError"></span>
        
        <label for="remarks">Remarks:</label>
        <textarea id="remarks" name="remarks" readonly required></textarea><br>
        
        <button type="submit">Add Record <i class="fas fa-plus"></i></button>
        
    </form>
    <a href="dashboard.php"><button >Logout<i class="fas fa-home"></i></button></a>
    <!-- Success Message -->
    <div id="successMessage">
        Exam record added successfully!
    </div>
</div>

<!-- JavaScript for functionality -->
<script>
    // Fetch student name function
    document.getElementById('admissionNumber').addEventListener('change', function() {
        var admissionNumber = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var learnerName = xhr.responseText;
                document.getElementById('learnerName').value = learnerName;
                document.getElementById('headerTitle').innerText = 'Learner Exam Record for: ' + learnerName;
                // Enable form fields after fetching learner name
                document.getElementById('learnerName').disabled = false;
                document.getElementById('examDate').disabled = false;
                document.getElementById('subject').disabled = false;
                document.getElementById('grade').disabled = false;
                document.getElementById('marks').disabled = false;
                document.getElementById('remarks').disabled = false;
            }
        };
        xhr.open('GET', 'fetch_student_name.php?admissionNumber=' + admissionNumber, true);
        xhr.send();
    });

    // Automatically generate remarks based on marks
    document.getElementById('marks').addEventListener('input', function() {
        var marks = parseInt(this.value);
        var remarks = '';
        if (marks >= 75) {
            remarks = 'Exceeding Expectations - Excellent performance!';
        } else if (marks >= 50) {
            remarks = 'Meeting Expectations - Well done.';
        } else if (marks >= 25) {
            remarks = 'Approaching Expectations - Some improvement needed.';
        } else {
            remarks = 'Below Expectations - Requires significant improvement.';
        }
        document.getElementById('remarks').value = remarks;
    });

    // Submit form function
    document.getElementById('examForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            addExamRecord();
        }
    });

    // Form validation function
    function validateForm() {
        var isValid = true;

        var admissionNumber = document.getElementById('admissionNumber').value;
        var examDate = document.getElementById('examDate').value;
        var subject = document.getElementById('subject').value;
        var grade = document.getElementById('grade').value;
        var marks = document.getElementById('marks').value;

        if (!admissionNumber) {
            document.getElementById('admissionNumberError').innerText = 'Admission Number is required.';
            isValid = false;
        } else {
            document.getElementById('admissionNumberError').innerText = '';
        }

        if (!examDate) {
            document.getElementById('examDateError').innerText = 'Exam Date is required.';
            isValid = false;
        } else {
            document.getElementById('examDateError').innerText = '';
        }

        if (!subject) {
            document.getElementById('subjectError').innerText = 'Subject is required.';
            isValid = false;
        } else {
            document.getElementById('subjectError').innerText = '';
        }

        if (!grade) {
            document.getElementById('gradeError').innerText = 'Grade is required.';
            isValid = false;
        } else {
            document.getElementById('gradeError').innerText = '';
        }

        if (!marks) {
            document.getElementById('marksError').innerText = 'Marks are required.';
            isValid = false;
        } else if (marks < 0 || marks > 100) {
            document.getElementById('marksError').innerText = 'Marks must be between 0 and 100.';
            isValid = false;
        } else {
            document.getElementById('marksError').innerText = '';
        }

        return isValid;
    }

    // Add exam record function
    function addExamRecord() {
        var admissionNumber = document.getElementById('admissionNumber').value;
        var learnerName = document.getElementById('learnerName').value;
        var examDate = document.getElementById('examDate').value;
        var subject = document.getElementById('subject').value;
        var grade = document.getElementById('grade').value;
        var marks = parseInt(document.getElementById('marks').value);
        var remarks = document.getElementById('remarks').value;

        // Make a POST request to the server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "marks_data.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Show success message
                document.getElementById('successMessage').style.display = 'block';

                // Hide success message after 3 seconds
                setTimeout(function() {
                    document.getElementById('successMessage').style.display = 'none';
                }, 3000);

                // Reset form fields after adding the record
                document.getElementById("examForm").reset();
                document.getElementById('headerTitle').innerText = 'Learner Exam Record';
            }
        };
        var params = `admissionNumber=${admissionNumber}&learnerName=${learnerName}&examDate=${examDate}&subject=${subject}&grade=${grade}&marks=${marks}&remarks=${remarks}`;
        xhr.send(params);
    }
</script>

</body>
</html>
