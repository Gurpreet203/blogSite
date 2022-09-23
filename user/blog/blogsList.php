<?php
    include 'nav.html';
    include 'blogProcess.php';
    
    $obj = new Blogs();
    $obj->validate();
    $obj->List();
?>