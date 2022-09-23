<html>
    <head>
    <link rel="stylesheet" href="../../css/Admin_style.css">
    </head>
<body>
    <nav class="nav-bar">
        <div>
        <h1>List of Users</h1>
        </div>
        
        <div>
        <form action="viewUsers.php" method="post" class="filter">
            <select name="search">
            <option value="All">All</option>
            <option value="Requesting">Requesting</option>
            <option value="Activate">Activate</option>
            </select>
            <input type="submit" value="Search" name="submit">
        </form>
        </div>
    </nav>
</body>
</html>
<?php
    include 'UserProcess.php';

    $obj = new UsersByAdmin();
    if(isset($_POST['submit']))
    {
        $obj->viewUsers($_POST['search']);
    }
    else
    {
        
        $obj->viewUsers();
    }
?>