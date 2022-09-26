<?php
    include 'blogController.php';
    $obj = new Blog();
    $obj->status('blogs',$_GET['id']);

    new Redirect("viewBlog.php");
?>