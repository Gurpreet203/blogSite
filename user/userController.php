<?php
    include '../commonControllers/validation.php';
    include '../database/connection.php';

    $error = array();
    $status = array();

    $obj = new Validate();
    $valid = $obj->UserPageValidate();

    if($valid)
    {
        new Redirect("blog/blogsList.php");
    }

    class User extends Validate
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

        function signup()
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
                try{
                    $data = $this->Conn->query("SELECT email FROM admin WHERE email='$email'");
                    $data = $data->fetch();

                    if(!$data)
                    {
                        $this->Conn->exec("INSERT INTO User (first_name,last_name,email,password) VALUES ('$first','$last','$email','$pass')");
                        new Redirect('login.php');
                    }
                    else
                    {
                        $error['email'] = "You can't use this email address";
                    }
                }
                catch(Exception $e)
                {
                    $error['email'] = "Email already exist";
                }

            }
        }

        function login()
        {
            global $error;
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $email = $this->Data['email'];
                $pass = $this->Data['pass'];
                $data = $this->Conn->query("SELECT id,email,password,activate FROM user WHERE email = '$email' AND password='$pass'");
                $data = $data->fetch(PDO::FETCH_ASSOC);

               if(!$data)
                {
                    $error['login'] = "please enter correct email or password";
                }
               else
                {
                    if($data['activate']==0)
                    {
                        $error['noactivation'] = "You are not activate user Please Contact Admin at 9915607741";
                    }
                    else
                    {
                        $_SESSION['uid'] = $data['id'];
                        $_SESSION['login'] = true;
                        new Redirect('blog/blogsList.php');
                    }
                }
                
            }
        }

        function forgetPassword()
        {
            global $status,$error;
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $email = $this->Data['email'];
                $pass = $this->Data['pass'];
                
                $data = $this->Conn->exec("UPDATE user SET password = '$pass' WHERE email = '$email'") ?? false;

               if(!$data)
                {
                    $status['login'] = "please enter correct email";
                } 
                else
                {
                    $status['login'] = "Successfully Changed";
                }
            }
        }
    }
?>