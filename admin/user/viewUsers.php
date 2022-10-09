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

    $obj = new UserByAdmin();

    if(isset($_POST['submit']))
    {
       $data =  $obj->view('user',$_POST['search']);
    }
    else
    {
        
        $data = $obj->view('user');
    }

    if(empty($data))
    {
        echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No User Exist</h1></tr></table>";
        die;
    }
    echo "<table cellspacing=0 style=\"margin-left:10%;\">";
    echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Edit</th> <th>Status</th> <th>Delete</th></tr>";
    foreach($data as $value)
    {
        echo "<tr>";
        echo "<td>".$value['id']."</td>";
        echo "<td>".$value['first_name']."</td>";
        echo "<td>".$value['last_name']."</td>";
        echo "<td>".$value['email']."</td>";
        echo "<td><a href = 'editUser.php?id=".$value['id']."' class='edit'>Edit</a></td>";
        if($value['activate']==0)
        {
            echo "<td><a href = 'activate.php?id=".$value['id']."' class='active'>Deactivate</a></td>";
        }
        else
        {
            echo "<td><a href = 'activate.php?id=".$value['id']."' class='deactive'>Activate</a></td>";
        }
        echo "<td><a href = 'delete.php?id=".$value['id']."'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
        
?>