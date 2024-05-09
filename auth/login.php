<?php
session_start();
require_once '../functions/helpers.php';
require_once '../functions/pdo_connection.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // No need to sanitize password

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = 'All fields are required';
    } else {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format';
        } else {
            // Check if user exists
            $query = "SELECT * FROM users WHERE email = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$email]);
            $user = $statement->fetch();

            if ($user !== false) {
                // Verify password
                if (password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user->email;
                    redirect('panel');
                } else {
                    $error = 'Password is incorrect';
                }
            } else {
                $error = 'Email not found';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background: #4c4d4a" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">Blog login</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger"><?php if ($error !== '') echo $error; ?></small>
                </section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action="<?= url('auth/login.php') ?>" method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ..." required>
                        <!-- Add email validation message -->
                        <small class="text-danger" id="email-validation-msg"></small>
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ..." required>
                        <!-- Add password validation message -->
                        <small class="text-danger" id="password-validation-msg"></small>
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input type="submit" class="btn btn-success btn-sm" value="Login">
                        <a class="" href="<?= url('auth/register.php') ?>">Register</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
    <script>
        // Client-side validation
        document.getElementById('email').addEventListener('input', function() {
            var emailField = document.getElementById('email');
            var emailErrorMsg = document.getElementById('email-validation-msg');
            if (emailField.validity.valid) {
                emailErrorMsg.textContent = '';
            } else {
                emailErrorMsg.textContent = 'Please enter a valid email address';
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            var passwordField = document.getElementById('password');
            var passwordErrorMsg = document.getElementById('password-validation-msg');
            if (passwordField.validity.valid) {
                passwordErrorMsg.textContent = '';
            } else {
                passwordErrorMsg.textContent = 'Password is required';
            }
        });
    </script>
</body>

</html>
