<?php
    include 'nav.html';
    include 'blogProcess.php';
    
    $obj = new Blogs();
    $obj->validate();
    $obj->view($_GET['id']);
?>
<html>
    <head>
        <body>
            <a href="blogsList.php" class="back"><i class="bi bi-backspace"></i> Back</a>
        </body>
    </head>
</html>