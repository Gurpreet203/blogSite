<?php
    include 'UserProcess.php';

    $obj = new UserByAdmin();
    $obj->delete('user',$_GET['id']);
    new Redirect('viewUsers.php');
?>