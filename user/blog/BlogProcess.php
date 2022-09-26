<?php
    include '../../database/connection.php';
    include '../../commonControllers/validation.php';

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

        function validatePage()
        {
            $obj = new Validate();
            $valid = $obj->UserPageValidate();
            if($valid==false)
            {
                new Redirect("../signup.php");
            }
        }

        function List()
        {
            $data = $this->Conn->query("SELECT * FROM blogs");
            $data = $data->fetchAll(PDO::FETCH_ASSOC);
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
        }

        function viewBlog($id)
        {
            $uid = $_SESSION['uid'];

            $data = $this->Conn->query("SELECT * FROM blogs WHERE id='$id'");
            $data = $data->fetch(PDO::FETCH_ASSOC);

            if($data == 0)
            {
                new Redirect("blogsList.php");
            }

            $likeValid = $this->Conn->query("SELECT _like FROM likes WHERE blogid='$id' AND userid ='$uid'");
            $likeValid = $likeValid->fetch(PDO::FETCH_ASSOC);

            $likes = $this->Conn->query("SELECT count(_like) AS likes FROM likes WHERE _like=1 AND blogid='$id'");
            $likes = $likes->fetch(PDO::FETCH_ASSOC);

            $dislikes = $this->Conn->query("SELECT count(_like) AS dislikes FROM likes WHERE _like=0 AND blogid='$id'");
            $dislikes = $dislikes->fetch(PDO::FETCH_ASSOC);
 
            echo "<h1 class=\"title\">".$data['title']."</h1>";
            echo "<div class=\"description\">";
            echo "<p>".$data['description']."</p></div>";
            if($likeValid!=false)
            {
                if($likeValid['_like']==1)
                {
                    echo  "<span class='numbers'>".$likes['likes']." Likes</span><a href='bloglikes.php?id=$id&dislike=1'class='like'><i class=\"bi bi-hand-thumbs-down\"></i> DISLIKES</a>";
                }
                else
                {
                    echo  "<span class='numbers'>".$dislikes['dislikes']." Dislikes</span><a href='bloglikes.php?id=$id'class='like'><i class=\"bi bi-hand-thumbs-up\"></i> LIKES</a>";
                }
            }
            else
            {
                echo  "<span class='numbers'>".$dislikes['dislikes']." Dislikes</span><a href='bloglikes.php?id=$id'class='like'><i class=\"bi bi-hand-thumbs-up\"></i> LIKES</a>";
            }
            echo "<p class=\"date\">Created on ".$data['date']."</p>";
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