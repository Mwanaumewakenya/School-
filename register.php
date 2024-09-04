<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username, password, and confirm password are provided
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        // Sanitize user input to prevent SQL injection or other attacks
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_STRING);

        // Check if passwords match
        if ($password !== $confirmPassword) {
            // Redirect back to the registration page with an error message
            header('Location: register.php?error=password_mismatch');
            exit;
        }

        // Database connection parameters
        $host = "localhost"; // Change this to your database host
        $db_username = "root"; // Change this to your database username
        $db_password = ""; // Change this to your database password
        $db_name = "school_management"; // Change this to your database name

        // Attempt to connect to the database
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement to insert user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);

            // Show success message
            echo "<script>alert('Registration successful!');</script>";

            // Redirect to a success page or login page after a short delay
            echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
            exit;
        } catch (PDOException $e) {
            // If there is an error connecting to the database or executing SQL, redirect back to the registration page with an error message
            header('Location: register.php?error=database_error');
            exit;
        }
    } else {
        // If username, password, or confirm password is not provided, redirect back to the registration page with an error message
        header('Location: register.php?error=fields_missing');
        exit;
    }
} else {
    // If the form is not submitted, redirect back to the registration page
    header('Location: register.php');
    exit;
}
?>
