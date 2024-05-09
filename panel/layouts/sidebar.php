<?php
    try {
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
        $pdo = new PDO("mysql:host=$serverName;dbname=bit-blog", $userName, $password, $options); 

        $userEmail = $_SESSION['user'];

        $queryGetUser = "SELECT id FROM users WHERE email = :email"; // Select only the id column
        $statementUser = $pdo->prepare($queryGetUser);
        $statementUser->execute(['email' => $userEmail]);
        $user = $statementUser->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "PDO Exception: " . $e->getMessage();
    }

?>
<section class="sidebar">


    <?php if ($user && $user->id === 1): ?>
        <section class="sidebar-link">
        <a href="<?= url('panel') ?>">panel</a>
        </section>
        <section class="sidebar-link">
            <a href="<?= url('panel/category') ?>">category</a>
        </section>
        <section class="sidebar-link">
            <a href="<?= url('panel/post') ?>">post</a>
        </section>
        <section class="sidebar-link">
            <a href="<?= url('panel/user') ?>">users</a>
        </section>

    <?php else: ?>
        <!-- Only show the 'post' link for users with ID = 1 -->
        <section class="sidebar-link">
            <a href="<?= url('panel/post') ?>">post</a>
        </section>
    <?php endif; ?>
</section>