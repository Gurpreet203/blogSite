<?php
    include 'BlogProcess.php';
    $obj = new Blog();

    if(isset($_GET['dislike']))
    {
        $obj->likeDislike($_GET['id'],0);
    }
    else
    {
        $obj->likeDislike($_GET['id']);
    }
    header('location:viewBlog.php?id='.$_GET['id']);
?>