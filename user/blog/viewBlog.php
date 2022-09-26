<?php
    include 'nav.html';
    include 'BlogProcess.php';
    $obj = new Blog();
    $obj->validatePage();
?>

<html>
    <head>
        <body>
            <a href="blogsList.php" class="back"><i class="bi bi-backspace"></i> Back</a>
        </body>
    </head>
</html>

<?php

    $data = $obj->viewBlog($_GET['id']);
    
?>