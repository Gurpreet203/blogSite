<?php
    include 'blogController.php';
 
    $obj = new Blogs();
    $obj->delete('blogs',$_GET['id']);
    new Redirect("viewBlog.php");
?>