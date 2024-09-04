<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/LOGOOOO.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
              background-image: url(images/L12.webp);
              background-size: cover; /* Adjust the background image size to cover the entire body */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
        }

        header {
            background-color: mediumspringgreen;
            color: black;
            padding: 6px;
            text-align: center;
        }

        .company-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .company-logo img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }

        .company-details {
            color: black;
        }

        main {
            padding: 20px;
        }

        section {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: lawngreen;
        }

        h2 {
            margin-top: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .agenda-list {
            padding-left: 20px;
        }

        .agenda-list li {
            margin-bottom: 5px;
            list-style: none;
            position: relative;
            padding-left: 25px;
        }

        .agenda-list li:before {
            content: "\2022"; /* Bullet point */
            color: #007bff; /* Bullet color */
            font-size: 20px;
            position: absolute;
            left: 0;
            top: 4px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .action-buttons button {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #0056b3;
        }

        .footer-text {
            color: #ccc;
        }
    </style>
</head>
<body>
    <header>
        <div class="company-logo">
            <img src="images/LOGOOOO.png" alt="Company Logo">
            <div class="company-details">
                <p>BAMBURI JUNIOR SECONDARY SCHOOL</p>
                <p>Address: BAMBURI CEMENT Street, MOMBASAA, KENYA</p>
                <p>Phone: +254724157575</p>
            </div>
        </div>
        <h1>Schedule</h1>
         <a href="dashboard.php"><button> <i class="fas fa-home"></i>Logout</button></a>
        <div class="button-container" id="adminButtons" style="display: none;">
            <button onclick="addSchedule('Monday')">Add Monday Schedule</button>
            <button onclick="addSchedule('Tuesday')">Add Tuesday Schedule</button>
            <button onclick="addSchedule('Wednesday')">Add Wednesday Schedule</button>
            <button onclick="addSchedule('Thursday')">Add Thursday Schedule</button>
            <button onclick="addSchedule('Friday')">Add Friday Schedule</button>
        </div>
        
    </header>

    <main>
        <section>
            <h2>Monday</h2>
            <ul id="mondayList">
                <!-- Schedule content will be dynamically added here -->
            </ul>
        </section>

        <section>
            <h2>Tuesday</h2>
            <ul id="tuesdayList">
                <!-- Schedule content will be dynamically added here -->
            </ul>
        </section>

        <section>
            <h2>Wednesday</h2>
            <ul id="wednesdayList">
                <!-- Schedule content will be dynamically added here -->
            </ul>
        </section>

        <section>
            <h2>Thursday</h2>
            <ul id="thursdayList">
                <!-- Schedule content will be dynamically added here -->
            </ul>
        </section>

        <section>
            <h2>Friday</h2>
            <ul id="fridayList">
                <!-- Schedule content will be dynamically added here -->
            </ul>
        </section>
    </main>

    <footer>
        <div class="footer-text">
            <span>Created By MWANAUMEWAKENYA | &#169; 2024 All Rights Reserved</span>
        </div>
    </footer>

    <script>
        // Hardcoded admin credentials
        const adminUsername = 'admin';
        const adminPassword = 'password';

        // Check if the user claims to be an admin
        const isAdmin = confirm('Are you an admin?');

        // If the user claims to be an admin, prompt for credentials
        if (isAdmin) {
            const enteredUsername = prompt('Enter admin username:');
            const enteredPassword = prompt('Enter admin password:');
            
            // If credentials are correct, show admin buttons
            if (enteredUsername === adminUsername && enteredPassword === adminPassword) {
                document.getElementById('adminButtons').style.display = 'block';
            } else {
                alert('Invalid credentials. Access denied.');
            }
        }

        function addSchedule(day) {
            const venue = prompt(`Enter the venue for ${day}:`);
            const time = new Date().toLocaleString();
            let agenda = '';
            for (let i = 1; i <= 5; i++) {
                const agendaItem = prompt(`Enter agenda item ${i} for ${day}:`);
                if (agendaItem) {
                    agenda += `${i}. ${agendaItem}\n`;
                }
            }

            if (venue && time && agenda) {
                const dayList = document.getElementById(`${day.toLowerCase()}List`);
                const scheduleItem = {
                    venue: venue,
                    time: time,
                    agenda: agenda
                };
                const schedules = JSON.parse(localStorage.getItem(`${day.toLowerCase()}Schedules`)) || [];
                schedules.push(scheduleItem);
                localStorage.setItem(`${day.toLowerCase()}Schedules`, JSON.stringify(schedules));
                renderSchedule(day);
            }
        }

        function renderSchedule(day) {
            const dayList = document.getElementById(`${day.toLowerCase()}List`);
            dayList.innerHTML = '';
            const schedules = JSON.parse(localStorage.getItem(`${day.toLowerCase()}Schedules`)) || [];
            schedules.forEach(schedule => {
                const li = document.createElement('li');
                li.textContent = `Venue: ${schedule.venue} - Time: ${schedule.time}`;
                const agendaList = document.createElement('ul');
                agendaList.classList.add('agenda-list');
                const agendaItems = schedule.agenda.split('\n');
                agendaItems.forEach(agendaItem => {
                    if (agendaItem.trim() !== '') {
                        const agendaItemLi = document.createElement('li');
                        agendaItemLi.textContent = agendaItem;
                        agendaList.appendChild(agendaItemLi);
                    }
                });
                li.appendChild(agendaList);
                if (isAdmin) { // Only add action buttons if user is admin
                    const actionButtons = document.createElement('div');
                    actionButtons.classList.add('action-buttons');
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.onclick = function() {
                        deleteSchedule(day, schedule);
                    };
                    actionButtons.appendChild(deleteButton);
                    li.appendChild(actionButtons);
                }
                dayList.appendChild(li);
            });
        }

        function deleteSchedule(day, schedule) {
            const schedules = JSON.parse(localStorage.getItem(`${day.toLowerCase()}Schedules`)) || [];
            const updatedSchedules = schedules.filter(item => item.venue !== schedule.venue || item.time !== schedule.time || item.agenda !== schedule.agenda);
            localStorage.setItem(`${day.toLowerCase()}Schedules`, JSON.stringify(updatedSchedules));
            renderSchedule(day);
        }

        // Render schedules on page load
        ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'].forEach(day => renderSchedule(day));
    </script>
</body>
</html>
