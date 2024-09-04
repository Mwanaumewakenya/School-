<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bamburi Junior School Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/LOGOOOO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url(images/L12.webp);
              background-size: cover; /* Adjust the background image size to cover the entire body */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
        }

        header {
            background-color: springgreen;
            color: #ffffff;
            padding: 5px 0;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .container {
            display: flex;
            margin-top: 60px; /* Adjust based on the header height */
        }

        .sidebar {
            background: springgreen;
            color: #ffffff;
            min-height: calc(100vh - 60px); /* Adjust based on the header height */
            width: 200px;
            position: fixed;
            top: 60px; /* Adjust based on the header height */
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
        }

        .sidebar ul li a {
            color: brown;
            text-decoration:none;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            background: black;
        }

        main {
            margin-left: 200px;
            padding: 20px;
            width: calc(100% - 200px);
            transition: margin-left 0.3s ease;
        }

        section {
            display: none;
            opacity: 0;
            transition: opacity 0.05s ease-in-out;
        }

        section.active {
            display: block;
            opacity: 1;
        }

        form {
            margin: 20px 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        button,
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        button {
            background: springgreen;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: brown;
        }

        #reportOutput {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #35424a;
            color: white;
        }

        .search-container {
            margin: 20px 0;
        }

        .search-container input[type="text"] {
            padding: 10px;
            width: calc(100% - 100px);
            margin-right: 10px;
        }

        .search-container button {
            padding: 10px 15px;
            background-color: #35424a;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }

        .actions button {
            margin-right: 5px;
        }

        /* Additional styles for role selection */
        .role-selection {
            margin-bottom: 10px;
        }

        /* Additional styles for subject combination */
        .subject-selection {
            margin-top: 10px;
        }

        /* Styling for edit and delete buttons */
        .edit-button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button {
            background-color: #f44336; /* Red */
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Styles for the dashboard cards */
        .dashboard-cards {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card {
            background-color: palegreen;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 30%;
        }

        /* Styles for the announcement widget */
        .announcement {
            background-color: deeppink;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 30%;
            margin: 0 auto;
        }

        .countdown {
            font-size: 24px;
            color: #35424a;
        }
           .profile {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 3px;
            color: black;
               margin-left: -480px;
        }

        .profile img {
            width: 70px;
            height: 70px;
            border-radius: 10%;
            margin-right: 10px;
            
        }
            
    </style>
</head>
<body>
    <header>
        <div class="profile">
            <img src="images/LOGOOOO.png">
            <h1>Bamburi Junior School Management Dashboard</h1>
        </div>
        
    </header>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="#" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt"></i> <b>Dashboard</b></a></li>
                <li><a href="#" onclick="showSection('admissions')"><i class="fas fa-user-plus"></i> <b>Admissions</b></a></li>
                <li><a href="#" onclick="showSection('staff')"><i class="fas fa-chalkboard-teacher"></i><b> Staff</b></a></li>
                <li><a href="#" onclick="showSection('fees')"><i class="fas fa-dollar-sign"></i> <b>Fee Payment</b></a></li>
                <li><a href="marks.php" onclick="showSection('reports')"><i class="fas fa-list"></i> <b>exams</b></a></li>
                <li><a href="learnerReport.php" onclick="showSection('reports')"><i class="fas fa-chart-line"></i> <b>Reports</b></a></li>
                <li><a href="timetable.php" onclick="showSection('timetable')"><i class="fas fa-calendar-alt"></i> <b>Timetable</b></a></li>
                <li> <a href="schedule.php"><i class="fas fa-table"></i><b>Schedule</b></a></li>
                <li> <a href="index.php"><i class="fas fa-home"></i> <b>Logout</b></a></li>
            </ul>
        </nav>
        <main>
            <section id="dashboard" class="active">
                <h2>Welcome to the Dashboard</h2>
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Total Staff</h3>
                        <p id="totalStaff">Loading...</p>
                    </div>
                    <div class="card">
                        <h3>Total Students</h3>
                        <p id="totalStudents">Loading...</p>
                    </div>
                </div>
                <div class="announcement">
                    <h3>Upcoming Event</h3>
                    <p>Exams Week</p>
                    <div class="countdown" id="countdown">Loading...</div>
                </div>
            </section>

            <section id="admissions">
                <h2>Admissions</h2>
                <form id="admissionForm" method="post" action="admission.php">
                    <label for="studentName">Student Name:</label>
                    <input type="text" id="studentName" name="studentName" required>
                    <label for="studentAge">Student Age:</label>
                    <input type="number" id="studentAge" name="studentAge" required>
                    <label for="classroom">Classroom:</label>
                    <select id="classroom" name="classroom" required>
                        <option value="Grade 7 Blue">Grade 7 Blue</option>
                        <option value="Grade 7 Green">Grade 7 Green</option>
                        <option value="Grade 7 Red">Grade 7 Red</option>
                        <option value="Grade 8 Blue">Grade 8 Blue</option>
                        <option value="Grade 8 Green">Grade 8 Green</option>
                        <option value="Grade 8 Red">Grade 8 Red</option>
                    </select>
                    <label for="admissionNumber">Admission Number:</label>
                    <div class="admission-number-input">
                        <input type="text" id="admissionNumber" name="admissionNumber" required>
                        <button type="button" onclick="generateAdmissionNumber()">Generate</button>
                    </div> 
                    <button  type="submit">Submit</button>
                </form>
            </section>

            <section id="staff">
                <h2>Staff Management</h2>
                <form id="staffForm" method="post" action="staff.php">
                    <label for="staffName">Staff Name:</label>
                    <input type="text" id="staffName" name="staffName" required>
                    <label for="staffId">Staff ID:</label>
                    <input type="text" id="staffId" name="staffId" required>
                    <label for="staffPhone">Phone Number:</label>
                    <input type="text" id="staffPhone" name="staffPhone" required>
                    <label for="staffRole">Staff Role:</label>
                    <select id="staffRole" name="staffRole" class="role-selection" onchange="showSubjectCombination()">
                        <option value="Class Teacher">Class Teacher</option>
                        <option value="HOD">Head of Department</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Games Teacher">Games Teacher</option>
                    </select>
                    <div id="subjectCombination" class="subject-selection">
                        <label for="subjects">Subject Combination:</label>
                        <select id="subjects" name="subjects">
                            <option value="Maths">Maths</option>
                            <option value="Science">Science</option>
                            <option value="English">English</option>
                            <option value="History">History</option>
                        </select>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </section>

            <section id="fees">
                <h2>Fee Payment</h2>
                <form id="feeForm" method="post" action="fees.php">
                    <label for="studentId">Student ID:</label>
                    <input type="text" id="studentId" name="studentId" required>
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" required>
                    <label for="paymentOf">Payment of:</label>
                    <select id="paymentOf" name="paymentOf" required>
                        <option value="Admission Fee">Admission Fee</option>
                        <option value="Exam Fee">Exam Fee</option>
                    </select>
                    <button type="submit">Submit</button>
                </form>
                 <div id="successMessage" style="display:none; color: green;">Payment was successful!</div>
    <div id="errorMessage" style="display:none; color: red;"></div>
            </section> 
            <section id="reports">
                
                    <!-- Reports will be dynamically populated here -->       
                </div>
            </section>

            <section id="timetable">
                <h2>Timetable</h2>
                <table id="timetableTable">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                    </thead>
                    <tbody id="timetableBody">
                        <!-- Timetable data will be dynamically populated here -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>
<script>
document.getElementById('feePaymentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form data
    var formData = new FormData(this);

    // Send AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fee_payment.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Parse the response
            var response = xhr.responseText;

            if (response.includes("success")) {
                document.getElementById('successMessage').style.display = 'block';
                document.getElementById('errorMessage').style.display = 'none';
                // Clear form fields
                document.getElementById('feePaymentForm').reset();
            } else {
                document.getElementById('successMessage').style.display = 'none';
                document.getElementById('errorMessage').style.display = 'block';
                document.getElementById('errorMessage').textContent = response;
            }
        } else {
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'block';
            document.getElementById('errorMessage').textContent = 'An error occurred. Please try again.';
        }
    };

    xhr.send(formData);
});
</script>

    <script>
        // Function to show the selected section and hide others
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            selectedSection.classList.add('active');
        }

        // Function to generate admission number
        function generateAdmissionNumber() {
            const randomNumber = Math.floor(Math.random() * 1000) + 1;
            document.getElementById('admissionNumber').value = randomNumber;
        }

        // Function to search admission records by admission number
        function searchByAdmissionNumber() {
            const admissionNumber = document.getElementById('searchAdmissionNumber').value.trim();
            // Implement search logic here (e.g., fetch data and update table)
            // Example placeholder:
            alert('Implement search logic for admission number: ' + admissionNumber);
        }

        // Function to search staff records by staff name
        function searchByStaffName() {
            const staffName = document.getElementById('searchStaffName').value.trim();
            // Implement search logic here (e.g., fetch data and update table)
            // Example placeholder:
            alert('Implement search logic for staff name: ' + staffName);
        }

        // Function to search fee payment records by admission number
        function searchByFeeAdmissionNumber() {
            const feeAdmissionNumber = document.getElementById('searchFeeAdmissionNumber').value.trim();
            // Implement search logic here (e.g., fetch data and update table)
            // Example placeholder:
            alert('Implement search logic for fee admission number: ' + feeAdmissionNumber);
        }

       

        // Fetch dashboard data on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetchDashboardData();
        });

        // Function to fetch and display dashboard data
        function fetchDashboardData() {
            // Example fetch operation to fetch total staff count
            fetch('fetch_total_staff.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalStaff').textContent = data.totalStaff;
                })
                .catch(error => {
                    console.error('Error fetching total staff:', error);
                    document.getElementById('totalStaff').textContent = 'Error';
                });

            // Example fetch operation to fetch total students count
            fetch('fetch_total_students.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalStudents').textContent = data.totalStudents;
                })
                .catch(error => {
                    console.error('Error fetching total students:', error);
                    document.getElementById('totalStudents').textContent = 'Error';
                });

            // Example countdown timer for an upcoming event
            const eventDate = new Date('2024-07-27');
            const now = new Date();
            const timeDiff = eventDate.getTime() - now.getTime();

            if (timeDiff > 0) {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                document.getElementById('countdown').textContent = `Countdown: ${days} days`;
            } else {
                document.getElementById('countdown').textContent = 'Event is happening today!';
            }
        }
    </script>
</body>
</html>
