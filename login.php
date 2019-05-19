<?php
    require("dbConnection.php");

    $email = trim(strip_tags($_POST["adm_email"]));
    $password = trim(strip_tags($_POST["adm_password"]));

    $select_email = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $select_email->execute([$email]);
    $found_email_count = $select_email->rowCount();
    if ($found_email_count == 1) {
        $found_email = $select_email->fetch();
        $hash = $found_email["password"];
        $uid = $found_email["id"];
        if (password_verify($password, $hash)) {
            session_start();
            $_SESSION["userID"] = $uid;
            header("location: dashboard.php");
        } else {
            header("location: index.php?error=2");
        }
    } else {
        header("location: index.php?error=1");
    }
?>