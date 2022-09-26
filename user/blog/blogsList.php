<?php
    include 'nav.html';
    include 'BlogProcess.php';
    
    $obj = new Blog();
    
    $obj->List();
?>