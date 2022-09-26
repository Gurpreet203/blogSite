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

    class UserByAdmin extends Validate
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
            $error = $this->nameValidate($this->Data['fname'],'fname');
            $error = $this->nameValidate($this->Data['lname'],'lname');
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $first = $this->Data['fname'];
                $last = $this->Data['lname'];
                $email = $this->Data['email'];
                $pass = $this->Data['pass'];

                if(isset($this->Data['radio']) && $this->Data['radio']=='true')
                {
                    try{
                       
                        $this->Conn->exec("INSERT INTO User (first_name,last_name,email,password,activate) VALUES ('$first','$last','$email','$pass','1')");
                        
                    }
                    catch(Exception $e)
                    {
                        $error['email'] = "Email already exist";
                    }
                }
                else
                {
                    try{
                       
                        $this->Conn->exec("INSERT INTO user (first_name,last_name,email,password) VALUES ('$first','$last','$email','$pass')");
                        
                    }
                    catch(Exception $e)
                    {
                        $error['email'] = "Email already exist";
                    }
                }
            }
        }

    }
?>