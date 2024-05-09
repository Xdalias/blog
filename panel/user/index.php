<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/auth.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    redirect('auth/login.php');
}

$userEmail = $_SESSION['user'];

// Fetch the logged-in user's data from the database
$queryGetUser = "SELECT * FROM users WHERE email = :email";
$statementUser = $pdo->prepare($queryGetUser);
$statementUser->execute(['email' => $userEmail]);
$user = $statementUser->fetch(PDO::FETCH_OBJ);

// Check if the logged-in user exists
if (!$user) {
    redirect('auth/login.php');
}

// Check if the logged-in user is an admin
if ($user->id !== 1) {
    redirect('auth/login.php');
}

// Handle form submission if any
// ...

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
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
                    <section class="mb-2 d-flex justify-content-between align-items-center">
                        <h2 class="h4">Users</h2>
                        <a href="<?= url('panel/user/create.php') ?>" class="btn btn-sm btn-success">Create</a>
                    </section>
                    <section class="table-responsive">
                        <table class="table table-striped table-">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Created at</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch all users from the database
                                $query = "SELECT * FROM users";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $users = $statement->fetchAll();

                                foreach ($users as $key => $user) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->first_name ?></td>
                                        <td><?= $user->last_name ?></td>
                                        <td><?= $user->created_at ?></td>
                                        <td>
                                            <?php
                                            // Check if the user's ID is not 1
                                            if ($user->id !== 1) {
                                                ?>
                                                <a href="<?= url('panel/user/edit.php?user_id=' . $user->id) ?>" class="btn btn-block btn-info btn-sm">Edit</a>
                                                <a href="<?= url('panel/user/delete.php?user_id=' . $user->id) ?>" class="btn btn-block btn-danger btn-sm">Delete</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>