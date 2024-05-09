<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/auth.php';

// Ensure user_id is set in the URL
if (!isset($_GET['user_id'])) {
    redirect('panel/user');
}

// Fetch the user's data from the database
$query = "SELECT id, email, first_name, last_name FROM users WHERE id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['user_id']]);
$user = $statement->fetch();
$GLOBALS['current_user'] = $user;


// Check if the query executed successfully
if ($user === false) {
    echo "Failed to fetch user data.";
    exit; // Stop execution
}

// Check if the user object contains the expected properties
if (!isset($user->email, $user->first_name, $user->last_name)) {
    echo "User data is incomplete.";
    exit; // Stop execution
}

// Handle form submission
if (
    isset($_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['password'])
    && !empty($_POST['email']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password'])
) {
    // Sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare SQL statement
        $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, password = ? WHERE id = ?";
        $statement = $pdo->prepare($query);

        // Execute the statement with sanitized inputs
        $statement->execute([$email, $first_name, $last_name, $hashed_password, $_GET['user_id']]);

        // Redirect after successful update
        redirect('panel/user');
    } catch (PDOException $e) {
        // Handle PDO exceptions (e.g., database connection error, syntax error)
        echo "PDO Exception: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <?php require_once '../layouts/top-nav.php'; ?>

        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require_once '../layouts/sidebar.php'; ?>
                </section>
                <section class="col-md-10 pt-3">
                    <form action="<?= url('panel/user/edit.php?user_id=') . $_GET['user_id'] ?>" method="post">
                        <section class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= $current_user->email ?>" required>
                        </section>
                        <section class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?= $current_user->first_name ?>" required>
                        </section>
                        <section class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= $current_user->last_name ?>" required>
                        </section>
                        <section class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>
