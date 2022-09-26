<?php
    include 'blogController.php';
    
    $id = $_GET['id'];
    $conn = new DataBase();
    $conn = $conn->config();
    $data = $conn->query("SELECT title,description FROM blogs WHERE id='$id'");
    $data = $data->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['submit']))
    {
        $obj = new Blogs($_POST);
        $obj->update($id);
        if(empty($error))
        {
            new Redirect("viewBlog.php?id=".$id);
        }  
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
        <h1>Edit Blog</h1>
    </nav>
    <form action="editBlog.php?id=<?php echo $id?>" method="post" class="blog">
            <label for="title">Title of Blog</label>
            <input type="text" name="title" placeholder="Title" value=<?php global $data; echo$data['title'];?>>
            <?php
                    if(!empty($error['title']))
                    {
                        echo "<p class='error'>".$error['title']."</p>";
                    }
            ?>
            <label for="description">Description of Blog</label>
            <textarea name="description" cols="50" rows="20" placeholder="Description"><?php global $data; echo$data['description'];?></textarea>
            <?php
                    if(!empty($error['description']))
                    {
                        echo "<p class='error'>".$error['description']."</p>";
                        $error = array();
                    }
                ?>
            <input type="submit" name="submit" value="Change">
    </form>
</body>
</html>