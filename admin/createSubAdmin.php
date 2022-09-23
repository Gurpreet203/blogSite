<?php
    include 'admin_process.php';
    $obj = new Admin();
    $obj->validate();
    
    if(isset($_POST['submit']))
    {
        $obj = new Admin($_POST);
        $obj->createSubAdmin();
        if(empty($error))
        {
            echo "<h2 style=\"text-align:center;\">Successfully Created</h2>";
        }  
        else
        {
            if(isset($error['reserve']))
            {
                echo "<h2 style=\"text-align:center;\">".$error['reserve']."</h2>";
            }
        }
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
<form action="createSubAdmin.php" method="post" class="sub-admin">
   
    <h1>Sub-Admin</h1>
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
    <input type="submit" name="submit" value="Create">
</form>
</body>
</html>