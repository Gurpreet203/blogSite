<?php
    include 'nav.html';
    include 'fetchBlog.php';
    
    $obj = new FetchBlogs();
    $obj->validatePage();
    $obj->List();
?>