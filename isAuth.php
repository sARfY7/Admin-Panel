<?php
    if (!isset($_SESSION["userID"])) {
        header("location: index.php?error=3");
    }
?>