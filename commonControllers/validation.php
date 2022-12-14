<?php
    session_start();
    class Validate
    {
        
        public $error=array();
        
        // this function is use to restrict user trying to access other pages without log out
        
            function AdminPageValidate()
            {
                if(isset($_SESSION['loginAdmin']))
                {
                    if($_SESSION['loginAdmin']==true)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }

            function UserPageValidate()
            {
                if(isset($_SESSION['login']))
                {
                    if($_SESSION['login']==true)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
        
        // this function is for make log in page heading dynamic like if user not found show user not found otherwise user inserted etc.
            function userStatus( $tempSession )
            {
                $temp =null;
                if(!empty($tempSession['error']['found']) && !isset($tempSession['activity']))
                {
                    $temp = $tempSession['error']['found'];
                }
        
                elseif(!empty($tempSession['User']) && !isset($tempSession['activity']))
                {
                    $temp =  "User Inserted Successfully";
                }
        
                elseif(isset($_GET['already']) )
                {
                    $temp = "Previous User";
                }
                elseif(isset($tempSession['activity']) )
                {
                    $temp = $tempSession['activity'];
                    unset($tempSession['activity']);
                }
                return $temp;
            }
        
        
        // this function is for Validate if the user fill email and password or not
        
            function EmailPassValidate($email , $password)
            {
                
                if( empty($email) )
                {
                    $this->error['email'] = "please enter Email";
                }
                else
                {
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        $this->error['email'] = "please enter valid Email";
                    }
                }
        
                if( empty($password) )
                {
                    $this->error['pass'] = "please enter password";
                }
                else
                {
                    $password = trim($password);
                    if(empty($password))
                    {
                        $this->error['pass'] = "please don't enter spaces only password";
                    }
                    elseif(strlen($password)<8)
                    {
                        $this->error['pass'] = "please enter 8 digit password";
                    }
                }
                return $this->error;
            }
        
        // name validation function
        
            protected function nameValidate($name , $key)
            {
                
                if( !empty($name)  )
                {
                    $nam = ltrim($name);
                    if( is_numeric($nam) || preg_match('/[^a-z_+-0-9]/i', $nam) )
                    {
                        $this->error[$key] = "please enter correct $key ";
                    }
                    else
                    {
                        for( $i=0 ; $i<strlen($nam) ; $i++)
                        {
                            if($nam[$i]==" ")
                            {
                                $this->error[$key] = "please enter only $key ";
                            }
                        }
                    }
                    
                }
                else
                {
                $this->error[$key] = "please enter $key ";
                }
        
                return $this->error;
            }

            function validateBlog( $data , $key)
            {
               static $error = [];
                if( empty($data) )
                {
                    $error[$key] = "Please enter $key";
                } 
                else{
                    $da = trim($data);
                    if( empty($da) )
                    {
                        $error[$key] = "Please dont enter only spaces in $key";
                    }
                }
                return $error;
            }
    }

    class Redirect
    {
        
        function __construct($path)
        {
            header("location:".$path);
        }
    }
?>