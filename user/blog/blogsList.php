<?php
    include 'nav.php';
    
    if(isset($_GET['deactive']))
    {
        echo "<script>alert(\"This blog is deactivate by the Admin\")</script>";
    }
    
    $obj = new Blog();

    $data =  $obj->List();

    if(empty($data))
    {
        echo "<h1 style=\"margin-left:50%;margin-top:50%;\">No Blog Exist</h1></tr></table>";
        die;
    }
    
    echo "<ol class='blogList'>";
    foreach($data as $value)
    {
        if($value['activate']==1)
        {
            echo "<li><a href='viewBlog.php?id=".$value['id']."'>".$value['title']."</li>";
        }
    }
    echo "</ol>";
?>