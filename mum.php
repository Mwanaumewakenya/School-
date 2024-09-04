<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
       body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            line-height: 1.25;
            letter-spacing: 1px;
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
        }

        .login-container {
            position: relative;
            margin: 0 auto;
            padding: 5rem 1rem 0;
            max-width: 525px;
            min-height: 680px;
            background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/283591/login-background.jpg);
            box-shadow: 0 50px 70px -20px rgba(0, 0, 0, 0.85);
            border-radius: 10px;
        }

        .login-container:after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: radial-gradient(ellipse at left bottom, rgba(22, 24, 47, 1) 0%,rgba(38, 20, 72, .9) 59%, rgba(17, 27, 75, .9) 100%);
            box-shadow: 0 -20px 150px -20px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .form-login {
            position: relative;
            z-index: 1;
            padding-bottom: 4.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .login-nav {
            margin: 0;
            padding: 0;
            text-align: center;
            margin-bottom: 2em;
        }

        .login-nav__item {
            display: inline-block;
            margin-right: 2.25rem;
        }

        .login-nav__item a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 1.25rem;
            padding-bottom: .5rem;
            transition: .20s all ease;
        }

        .login-nav__item.active a,
        .login-nav__item a:hover{
            color: #ffffff;
        }

        .login-nav__item a:after {
            content: '';
            display: inline-block;
            height: 10px;
            background-color: rgb(255, 255, 255);
            position: absolute;
            right: 100%;
            bottom: -1px;
            left: 0;
            border-radius: 50%;
            transition: .15s all ease;
        }

        .login-nav__item a:hover:after,
        .login-nav__item.active a:after{
            background-color: rgb(17, 97, 237);
            height: 2px;
            right: 0;
            bottom: 2px;
            border-radius: 0;
        }

        .login__label {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            font-size: .75rem;
            margin-bottom: 1rem;
        }

        .login__input {
            color: white;
            font-size: 1.15rem;
            width: 100%;
            padding: .5rem 1rem;
            border: 2px solid transparent;
            outline: none;
            border-radius: 1.5rem;
            background-color: rgba(255, 255, 255, 0.25);
            letter-spacing: 1px;
        }

        .login__input:hover,
        .login__input:focus{
            border: 2px solid rgba(255, 255, 255, 0.5);
            background-color: transparent;
        }

        .login__input + .login__label {
            margin-top: 1.5rem;
        }

        .login__input--checkbox {
            position: absolute;
            top: .1rem;
            left: 0;
            margin: 0;
        }

        .login__submit {
            color: #ffffff;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
            padding: .75rem;
            border-radius: 2rem;
            display: block;
            width: 100%;
            background-color: rgba(17, 97, 237, .75);
            border: none;
            cursor: pointer;
        }

        .login__submit:hover {
            background-color: rgba(17, 97, 237, 1);
        }

        .login__forgot {
            display: block;
            margin-top: 3rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.75);
            font-size: .75rem;
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .login__forgot:hover {
            color: rgb(17, 97, 237);
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="school_logo.png" alt="School Logo">
        <h1>School Login Portal</h1>
    </div>

    <div class="login-container">
        <form action="#" class="form-login" id="login-form">
            <ul class="login-nav">
                <li class="login-nav__item active">
                    <a href="#" id="sign-in">Sign In</a>
                </li>
                <li class="login-nav__item">
                    <a href="#" id="sign-up">Sign Up</a>
                </li>
            </ul>
            <label for="login-input-user" class="login__label">Username</label>
            <input id="login-input-user" class="login__input" type="text" placeholder="Enter your username" required />
            <label for="login-input-password" class="login__label">Password</label>
            <input id="login-input-password" class="login__input" type="password" placeholder="Enter your password" required />
            <label for="login-sign-up" class="login__label--checkbox">
                <input id="login-sign-up" type="checkbox" class="login__input--checkbox" />
                Keep me Signed in
            </label>
            <button class="login__submit">Sign in</button>
        </form>
        <a href="#" class="login__forgot">Forgot Password?</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("login-form");
            const signInLink = document.getElementById("sign-in");
            const signUpLink = document.getElementById("sign-up");

            signInLink.addEventListener("click", function(event) {
                event.preventDefault();
                signUpLink.classList.remove("active");
                this.classList.add("active");
                // Change form action, etc. for sign in
            });

            signUpLink.addEventListener("click", function(event) {
                event.preventDefault();
                signInLink.classList.remove("active");
                this.classList.add("active");
                // Change form action, etc. for sign up
            });

            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the form from submitting

                // Perform form validation
                const username = document.getElementById("login-input-user").value.trim();
                const password = document.getElementById("login-input-password").value.trim();

                if (username === "" || password === "") {
                    alert("Please enter both username and password");
                    return;
                }

                // If validation passes, you can proceed with form submission
                // For example, you can submit the form using AJAX

                // Dummy example:
                const formData = new FormData(form);
                fetch("your-backend-url", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response
                    console.log(data);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        });
    </script>
</body>
</html>
