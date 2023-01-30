<?php
    include_once '../config/config.php';

    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])) {
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
        $author = htmlspecialchars($_POST['author'], ENT_QUOTES, 'UTF-8');

        if (strlen($title) && strlen($content) && strlen($author))
        {
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
    
            $stmt = mysqli_prepare($conn, "INSERT INTO posts (title, content, author, created_at) VALUES (?, ?, ?, now())");
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $author);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    header("Location: index.php");