<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Learner Records Management</title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    /* Internal CSS for styling */
    body {
        background-color: blue;
        margin: 0;
        font-family: Arial, sans-serif;
        color: white;
    }

    /* Header with school logo */
    header {
        background-color: #333;
        padding: 20px 0;
        text-align: center;
    }

    header img {
        width: 50px;
        height: 50px;
        vertical-align: middle;
    }

    header h1 {
        display: inline;
        margin-left: 10px;
        font-size: 24px;
        vertical-align: middle;
    }

    /* Container to center content */
    .container {
        text-align: center;
        background-color: #2c3e50;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        width: 90%;
        max-width: 600px;
        margin: 20px auto;
    }

    /* Marquee styles */
    .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        animation: marquee 30s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes marquee {
        0%   { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }

    /* Form styles */
    form {
        margin-bottom: 20px;
        text-align: left;
    }

    /* Form field styles */
    label, input, select, button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }

    input, select {
        padding: 8px;
        border-radius: 4px;
        border: none;
        margin-top: 5px;
    }

    button {
        padding: 10px;
        background-color: lawngreen;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: darkgreen;
    }

    /* Error message styles */
    .error {
        color: red;
        font-size: 14px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        color: black;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: lawngreen;
    }
</style>
</head>
<body>

<!-- Header with school logo -->
<header>
    <img src="images/bron.jpg" alt="School Logo">
    <h1>Learner Records Management</h1>
</header>

<div class="container">
    <!-- Marquee -->
    <div class="marquee">
        <span class="animate">Welcome to the Learner Records Management Page! </span>
        <span class="animate">Search, view, edit, and manage learner records efficiently.</span>
    </div>

    <!-- Form to search learner records -->
    <form id="searchForm" method="get">
        <label for="searchAdmissionNumber">Search by Admission Number:</label>
        <input type="text" id="searchAdmissionNumber" name="admissionNumber">
        <span class="error" id="searchAdmissionNumberError"></span><br><br>

        <label for="searchClass">Search by Class:</label>
        <select id="searchClass" name="class">
            <option value="" disabled selected>Select Class</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
        </select>
        <span class="error" id="searchClassError"></span><br><br>

        <button type="submit">Search Records <i class="fas fa-search"></i></button>
    </form>
</div>

<!-- PHP Script for fetching and displaying records -->
<div id="resultsContainer" class="container">
    <?php include 'fetchAcademic_records.php'; ?>
</div>

<!-- Link to dashboard login page -->
<div class="container">
    <p>Already have an account? <a href="dashboard_login.php">Login to Dashboard</a></p>
</div>

<script>
    function fetchRecords() {
        var searchAdmissionNumber = document.getElementById('searchAdmissionNumber').value;
        var searchClass = document.getElementById('searchClass').value;
        var isValid = true;

        if (!searchAdmissionNumber && !searchClass) {
            document.getElementById('searchAdmissionNumberError').innerText = 'Please enter Admission Number or select a Class.';
            document.getElementById('searchClassError').innerText = 'Please enter Admission Number or select a Class.';
            isValid = false;
        } else {
            document.getElementById('searchAdmissionNumberError').innerText = '';
            document.getElementById('searchClassError').innerText = '';
        }

        if (isValid) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('resultsContainer').innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'fetch_records.php?admissionNumber=' + searchAdmissionNumber + '&class=' + searchClass, true);
            xhr.send();
        }
    }

    function editRecord(admissionNumber) {
        var newMarks = prompt("Enter new marks:");
        if (newMarks !== null) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('successMessage').style.display = 'block';
                    setTimeout(function() {
                        document.getElementById('successMessage').style.display = 'none';
                    }, 3000);
                    fetchRecords();
                }
            };
            xhr.open('POST', 'edit_record.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('admissionNumber=' + admissionNumber + '&newMarks=' + newMarks);
        }
    }
</script>
</body>
</html>

