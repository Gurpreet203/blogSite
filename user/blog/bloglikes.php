<?php
    include 'blogProcess.php';
    $obj = new Blogs();
    $obj->validate();

    if(isset($_GET['dislike']))
    {
        $obj->dislikes($_GET['id']);
    }
    else
    {
        $obj->likes($_GET['id']);
    }
    header('location:viewBlog.php?id='.$_GET['id']);
?>