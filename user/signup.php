<?php
    include 'userController.php';

    if(isset($_POST['submit']))
    {
        $obj = new User($_POST);
        $obj->signup();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <img src="../images/logo.jpg" alt="Logo" class="logo">
    <form action="signup.php" method="post">
        <div class="right-img">
            <img src="../images/signup.png" alt="SignUp image">
        </div>
        <div class="form-content">
            <h1>SignUp</h1>
            <label for="fname">First Name</label>
            <input type="text" placeholder="First Name" name="fname"/>
                <?php
                    if(!empty($error['fname']))
                    {
                        echo "<p class='error'>".$error['fname']."</p>";
                    }
                ?>
            <label for="lname">Last Name</label>
            <input type="text" placeholder="Last Name" name="lname"/>
            <?php
                    if(!empty($error['lname']))
                    {
                        echo "<p class='error'>".$error['lname']."</p>";
                    }
                ?>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email"/>
            <?php
                    if(!empty($error['email']))
                    {
                        echo "<p class='error'>".$error['email']."</p>";
                    }
                ?>
            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="Password"/>
            <?php
                    if(!empty($error['pass']))
                    {
                        echo "<p class='error'>".$error['pass']."</p>";
                        $error = array();
                    }
                ?>
            <input type="submit" name="submit" value="SignUp"/>
            <a href="LogIn.php">Already Have a Account?? LogIn</a>
        </div>
    </form>
</body>
</html>