<?php
     require_once '../../functions/helpers.php';
     require_once '../../functions/pdo_connection.php';
     require_once '../../functions/auth.php';



     if(isset($_GET['user_id']) && $_GET['user_id']){

        $query = "SELECT * FROM users WHERE id = ?;";
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['user_id']]);
        $post = $statement->fetch();
        $basePath = dirname(dirname(__DIR__));
                if(file_exists($basePath . $post->image))
                {
                    unlink($basePath . $post->image);
                }
            $query = "DELETE FROM users  WHERE id = ? ;";
            $statement = $pdo->prepare($query);
           $statement->execute([$_GET['user_id']]);
     }
     redirect('panel/user');