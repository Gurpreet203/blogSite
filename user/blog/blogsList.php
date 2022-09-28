<?php
    include 'nav.php';
    
    if(isset($_GET['deactive']))
    {
        echo "<script>alert(\"This blog is deactivate by the Admin\")</script>";
    }
    $obj = new Blog();

    $obj->List();
?>