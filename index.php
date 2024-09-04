<?php
// Start the session at the beginning of the file
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: dashboard.php'); // Redirect to dashboard if logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bamburi Junior School Login & Registration</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/LOGOOOO.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            background-image: url(images/L12.webp);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            margin-top: -3px;
        }

        .card {
            border: dotted;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px;
            border-color: brown;
            border-width: thick;
            background-color: transparent;
            text-align: center;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card h2 {
            color: brown;
            font-family: 'Arial Black', sans-serif;
            text-transform: uppercase;
            font-size: 3em;
            margin: 0 auto;
            white-space: nowrap;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 20px;
            height: 45px;
            font-size: 16px;
        }

        .btn-primary {
            border-radius: 20px;
            padding: 12px 20px;
            font-size: 16px;
            width: 100%;
        }

        .bottom-links {
            margin-top: 20px;
            text-align: center;
        }

        .bottom-links a {
            color: #007bff;
            text-decoration: none;
            margin-left: 5px;
        }

        .bottom-links a:hover {
            text-decoration: underline;
        }

        .school-logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px;
        }

        header {
            text-align: center;
            margin-bottom: 2px;
        }

        header img {
            max-width: 8%;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="images/LOGOOOO.png" alt="School Logo">
    </header>
    <div class="container">
        <div class="card">
            <marquee direction="right"><b>MOTTO: COLLABORATION BEARS VICTORY</b></marquee>
            <h2>BAMBURI J.S.S</h2>

            <?php
            if (isset($_GET['error'])) {
                $error = intval($_GET['error']);
                switch ($error) {
                    case 1:
                        echo "<div class='alert alert-danger'>Invalid username or password. Please try again.</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-danger'>Username or password not provided.</div>";
                        break;
                    case 3:
                        echo "<div class='alert alert-danger'>Database error. Please try again later.</div>";
                        break;
                }
            }

            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "<div id='successMessage' class='alert alert-success'>Login successful! Redirecting to dashboard...</div>";
            }
            ?>

            <div id="loginForm">
                <h3>Login</h3>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div class="bottom-links">
                    <span>Don't have an account?</span> <a href="#" id="flipToRegister">Register</a>
                </div>
            </div>
            <div id="registerForm" style="display: none;">
                <h3>Registration</h3>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="bottom-links">
                    <span>Already have an account?</span> <a href="#" id="flipToLogin">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flipToRegister = document.getElementById('flipToRegister');
            const flipToLogin = document.getElementById('flipToLogin');

            flipToRegister.addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('registerForm').style.display = 'block';
            });

            flipToLogin.addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('loginForm').style.display = 'block';
                document.getElementById('registerForm').style.display = 'none';
            });

            // Check if success message exists
            if (document.getElementById('successMessage')) {
                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 3000); // 3 seconds delay before redirect
            }
        });
    </script>
</body>
</html>
