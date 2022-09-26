<?php
    include 'nav.html';
    include 'BlogProcess.php';
    
?>

<html>
    <head>
        <body>
            <a href="blogsList.php" class="back"><i class="bi bi-backspace"></i> Back</a>
        </body>
    </head>
</html>

<?php

    $obj = new Blog();
    $data = $obj->viewBlog($_GET['id']);
    
?>