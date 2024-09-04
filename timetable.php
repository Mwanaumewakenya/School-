<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primary School Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
              background-image: url(images/L12.webp);
              background-size: cover; /* Adjust the background image size to cover the entire body */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .selectors {
            margin-bottom: 20px;
        }

        .selectors label {
            font-weight: bold;
            margin-right: 10px;
        }

        .selectors select {
            padding: 8px;
            font-size: 16px;
        }

        .timetable {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .subscript {
            font-size: 0.8em;
        }

        .lesson-buttons {
            margin-top: 10px;
        }

        .lesson-buttons button {
            margin-right: 10px;
            padding: 6px 10px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        .print-button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        .school-logo {
            float: right;
            width: 100px; /* Adjust size as needed */
            height: 100px; /* Adjust size as needed */
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/LOGOOOO.png" alt="School Logo" class="school-logo">
        <h1>Primary School Timetable</h1>

        <!-- Grade and Term Selector -->
        <div class="selectors">
            <label for="grade-select">Grade:</label>
            <select id="grade-select"></select>

            <label for="term-select">Term:</label>
            <select id="term-select"></select>
        </div>

        <!-- Timetable Display -->
        <div class="timetable">
            <table id="timetable"></table>
        </div>

        <!-- Lesson Buttons -->
        <div class="lesson-buttons">
            <button onclick="insertLesson('IRE')">IRE</button>
            <button onclick="insertLesson('CRE')">CRE</button>
            <button onclick="insertLesson('MATHS')">MATHS</button>
            <button onclick="insertLesson('ENGLISH')">ENGLISH</button>
            <button onclick="insertLesson('KISWAHILI')">KISWAHILI</button>
            <button onclick="insertLesson('CREATIVE ARTS')">CREATIVE ARTS</button>
            <button onclick="insertLesson('INTEGRATED SCIENCE')">INTEGRATED SCIENCE</button>
            <button onclick="insertLesson('SOCIAL STUDIES')">SOCIAL STUDIES</button>
            <button onclick="insertLesson('PRE-TECHNICAL')">PRE-TECHNICAL</button>
            <button onclick="insertLesson('AGRICULTURE')">AGRICULTURE</button>
        </div>

        <!-- Edit and Print Buttons -->
        <div class="edit-print-buttons">
            <button class="edit-button" onclick="editLesson()">Edit Lesson</button>
            <button class="print-button" onclick="window.print()">Print Timetable</button>
        </div>
    </div>

    <script>
        // Sample timetable data (can be fetched from a server in real application)
        const timetableData = {
            '7B': {
                'Term 1': {
                    'Monday': {},
                    'Tuesday': {},
                    'Wednesday': {},
                    'Thursday': {},
                    'Friday': {}
                    // Add more days as needed
                },
                'Term 2': {
                    'Monday': {},
                    'Tuesday': {},
                    'Wednesday': {},
                    'Thursday': {},
                    'Friday': {}
                    // Add more days as needed
                }
            },
            '8R': {
                'Term 1': {
                    'Monday': {},
                    'Tuesday': {},
                    'Wednesday': {},
                    'Thursday': {},
                    'Friday': {}
                    // Add more days as needed
                },
                'Term 2': {
                    'Monday': {},
                    'Tuesday': {},
                    'Wednesday': {},
                    'Thursday': {},
                    'Friday': {}
                    // Add more days as needed
                }
            }
            // Add more grades as needed
        };

        const gradeSelect = document.getElementById('grade-select');
        const termSelect = document.getElementById('term-select');
        const timetableTable = document.getElementById('timetable');
        let selectedDay = '';

        // Function to populate grade options
        function populateGradeOptions() {
            for (let grade in timetableData) {
                let option = document.createElement('option');
                option.textContent = grade;
                option.value = grade;
                gradeSelect.appendChild(option);
            }
        }

        // Function to populate term options based on selected grade
        function populateTermOptions() {
            let selectedGrade = gradeSelect.value;
            termSelect.innerHTML = ''; // Clear existing options

            for (let term in timetableData[selectedGrade]) {
                let option = document.createElement('option');
                option.textContent = term;
                option.value = term;
                termSelect.appendChild(option);
            }
        }

        // Function to display timetable for selected grade and term
        function displayTimetable() {
            let selectedGrade = gradeSelect.value;
            let selectedTerm = termSelect.value;
            let timetable = timetableData[selectedGrade][selectedTerm];

            // Clear existing table rows
            timetableTable.innerHTML = '';

            // Create time headers
            let timeHeaderRow = timetableTable.insertRow();
            timeHeaderRow.insertCell().textContent = 'Time';

            for (let hour = 8; hour <= 15; hour++) {
                for (let min = 0; min < 60; min += 20) {
                    let startTime = `${hour}:${min === 0 ? '00' : min}`;
                    let endTime = `${hour}:${min + 20 === 60 ? '00' : min + 20}`;
                    let cell = timeHeaderRow.insertCell();
                    cell.textContent = `${startTime} - ${endTime}`;
                }
            }

            // Create table rows and cells for days and lessons
            for (let day in timetable) {
                let row = timetableTable.insertRow();
                let cellDay = row.insertCell();
                cellDay.textContent = day;

                for (let hour = 8; hour <= 15; hour++) {
                    for (let min = 0; min < 60; min += 20) {
                        let time = `${hour}:${min === 0 ? '00' : min}`;
                        let cell = row.insertCell();
                        if (timetable[day][time]) {
                            cell.innerHTML = `<span>${timetable[day][time].lesson}</span><br><sub class="subscript">${timetable[day][time].class} (${timetable[day][time].teacher})</sub>`;
                        }
                    }
                }
            }
        }

        // Function to insert a lesson into the timetable
        function insertLesson(lessonName) {
            let lessonDay = prompt('Enter the day (e.g., Monday, Tuesday)');
            if (!lessonDay) return;
            lessonDay = lessonDay.trim();

            let lessonTime = prompt('Enter the time (e.g., 8:00)');
            if (!lessonTime) return;
            lessonTime = lessonTime.trim();

            let lessonGrade = prompt('Enter the class (e.g., 7B, 8R)');
            if (!lessonGrade) return;
            lessonGrade = lessonGrade.trim();

            let lessonTeacher = prompt('Enter the teacher code');
            if (!lessonTeacher) return;
            lessonTeacher = lessonTeacher.trim();

            let selectedTerm = termSelect.value;

            // Update timetableData
            if (!timetableData[lessonGrade][selectedTerm][lessonDay]) {
                timetableData[lessonGrade][selectedTerm][lessonDay] = {};
            }
            timetableData[lessonGrade][selectedTerm][lessonDay][lessonTime] = {
                lesson: lessonName,
                class: lessonGrade,
                teacher: lessonTeacher
            };

            // Update display
            displayTimetable();
        }

        // Function to edit a lesson in the timetable
        function editLesson() {
            let lessonDay = prompt('Enter the day of the lesson to edit (e.g., Monday, Tuesday)');
            if (!lessonDay) return;
            lessonDay = lessonDay.trim();

            let lessonTime = prompt('Enter the time of the lesson to edit (e.g., 8:00)');
            if (!lessonTime) return;
            lessonTime = lessonTime.trim();

            let lessonGrade = prompt('Enter the class of the lesson to edit (e.g., 7B, 8R)');
            if (!lessonGrade) return;
            lessonGrade = lessonGrade.trim();

            let lessonTeacher = prompt('Enter the new teacher code');
            if (!lessonTeacher) return;
            lessonTeacher = lessonTeacher.trim();

            let selectedTerm = termSelect.value;

            // Update timetableData
            if (timetableData[lessonGrade][selectedTerm][lessonDay] && timetableData[lessonGrade][selectedTerm][lessonDay][lessonTime]) {
                timetableData[lessonGrade][selectedTerm][lessonDay][lessonTime].teacher = lessonTeacher;
            } else {
                alert('Lesson not found! Please check your input.');
            }

            // Update display
            displayTimetable();
        }

        // Event listeners for grade and term selection
        gradeSelect.addEventListener('change', () => {
            populateTermOptions();
            displayTimetable();
        });

        termSelect.addEventListener('change', () => {
            displayTimetable();
        });

        // Initial population of grade options
        populateGradeOptions();
    </script>
</body>
</html>
