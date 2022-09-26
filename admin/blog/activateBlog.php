<?php
    include 'blogController.php';
    $obj = new Blogs();
    $obj->status('blogs',$_GET['id']);

    new Redirect("viewBlog.php");
?>