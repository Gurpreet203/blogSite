<?php
    include 'UserProcess.php';

    $id = $_GET['id'];
    $conn = new DataBase();
    $conn = $conn->config();
    $data = $conn->query("SELECT * FROM user WHERE id='$id'");
    $data = $data->fetch(PDO::FETCH_ASSOC);

    if(!$data)
    {
        new Redirect('viewUsers.php');
    }

    if(isset($_POST['submit']))
    {
        $obj = new UserByAdmin($_POST);
        $obj->update($id);
        if(empty($error))
        {
            new Redirect("viewUsers.php?id=".$id);
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
    <nav class="nav-bar">
        <h1>Edit User</h1>
    </nav>
    <form action="editUser.php?id=<?php echo $id?>" method="post" class="createUser">
        <label for="fname">First Name</label>
        <input type="text" placeholder="First Name" name="fname" value=<?php echo $data['first_name']?>>
            <?php
                if(!empty($error['fname']))
                {
                    echo "<p class='error'>".$error['fname']."</p>";
                }
            ?>
        <label for="lname">Last Name</label>
        <input type="text" placeholder="Last Name" name="lname" value=<?php echo $data['last_name']?>>
            <?php
                if(!empty($error['lname']))
                {
                    echo "<p class='error'>".$error['lname']."</p>";
                }
            ?>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" value=<?php echo $data['email']?>>
            <?php
                if(!empty($error['email']))
                {
                    echo "<p class='error'>".$error['email']."</p>";
                }
            ?>
        <label for="pass">Password</label>
        <input type="password" name="pass" placeholder="Password" value=<?php echo $data['password']?>>
            <?php
                if(!empty($error['pass']))
                {
                    echo "<p class='error'>".$error['pass']."</p>";
                    $error = array();
                }
            ?>
        <input type="submit" name="submit" value="Change">
    </form>
</body>
</html>