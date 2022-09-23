<?php
    include "UserProcess.php";
    $obj = new UsersByAdmin();
    $obj->status($_GET['id']);
    if(isset($_GET['request']))
    {
        new Redirect("requestingUsers.php");
        echo $_GET['request'];
    }
    else
    {
        new Redirect("viewUsers.php");
    }
   
?>