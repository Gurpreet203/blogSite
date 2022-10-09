<?php
    include '../../database/connection.php';
    include '../../commonControllers/validation.php';

    $obj = new Validate();
    $valid = $obj->UserPageValidate();
    if(!$valid)
    {
        new Redirect("../signup.php");
    }

    class Blog
    {
        private $Conn;
        function __construct()
        {
            $conn = new DataBase();
            $this->Conn = $conn->config();
            if(is_string($this->Conn))
            {
                echo $this->Conn;
                die;
            }
        }

        function List()
        {
            $data = $this->Conn->query("SELECT * FROM blogs");
            $data = $data->fetchAll(PDO::FETCH_ASSOC);

            return $data;
            
        }

        function viewBlog($id)
        {
            $uid = $_SESSION['uid'];

            $data = $this->Conn->query("SELECT *,count(_like) as likes FROM blogs  INNER JOIN likes on (blogs.id=likes.blogid) WHERE id='$id' AND _like=1");
            $data = $data->fetch(PDO::FETCH_ASSOC);
            
            if($data == 0)
            {
                new Redirect("blogsList.php");
            }
            if($data['activate']==0)
            {
                
                new Redirect("blogsList.php?deactive=true");
                
            }
            $dislikes = $this->Conn->query("SELECT count(_like) AS dislikes FROM likes WHERE _like=0 AND blogid='$id'");
            $dislikes = $dislikes->fetch(PDO::FETCH_ASSOC);
            
            $data['dislikes']=$dislikes['dislikes'];
           
            return $data;
        }

        function likeDislike($id,$like=1)
        {
            $uid = $_SESSION['uid'];

            $data = $this->Conn->query("SELECT blogid FROM likes WHERE userid='$uid' AND blogid='$id'");
            $data = $data->fetch(PDO::FETCH_ASSOC);
            if($data==false)
            {
                $this->Conn->exec("INSERT INTO likes (_like,userid,blogid) VALUES ($like,'$uid','$id')");
            }
            else
            {
                $this->Conn->exec("UPDATE likes SET _like=$like WHERE userid='$uid' AND blogid='$id'");
            }
        }
    }
?>