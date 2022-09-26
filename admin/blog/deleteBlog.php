<?php
    include 'blogController.php';
 
    $obj = new Blog();
    $obj->delete('blogs',$_GET['id']);
    new Redirect("viewBlog.php");
?>