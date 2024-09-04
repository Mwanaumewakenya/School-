<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BAMBURI JUNIOR SCHOOL LEARNERS ASSESMENT REPORT</title>
<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" sizes="20x20" href="images/LOGOOOO.png">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
          background-image: url(images/L12.webp);
              background-size: cover; /* Adjust the background image size to cover the entire body */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
    }

    .report-container {
        background-color: #fff;
        padding: 80px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 800px;
        margin-top: 20px;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Adjust as needed */
        margin-bottom: 20px;
        position: relative; /* Ensure it stays at the top in print */
    }

    .header-container img {
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }

    .header-container h1 {
        font-size: 24px;
        margin: 0;
    }

    .additional-info {
        margin-top: 20px;
        padding: 10px;
        background-color: #f2f2f2;
        border-radius: 4px;
    }

    .additional-info p {
        margin: 5px 0;
    }

    .input-container {
        margin-bottom: 20px;
    }

    .input-container label {
        margin-right: 10px;
        font-weight: bold;
    }

    .input-container input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 150px;
        margin-right: 10px;
    }

    .input-container button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .input-container button:hover {
        background-color: #45a049;
    }

    .student-details {
        margin-bottom: 20px;
    }

    .student-details p {
        margin: 5px 0;
    }

    .exam-results table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .exam-results table,
    .exam-results th,
    .exam-results td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .exam-results th {
        background-color: #f2f2f2;
        text-align: left;
    }

    .bar-chart-container {
        margin-bottom: 20px;
    }

    .print-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }

    .print-button:hover {
        background-color: #45a049;
    }

    .error-message {
        color: red;
        font-weight: bold;
        margin-top: 20px;
    }

    @media print {
        .header-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Ensure it aligns properly in print */
        }

        .header-container img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .header-container h1 {
            font-size: 40px;
            margin: 0;
        }

        .report-container {
            margin-top: -100px; /* Adjust to accommodate header height */
        }

        .additional-info {
            display: block;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 4px;
            margin-top: 20px;
        }

        .input-container, .print-button {
            display: none;
        }
    }

    @page {
        size: A4;
        margin: 20mm 15mm; /* Adjust margins as needed */
    }
      header {
            background-color: blue;
            color: #ffffff;
            padding: 5px 0;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

</style>
</head>
<body>
 <header>

            <h1>Bamburi Junior School Report System</h1>
        
        
    </header>
<div class="report-container" id="reportContainer">
    <div class="header-container">
        <img src="images/LOGOOOO.png" alt="School Logo">
        <h1>Bamburi J.S.S Learner Report</h1>
        <button class="print-button" onclick="window.print()">Print Report</button>
        <a href="dashboard.php"> <button class="print-button" >Logout</button></a>
    </div>
    
    <div class="additional-info">
        <p>Location: Bamburi Cement plant</p>
        <p>Tel: .............</p>
        <p>Motto: Collaboration Bears Victory</p>
    </div>

    <div class="input-container">
        <label for="admissionNumber">Admission Number:</label>
        <input type="text" id="admissionNumberInput" placeholder="Enter Admission No">
        <button id="fetchReportButton">Fetch Report</button>
    </div>
    
    <div class="student-details" id="studentDetails">
        <p><strong>Name:</strong> <span id="studentName"></span></p>
        <p><strong>Age:</strong> <span id="studentAge"></span></p>
        <p><strong>Classroom:</strong> <span id="studentClassroom"></span></p>
        <p><strong>Admission Number:</strong> <span id="admissionNumber"></span></p>
    </div>
    
    <div class="exam-results" id="examResults">
        <table>
            <thead>
                <tr>
                    <th>Exam Date</th>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Marks</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody id="resultsTableBody">
                <!-- Exam results will be appended here -->
            </tbody>
        </table>
    </div>
    
    <div class="bar-chart-container">
        <canvas id="barChart"></canvas>
    </div>

    <div class="error-message" id="errorMessage"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('fetchReportButton').addEventListener('click', fetchReport);
});

function fetchReport() {
    var admissionNumber = document.getElementById('admissionNumberInput').value.trim();
    
    // Check if admissionNumber is not empty
    if (admissionNumber === '') {
        document.getElementById('errorMessage').innerText = 'Please enter an Admission Number.';
        clearReportDetails();
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_report.php?admissionNumber=' + encodeURIComponent(admissionNumber), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.error) {
                document.getElementById('errorMessage').innerText = response.error;
                clearReportDetails();
            } else {
                // Populate student details and exam results
                populateReport(response.studentDetails, response.examResults);
                document.getElementById('errorMessage').innerText = '';
                // Generate bar chart
                generateBarChart(response.examResults);
            }
        }
    };
    xhr.send();
}

function populateReport(studentDetails, examResults) {
    document.getElementById('studentName').innerText = studentDetails.name;
    document.getElementById('studentAge').innerText = studentDetails.age;
    document.getElementById('studentClassroom').innerText = studentDetails.classroom;
    document.getElementById('admissionNumber').innerText = studentDetails.admission_number;

    var resultsTableBody = document.getElementById('resultsTableBody');
    resultsTableBody.innerHTML = '';

    examResults.forEach(function(result) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${result.exam_date}</td>
            <td>${result.subject}</td>
            <td>${result.grade}</td>
            <td>${result.marks}</td>
            <td>${result.remarks}</td>
        `;
        resultsTableBody.appendChild(row);
    });
}

function clearReportDetails() {
    document.getElementById('studentName').innerText = '';
    document.getElementById('studentAge').innerText = '';
    document.getElementById('studentClassroom').innerText = '';
    document.getElementById('admissionNumber').innerText = '';
    document.getElementById('resultsTableBody').innerHTML = '';
    // Clear previous chart if exists
    var barChart = document.getElementById('barChart').getContext('2d');
    if (window.barChart !== undefined)
        window.barChart.destroy();
}

function generateBarChart(examResults) {
    var subjects = [];
    var marks = [];
    examResults.forEach(function(result) {
        subjects.push(result.subject);
        marks.push(result.marks);
    });

    var ctx = document.getElementById('barChart').getContext('2d');
    window.barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: subjects,
            datasets: [{
                label: 'Marks',
                data: marks,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Marks'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Subjects'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
</script>

</body>
</html>
