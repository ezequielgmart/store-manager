<?php

    class ProductsQuerys{
    
        public function __construct() {
            $this->table = "products";
            $this->first = "brands";
            $this->second = "productcategories";
            $this->fields = array(
                "productId",
                "productName",
                "brand",
                "price",
                "description",
                "categoryId"
            );
        }
        public function select($id =""){
            if ($id =="") {
                return $query = "SELECT * FROM "
                .$this->table.","
                .$this->first.","
                .$this->second." WHERE ". $this->table .".brandId =".$this->first.".brandId AND " 
                . $this->table .".categoryId ="
                . $this->second .".categoryId";

            } else {
                return $query = "SELECT * FROM "
                .$this->table.","
                .$this->first.","
                .$this->second." WHERE ". $this->table .".brandId =".$this->first.".brandId AND " 
                . $this->table .".categoryId ="
                . $this->second .".categoryId 
                AND " . $this->table . ".productId ='$id'";
            }
            
        }
        public function add($values){
           
            $query = "INSERT INTO " . $this->table ."("
            . $this->fields[0].","
            . $this->fields[1].","
            . $this->fields[2].","
            . $this->fields[3].","
            . $this->fields[4].","
            . $this->fields[5].") 
            VALUES (
            '".$values[0]."',
            '".$values[1]."',
            '".$values[2]."',
            '".$values[3]."',
            '".$values[4]."',
            '".$values[5]."')";
    
            return $query;
        }
    }

?>