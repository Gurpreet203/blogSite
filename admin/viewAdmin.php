<?php
    include 'admin_process.php';
    $obj = new Admin();
    $obj->validate();
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
   
    $obj->viewAdmin();
?>