<?php
    include "../../database/connection.php";
    include "../../validation/validation.php";

    $obj = new Check();
    $valid = $obj->AdminPageValidate();
    if($valid==false)
    {
        new Redirect("../admin_login.php");
    }

    class Blog
    {
        private $Data;
        private $Conn;
        function __construct($data=null)
        {
            $conn = new DataBase();
            $this->Conn = $conn->config();

            if(is_string($this->Conn))
            {
                echo $this->Conn;
                die;
            }
            $this->Data = $data;
        }

        function create()
        {
            global $error;
            $valid = new Check();

            $error = $valid->validateblog($this->Data['title'],'title');
            $error = $valid->validateblog($this->Data['description'],'description');

            if(empty($error))
            {
                $title = $this->Data['title'];
                $description = $this->Data['description'];
                $obj = new DateTime();
                $obj->setTimezone(new DateTimeZone('Asia/Calcutta'));
                $date = $obj->format("Y-m-d");
                try
                {
                    $this->Conn->exec("INSERT into blogs(title,description,date) VALUES('$title','$description','$date')");
                }
                catch(Exception $e)
                {
                    $error['size'] = "Your Blog characters are out of max length";
                }
            }
        }

        function show($filter=null)
        {
            if($filter=="All" || $filter==null)
            {
                $data = $this->Conn->query("SELECT * FROM blogs");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif($filter=="Requesting")
            {
                $data = $this->Conn->query("SELECT * FROM blogs WHERE activate=0");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $data = $this->Conn->query("SELECT * FROM blogs WHERE activate=1");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
           
            if(empty($data))
            {
                echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No Blogs Exist</h1></tr></table>";
                die;
            }
            echo "<table cellspacing=0 style=\"margin-left:10%;\">";
            echo "<tr> <th>ID</th> <th>Title</th> <th>Created On</th> <th>Edit</th> <th>Status</th> <th>Delete</th></tr>";
            foreach($data as $value)
            {
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td>".$value['title']."</td>";
                echo "<td>".$value['date']."</td>";
                echo "<td><a href = 'editBlog.php?id=".$value['id']."' class='edit'>Edit</a></td>";
                if($value['activate']==0)
                {
                    echo "<td><a href = 'activateBlog.php?id=".$value['id']."' class='active'>Deactivate</a></td>";
                }
                else
                {
                    echo "<td><a href = 'activateBlog.php?id=".$value['id']."' class='deactive'>Activate</a></td>";
                }
                echo "<td><a href = 'deleteBlog.php?id=".$value['id']."'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }

        function status($id)
        {
            $data = $this->Conn->query("SELECT activate FROM blogs WHERE id='$id'");
            $data = $data->fetch(PDO::FETCH_ASSOC);

            if($data['activate']==0)
            {
                $this->Conn->exec("UPDATE blogs set activate=1 WHERE id='$id'");
            }
            else
            {
                $this->Conn->exec("UPDATE blogs set activate=0 WHERE id='$id'");
            }
            new Redirect("viewBlog.php");
        }

        function delete($id)
        {
            try{
                $this->Conn->exec("DELETE FROM blogs WHERE id='$id'");
                $this->Conn->exec("DELETE FROM likes WHERE blogid='$id'");
            }
            catch(Exception $e)
            {
                echo "something went wrong";
            }
        }

        function update($id)
        {
            global $error;
            $valid = new Check();

            $error = $valid->validateblog($this->Data['title'],'title');
            $error = $valid->validateblog($this->Data['description'],'description');

            if(empty($error))
            {
                $title = $this->Data['title'];
                $description = $this->Data['description'];
                $obj = new DateTime();
                $obj->setTimezone(new DateTimeZone('Asia/Calcutta'));
                $date = $obj->format("d-n-Y");

                $this->Conn->exec("UPDATE blogs SET title='$title',description='$description',date='$date' WHERE id='$id'");
            }
        }
    }
?>