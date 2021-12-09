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