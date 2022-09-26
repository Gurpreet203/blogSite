<?php
    include "../../database/connection.php";
    include "../../commonControllers/validation.php";
    include "../../commonControllers/sameMethods.php";

    $obj = new Validate();
    $valid = $obj->AdminPageValidate();
    if($valid==false)
    {
        new Redirect("../admin_login.php");
    }

    class Blog
    {
        use Methods;

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
            $valid = new Validate();

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

        function update($id)
        {
            global $error;
            $valid = new Validate();

            $error = $valid->validateblog($this->Data['title'],'title');
            $error = $valid->validateblog($this->Data['description'],'description');

            if(empty($error))
            {
                $title = $this->Data['title'];
                $description = $this->Data['description'];
                $obj = new DateTime();
                $obj->setTimezone(new DateTimeZone('Asia/Calcutta'));
                $date = $obj->format("Y-n-d");

                $this->Conn->exec("UPDATE blogs SET title='$title',description='$description',date='$date' WHERE id='$id'");
            }
        }
    }
?>