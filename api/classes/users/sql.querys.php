<?php

    class Querys{
        public $fields = array(
            
            "email",
            "name",
            "password",
            "userId"
        ); 

        function selectAll($table){
            $query = "SELECT * FROM "
            . $table ."";

            return $query;
        }
        
        function selectUserByEmail($table,$email){
            $query = "SELECT * FROM "
            . $table ."
            WHERE ".$this->fields[0]."='$email'";

            return $query;
        }

        function selectPassword($table,$password){
            $query = "SELECT password FROM "
            . $table ."
            WHERE ".$this->fields[2]."='$password'";

            return $query;

        }

        function login($table,$json){
            $query = "SELECT * FROM $table WHERE
            email='".$json."'";
            
            return $query;

        }
        function insert($table,$values){
            $query = "INSERT INTO " . $table ."("
            . $this->fields[0].","
            . $this->fields[1].","
            . $this->fields[2].","
            . $this->fields[3].") 
            VALUES (
            '".$values[0]."',
            '".$values[1]."',
            '".$values[2]."',
            '".$values[3]."')";
    
            return $query;
        }
    }

?>