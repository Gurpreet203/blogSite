<?php
    include 'userController.php';
    
    if(isset($_POST['submit']))
    {
        $obj = new User($_POST);
        $obj->forgetPassword();
        if(isset($status['login']))
        {
            echo "<div class='status'>".$status['login']."</div>";
        }
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
        if(!empty($error['login']))
        {
            echo "<div class='activate'>".$error['login']."</div>";
        }
    ?>
    <img src="../images/logo.jpg" alt="Logo" class="logo">
    <form action="forgetPassword.php" method="post" class="login">
        <div class="right-img">
            <img src="../images/resetPassword.png" alt="resetPass">
        </div>
        <div class="form-content">
            <h1>Forget Password</h1>
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
            <input type="submit" name="submit" value="Change"/>
            <a href="login.php">Back</a>
        </div>
    </form>
</body>
</html>