<?php
    include 'nav.php';
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
    $id = $_GET['id'];
    $data = $obj->viewBlog($_GET['id']);

    echo "<h1 class=\"title\">".$data['title']."</h1>";
    echo "<div class=\"description\">";
    echo "<p>".$data['description']."</p></div>";
   
    if($data['likes']==1)
    {
        echo  "<span class='numbers'>".$data['likes']." Likes</span><a href='bloglikes.php?id=$id&dislike=1'class='like'><i class=\"bi bi-hand-thumbs-down\"></i> DISLIKES </a>".$data['dislikes']." dislikes";
    }
    else
    {
        echo  "<span class='numbers'>".$data['dislikes']." Dislikes</span><a href='bloglikes.php?id=$id'class='like'><i class=\"bi bi-hand-thumbs-up\"></i> LIKES </a>".$data['likes']." likes";
    }
    
    echo "<p class=\"date\">Created on ".$data['date']."</p>";
?>