<?php
    include 'admin_process.php';

    $obj = new Check();
    $valid = $obj->AdminPageValidate();
    if($valid==true)
    {
        new Redirect("admin_index.php");
    }

    if(isset($_POST['submit']))
    {
        $obj = new Admin($_POST);
        $obj->login();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin_style.css">
    <title>Document</title>
</head>
<body>
    <img src="../images/logo.jpg" alt="Logo" class="logo">
    <?php
        if(!empty($error['notfound']))
        {
            echo "<div class=\"not-found\">".$error['notfound']."</div>";
        }
    ?>
    <form action="admin_login.php" method="post" class="login admin-form">
        <div class="right-img">
            <img src="../images/admin-login.jpg" alt="SignUp image">
        </div>
        <div class="form-content">
            <h1>Welcome Admin</h1>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email">
            <?php
                if(!empty($error['email']))
                {
                    echo "<p class='error'>".$error['email']."</p>";
                }
            ?>
            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="Password">
            <?php
                if(!empty($error['pass']))
                {
                    echo "<p class='error'>".$error['pass']."</p>";
                }
            ?>
            <input type="submit" name="submit" value="LogIn">
        </div>
    </form>
</body>
</html>