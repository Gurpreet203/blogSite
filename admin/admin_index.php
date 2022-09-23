<?php
    // session_start();
    include "admin_process.php";

    $obj = new Admin();
    $obj->validate();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <section class="main-container">
        <section class="left-nav">
            <img src="../images/logo.jpg" alt="" class="logo-panel">
            <a href="" class="admin-heading"><h1>Admin</h1></a>
            <nav>
                <ul>
                    <li>
                        <a href="createSubAdmin.php" class="link" target="myframe"><i class="bi bi-pencil-square"></i> Create Sub-Admin</a>
                    </li>
                    <li>
                        <a href="viewAdmin.php" class="link" target="myframe"><i class="bi bi-binoculars"></i> View Sub-Admin</a>
                    </li>
                    <li>
                       <a href="user/createUser.php" class="link" target="myframe"><i class="bi bi-pencil-square"></i> Create User</a>
                    </li>
                    <li>
                        <a href="user/viewUsers.php" class="link" target="myframe"><i class="bi bi-binoculars"></i> View Users</a>
                    </li>
                    <li>
                        <a href="blog/createBlog.php" class="link" target="myframe"><i class="bi bi-pencil-square"></i> Create Blog</a>
                    </li>
                    <li>
                        <a href="blog/viewBlog.php" class="link" target="myframe"><i class="bi bi-binoculars"></i> View Blog</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="bi bi-box-arrow-left"></i> LogOut</a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class="rest-screen">
            <iframe src="defaultHome.php" frameborder="0" name="myframe"></iframe>
        </section>
    </section>
</body>
</html>