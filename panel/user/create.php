<?php
     require_once '../../functions/helpers.php';
     require_once '../../functions/pdo_connection.php';
     require_once '../../functions/auth.php';



     if(isset($_POST['email']) && $_POST['email'] !== '' && isset($_POST['first_name']) && $_POST['first_name'] !== '' && isset($_POST['last_name']) && $_POST['last_name'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') 
     {    
        
          if($category !== false && $image_upload !== false)
          {
            try {
                // Check if email exists in session
                if (isset($_SESSION['user'])) {
                    $userEmail = $_SESSION['user'];
                    
                    // Prepare and execute the SQL query to retrieve user ID
                    $queryGetUser = "SELECT id FROM users WHERE email = :email"; // Select only the id column
                    $statementUser = $pdo->prepare($queryGetUser);
                    $statementUser->execute(['email' => $userEmail]);
                    $user = $statementUser->fetch(PDO::FETCH_OBJ);
            
                    if ($user) {
                        $query = "INSERT INTO posts (title, cat_id, body, image, created_at, user_id) VALUES (?, ?, ?, ?, NOW(), ?)";
                        $statement = $pdo->prepare($query);
                        $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $image, $user->id]);
                        // Check for success or handle any potential errors
                    } else {
                        // Handle case where user is not found
                        echo "User not found";
                    }
                } else {
                    // Handle case where email is not set in the session
                    echo "Email not found in session";
                }
            } catch (PDOException $e) {
                // Handle PDO exceptions (e.g., database connection error, syntax error)
                echo "PDO Exception: " . $e->getMessage();
            }
          }
          redirect('panel/user');
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

                <form action="<?= url('panel/post/create.php') ?>" method="post" enctype="multipart/form-data">
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