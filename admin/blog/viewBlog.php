<?php
    include 'blogProcess.php';
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
        $obj->show($_POST['search']);
    }
    else
    {
        $obj->show();
    }
?>