<?php
    include 'UserProcess.php';

    $obj = new UsersByAdmin();
    $obj->delete($_GET['id']);
    new Redirect('viewUsers.php');
?>