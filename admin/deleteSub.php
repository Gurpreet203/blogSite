<?php
    include 'admin_controller.php';
   
    $obj = new Admin();
    $obj->validatePage();

    $obj->delete('admin',$_GET['id']);
    
    new Redirect("viewAdmin.php");
?>