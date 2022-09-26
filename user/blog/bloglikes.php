<?php
    include 'fetchBlog.php';
    $obj = new FetchBlogs();
    $obj->validatePage();

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