<?php
    session_start();
    unset($_SESSION['loginAdmin']);
    unset($_SESSION['adminRoll']);
    header("location:admin_login.php");
?>