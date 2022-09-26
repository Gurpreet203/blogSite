<?php
    include "UserProcess.php";
    $obj = new UserByAdmin();
    $obj->status('user',$_GET['id']);

    new Redirect("viewUsers.php");
    
?>