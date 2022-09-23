<?php
    include 'admin_process.php';
   
    $obj = new Admin();
    $obj->validate();
    
    $obj->deleteSub($_GET['id']);
    new Redirect("viewAdmin.php");
?>