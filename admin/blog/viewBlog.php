<?php
    include 'blogController.php';
?>

<html>
    <head>
    <link rel="stylesheet" href="../../css/Admin_style.css">
    </head>
<body>
    <nav class="nav-bar">
        <h1>Blogs</h1>
        <form action="viewBlog.php" method="post" class="filter">
            <select name="search">
            <option value="All">All</option>
            <option value="Requesting">Requesting</option>
            <option value="Activate">Activate</option>
            </select>
            <input type="submit" value="Search" name="submit">
        </form>
    </nav>
</body>
</html>

<?php
    $obj = new Blog();

    if(isset($_POST['submit']))
    {
       $data =  $obj->view('blogs',$_POST['search']);
    }
    else
    {
        $data = $obj->view('blogs');
    }

    if(empty($data))
    {
        echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No Blogs Exist</h1></tr></table>";
        die;
    }
    echo "<table cellspacing=0 style=\"margin-left:10%;\">";
    echo "<tr> <th>ID</th> <th>Title</th> <th>Created On</th> <th>Edit</th> <th>Status</th> <th>Delete</th></tr>";
    foreach($data as $value)
    {
        echo "<tr>";
        echo "<td>".$value['id']."</td>";
        echo "<td>".$value['title']."</td>";
        echo "<td>".$value['date']."</td>";
        echo "<td><a href = 'editBlog.php?id=".$value['id']."' class='edit'>Edit</a></td>";
        if($value['activate']==0)
        {
            echo "<td><a href = 'activateBlog.php?id=".$value['id']."' class='active'>Deactivate</a></td>";
        }
        else
        {
            echo "<td><a href = 'activateBlog.php?id=".$value['id']."' class='deactive'>Activate</a></td>";
        }
        echo "<td><a href = 'deleteBlog.php?id=".$value['id']."'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";

?>