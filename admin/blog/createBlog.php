<?php
    include 'blogController.php';
    
    if(isset($_POST['submit']))
    {
        $obj = new Blogs($_POST);
        $obj->create();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/Admin_style.css">
    <title>Document</title>
</head>
<body>
    <nav class="nav-bar">
        <h1>Create Blog</h1>
    </nav>
    <?php
        if(isset($_POST['submit']))
        {
            if(empty($error))
            {
                echo "<h2 style=\"text-align:center;\">Successfully Created</h2>";
            }  
            else
            {
                if(isset($error['size']))
                {
                    echo "<h2 style=\"text-align:center;\">".$error['size']."</h2>";
                }
            }
        }
    ?>
    <form action="createBlog.php" method="post" class="blog">
            <label for="title">Title of Blog</label>
            <input type="text" name="title" placeholder="Title"/>
            <?php
                    if(!empty($error['title']))
                    {
                        echo "<p class='error'>".$error['title']."</p>";
                    }
            ?>
            <label for="description">Description of Blog</label>
            <textarea name="description" cols="50" rows="20" placeholder="Description"></textarea>
            <?php
                    if(!empty($error['description']))
                    {
                        echo "<p class='error'>".$error['description']."</p>";
                        $error = array();
                    }
                ?>
            <input type="submit" name="submit" value="Create"/>
    </form>
</body>
</html>