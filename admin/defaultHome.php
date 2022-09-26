<?php
    include 'admin_controller.php';
    $obj = new Admin();
    $obj->validatePage();
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
<body class="default-body">
    <h1 class="default">
        Welcome Admin
    </h1>
    <img src="../images/analitics.png" alt="analitics" class="defaultimg">
</body>
</html>