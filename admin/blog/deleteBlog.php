<?php
    include 'blogProcess.php';
 
    $obj = new Blog();
    $obj->delete($_GET['id']);
    new Redirect("viewBlog.php");
?>