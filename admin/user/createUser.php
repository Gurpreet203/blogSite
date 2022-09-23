<?php
include 'UserProcess.php';

if(isset($_POST['submit']))
{
    $obj = new UsersByAdmin($_POST);
    $obj->create();
    if(empty($error))
    {
        echo "<h2 style=\"text-align:center;\">Successfully Created</h2>";
    }  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/Admin_style.css">
    <title>Document</title>
</head>
<body>
    <form action="createUser.php" method="post" class="createUser">
       
            <h1>SignUp</h1>
            <label for="fname">First Name</label>
            <input type="text" placeholder="First Name" name="fname">
                <?php
                    if(!empty($error['fname']))
                    {
                        echo "<p class='error'>".$error['fname']."</p>";
                    }
                ?>
            <label for="lname">Last Name</label>
            <input type="text" placeholder="Last Name" name="lname">
            <?php
                    if(!empty($error['lname']))
                    {
                        echo "<p class='error'>".$error['lname']."</p>";
                    }
                ?>
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
            <label for="radio">Activate User ??</label><br>
            <div class="radio"> 
            <label for="true" class="radio">Yes</label>
            <input type="radio" name="radio" value="true" id="true">
            </div>
            <div class="radio">
            <label for="false" class="radio">No</label>
            <input type="radio" name="radio" value="false" id="false">
            </div>
            
            <input type="submit" name="submit" value="Create">
        
    </form>
</body>
</html>