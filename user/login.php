<?php
    include 'userController.php';

    $obj = new User();
    $obj->validatePage();

    if(isset($_POST['submit']))
    {
        $obj = new User($_POST);
        $obj->login();
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
<?php
        if(!empty($error['noactivation']))
        {
            echo "<div class='not-activate'>".$error['noactivation']."</div>";
        }
        if(!empty($error['activation']))
        {
            echo "<div class='activate'>".$error['activation']."</div>";
        }
        elseif(!empty($error['login']))
        {
            echo "<div class='activate'>".$error['login']."</div>";
        }
    ?>
    <img src="../images/logo.jpg" alt="Logo" class="logo">
    <form action="login.php" method="post" class="login">
        <div class="right-img">
            <img src="../images/login.jpg" alt="SignUp image">
        </div>
        <div class="form-content">
            <h1>LogIn</h1>
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
                        $error = array();
                    }
                ?>
            <input type="submit" name="submit" value="LogIn">
            <a href="signup.php">Don't Have a Account?? SignUp</a>
            <a href="forgetPassword.php">Forget Password</a>
        </div>
    </form>
</body>
</html>