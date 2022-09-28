<?php
    include "../database/connection.php";
    include "../commonControllers/validation.php";
    include "../commonControllers/sameMethods.php";
    
    $error = array();
    class Admin extends Validate
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

        function validatePage()
        {
            $obj = new Validate();
            $valid = $obj->AdminPageValidate();
            if(!$valid)
            {
                new Redirect("admin_login.php");
            }
        }

        function login()
        {
          
            global $error;
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $email = $this->Data['email'];
                $password = $this->Data['pass'];

                $data = $this->Conn->query("SELECT email,password,roll FROM admin where email = '$email' AND password='$password'");
                $data = $data->fetch(PDO::FETCH_ASSOC);

                if($data)
                {  
                    $_SESSION['adminRoll'] = $data['roll'];
                    $_SESSION['loginAdmin']= true;
                    new Redirect("admin_index.php");
                }
                else
                {
                    $error['notfound'] = "Sorry admin you make some mistake while login";
                }
            }
        }

        function createSubAdmin()
        {
            
            global $error;
            $error = $this->nameValidate($this->Data['fname'],'fname');
            $error = $this->nameValidate($this->Data['lname'],'lname');
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $fname = $this->Data['fname'];
                $lname = $this->Data['lname'];
                $email = $this->Data['email'];
                $password = $this->Data['pass'];

                $user = $this->Conn->query("SELECT email FROM user where email = '$email'")??false;
                $user = $user->fetch(PDO::FETCH_ASSOC);
                if($email==!empty($user['email']))
                {
                    $error['reserve'] = "This email address is reserved by User";
                }
                else
                {
                    try
                    {
                        $this->Conn->exec("INSERT INTO admin (firstName,lastName,email,password) VALUES ('$fname','$lname','$email','$password')");
                    }
                    catch(Exception $e)
                    {
                        $error['email'] = "Email already exist";
                    }
                }
            }
        }

        function viewAdmin()
        {
            $data = $this->Conn->query("SELECT * FROM admin WHERE roll!=1");
            $data = $data->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
    }
?>