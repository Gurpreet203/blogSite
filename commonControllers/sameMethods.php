<?php

    trait Methods
    {

        function view($tableName , $filter=null)
        {
            if($filter=="All" || $filter==null)
            {
                $data = $this->Conn->query("SELECT * FROM $tableName");
            }
            elseif($filter=="Requesting")
            {
                $data = $this->Conn->query("SELECT * FROM $tableName WHERE activate=0");
            }
            else
            {
                $data = $this->Conn->query("SELECT * FROM $tableName WHERE activate=1");
            }
            
            $data = $data->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        function delete($tableName , $id)
        {
            try{
                $success = $this->Conn->query("DELETE FROM $tableName WHERE id='$id'");
            }
            catch(Exception $e)
            {
                echo "something went wrong";
            }
        }

        function status($tableName , $id)
        {
            $data = $this->Conn->query("SELECT activate FROM $tableName WHERE id='$id'");
            $data = $data->fetch(PDO::FETCH_ASSOC);

            if($data['activate']==0)
            {
                $this->Conn->exec("UPDATE $tableName set activate=1 WHERE id='$id'");
            }
            else
            {
                $this->Conn->exec("UPDATE $tableName set activate=0 WHERE id='$id'");
            }
        }
    }
    
?>