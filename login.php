<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Sanitize user input
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        // Database connection parameters
        $host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "school_management";

        // Attempt to connect to the database
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement to fetch user with given username and password
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $stmt->execute(['username' => $username, 'password' => $password]);
            $user = $stmt->fetch();

            // Check if user exists and login is successful
            if ($user) {
                // Start the session
                session_start();
                $_SESSION['username'] = $user['username'];

                // Redirect to the index page with a success message
                header('Location: index.php?success=1');
                exit;
            } else {
                // Invalid credentials
                header('Location: index.php?error=1'); // Error code 1: Invalid credentials
                exit;
            }
        } catch (PDOException $e) {
            // Database error
            header('Location: index.php?error=3'); // Error code 3: Database error
            exit;
        }
    } else {
        // Missing username or password
        header('Location: index.php?error=2'); // Error code 2: Username or password not provided
        exit;
    }
} else {
    // If form not submitted, redirect to login page
    header('Location: index.php');
    exit;
}
?>
