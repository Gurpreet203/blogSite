<?php
    include 'admin_controller.php';
    $obj = new Admin();
    $obj->validatePage();
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/Admin_style.css">
</head>
<body>
    <nav class="nav-bar">
        <h1>List of Sub-Admins</h1>
    </nav>
</body>
</html>

<?php
   
    $data = $obj->viewAdmin();

    if(empty($data))
    {
        echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No Sub Admin Exist</h1></tr></table>";
        die;
    }
    echo "<table cellspacing=0>";
    echo "<tr> <th>ID</th> <th>Email</th>";
    if($_SESSION['adminRoll']==1)
    {
        echo "<th>DELETE</th>";
    } 
    echo "</tr>";
    foreach($data as $value)
    {
        echo "<tr>";
        echo "<td>".$value['id']."</td>";
        echo "<td>".$value['email']."</td>";
        if($_SESSION['adminRoll']==1)
        {
            echo "<td><a href = 'deleteSub.php?id=".$value['id']."'>Delete</a></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
?>