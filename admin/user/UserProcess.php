<?php
    include "../../database/connection.php";
    include "../../validation/validation.php";

    class UsersByAdmin extends Check
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
            $error = $this->nameValidate($this->Data['fname'],'fname');
            $error = $this->nameValidate($this->Data['lname'],'lname');
            $error = $this->EmailPassCheck($this->Data['email'],$this->Data['pass']);

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

        function viewUsers($filter=null)
        {
            if($filter=="All" || $filter==null)
            {
                $data = $this->Conn->query("SELECT * FROM user");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif($filter=="Requesting")
            {
                $data = $this->Conn->query("SELECT * FROM user WHERE activate=0");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $data = $this->Conn->query("SELECT * FROM user WHERE activate=1");
                $data = $data->fetchAll(PDO::FETCH_ASSOC);
            }
            
            if(empty($data))
            {
                echo "<h1 style=\"margin-left:20%;margin-top:20%;\">No User Exist</h1></tr></table>";
                die;
            }
            echo "<table cellspacing=0 style=\"margin-left:10%;\">";
            echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Email</th> <th>Status</th> <th>Delete</th></tr>";
            foreach($data as $value)
            {
                echo "<tr>";
                echo "<td>".$value['id']."</td>";
                echo "<td>".$value['first_name']."</td>";
                echo "<td>".$value['last_name']."</td>";
                echo "<td>".$value['email']."</td>";
                if($value['activate']==0)
                {
                    echo "<td><a href = 'activate.php?id=".$value['id']."' class='active'>Deactivate</a></td>";
                }
                else
                {
                    echo "<td><a href = 'activate.php?id=".$value['id']."' class='deactive'>Activate</a></td>";
                }
                echo "<td><a href = 'delete.php?id=".$value['id']."'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }

        function status($id)
        {
            $data = $this->Conn->query("SELECT activate FROM user WHERE id='$id'");
            $data = $data->fetch(PDO::FETCH_ASSOC);

            if($data['activate']==0)
            {
                $this->Conn->exec("UPDATE user set activate=1 WHERE id='$id'");
            }
            else
            {
                $this->Conn->exec("UPDATE user set activate=0 WHERE id='$id'");
            }
        }

        function delete($id)
        {
            try{
                $success = $this->Conn->query("DELETE FROM user WHERE id='$id'");
            }
            catch(Exception $e)
            {
                echo "something went wrong";
            }
        }
    }
?>