<?php
    include "../database/connection.php";
    include "../validation/validation.php";
    
    $error = array();
    class Admin 
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

        function validate()
        {
            $obj = new Check();
            $valid = $obj->AdminPageValidate();
            if($valid==false)
            {
                new Redirect("admin_login.php");
            }
        }

        function login()
        {
            $valid = new Check();
            global $error;
             
            $error = $valid->EmailPassCheck($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $email = $this->Data['email'];
                $password = $this->Data['pass'];

                $data = $this->Conn->query("SELECT email,password,roll FROM admin where email = '$email'")??false;
                $data = $data->fetch(PDO::FETCH_ASSOC);
                $_SESSION['adminRoll'] = $data['roll'];

                if($data == false)
                {
                    $error['notfound'] = "Sorry admin you make some mistake while login";
                }
                else
                {
                    if($data['email'] == $this->Data['email'] && $data['password']==$this->Data['pass'])
                    {
                        $_SESSION['loginAdmin']= true;
                        new Redirect("admin_index.php");
                    }
                }
            }
        }

        function createSubAdmin()
        {
            $valid = new Check();
            global $error;
             
            $error = $valid->EmailPassCheck($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
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
                        $this->Conn->exec("INSERT INTO admin (email,password) VALUES ('$email','$password')");
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
            if(empty($data))
            {
                echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No Sub Admin Exist</h1></tr></table>";
                die;
            }
            echo "<table cellspacing=0>";
            echo "<tr> <th>ID</th> <th>Email</th>";
            if($_SESSION['adminRoll']==1)
            {
                echo "<th>DELETE</th>";
            } 
            echo "</tr>";
            foreach($data as $value)
            {
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td>".$value['email']."</td>";
                if($_SESSION['adminRoll']==1)
                {
                    echo "<td><a href = 'deleteSub.php?id=".$value['id']."'>Delete</a></td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        }

        function deleteSub($id)
        {
            try{
                $success = $this->Conn->query("DELETE FROM admin WHERE id='$id'");
            }
            catch(Exception $e)
            {
                echo "something went wrong";
            }
        }
    }
?>