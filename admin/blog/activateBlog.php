<?php
    include 'blogProcess.php';
    $obj = new Blog();
    $obj->status($_GET['id']);
?>