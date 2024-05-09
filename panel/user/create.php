<?php
require_once '../../functions/helpers.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/auth.php';

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
        $query = "INSERT INTO users (email, first_name, last_name, password, created_at) VALUES (?, ?, ?, ?, NOW())";
        $statement = $pdo->prepare($query);

        // Execute the statement with sanitized inputs
        $statement->execute([$email, $first_name, $last_name, $hashed_password]);

        // Redirect after successful insertion
        redirect('panel/user');
    } catch (PDOException $e) {
        // Handle PDO exceptions (e.g., database connection error, syntax error)
        echo "PDO Exception: " . $e->getMessage();
    }
} else {
    // Handle case where required fields are missing
    echo "All fields are required.";
}
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

                <form action="<?= url('panel/user/create.php') ?>" method="post" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name ...">
                    </section>
                    <section class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password ...">
                    </section>
                    <section class="form-group">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password ...">
                        <small id="passwordMatchError" class="text-danger" style="display: none;">Passwords do not match</small>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>


<script>
    document.getElementById("submitButton").addEventListener("click", function(event) {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Prevent form submission
            document.getElementById("passwordMatchError").style.display = "block";
        }
    });
</script>
<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>

<script src="<?= asset('assets/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('body')
</script>

</body>
</html>