<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assessment Test Merit List</title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    /* Internal CSS for styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="number"] {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }

    button {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
    }

    button:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    /* Print-specific styles */
    @media print {
        .container {
            box-shadow: none;
            border: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .container > *:not(table) {
            display: none;
        }
    }
</style>
</head>
<body>

<h1>Assessment Test Merit List</h1>

<div class="container">
    <form id="recordForm">
        <label for="topic">Topic:</label>
        <input type="text" id="topic" name="topic" required>

        <label for="testScore">Test Score:</label>
        <input type="number" id="testScore" name="testScore" required>

        <button type="submit">Record Merit <i class="fas fa-save"></i></button>
    </form>

    <table id="meritList">
        <thead>
            <tr>
                <th>Topic</th>
                <th>Test Score</th>
            </tr>
        </thead>
        <tbody>
            <!-- Merit list entries will be added dynamically here -->
        </tbody>
    </table>

    <button id="printButton">Print Merit List <i class="fas fa-print"></i></button>
</div>

<script>
document.getElementById('recordForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form data
    var topic = document.getElementById('topic').value;
    var testScore = document.getElementById('testScore').value;

    // Add a new row to the merit list table
    var table = document.getElementById('meritList').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    cell1.innerHTML = topic;
    cell2.innerHTML = testScore;

    // Reset form fields
    document.getElementById('topic').value = '';
    document.getElementById('testScore').value = '';
});

document.getElementById('printButton').addEventListener('click', function() {
    // Open print dialog for the merit list table
    window.print();
});
</script>

</body>
</html>
