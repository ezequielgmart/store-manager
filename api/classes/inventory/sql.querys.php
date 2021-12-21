<?php

    class ProductsQuerys{
    
        public function __construct() {
            $this->table = "inventory";
            // $this->first = "brands";
            // $this->second = "productcategories";
            // $this->third = "inventory";
           
        }
        # exact = dont use like
        public function select($criteria ="",$json ="",$exact=""){
            if ($criteria =="" || $json == "") {
                return  $query = "SELECT transactionId,
                costumerId,
                date,
                userId,
                entryAmount,
                outAmount,
                entryValue,
                entryValue,
                transactionTypeId,
                productId
                FROM 
                inventory";
            } else {
                if ($exact == 1) {
                    return  $query = "SELECT transactionId,
                    costumerId,
                    date,
                    userId,
                    entryAmount,
                    outAmount,
                    entryValue,
                    entryValue,
                    transactionTypeId,
                    productId
                    FROM 
                    inventory
                    WHERE $criteria LIKE '%$json%'";
                } else {
                    return  $query = "SELECT transactionId,
                    costumerId,
                    date,
                    userId,
                    entryAmount,
                    outAmount,
                    entryValue,
                    entryValue,
                    transactionTypeId,
                    productId
                    FROM 
                    inventory
                    WHERE $criteria = '$json'";
                }
                
               
            }
            
           

        }
    
        public function newBuy($values){
           
            return $query = "INSERT INTO " . $this->table ."(
                date,
                userId,
                entryAmount,
                entryValue,
                productId,
                transactionTypeId
            ) 
            VALUES (
            '".$values[0]."',
            '".$values[1]."',
            '".$values[2]."',
            '".$values[3]."',
            '".$values[4]."',
            '".$values[5]."')";
    
        }
        public function newSell($values){
           
            return $query = "INSERT INTO " . $this->table ."(
                date,
                costumerId,
                outAmount,
                outValue,
                productId,
                transactionTypeId
            ) 
            VALUES (
            '".$values[0]."',
            '".$values[1]."',
            '".$values[2]."',
            '".$values[3]."',
            '".$values[4]."',
            '".$values[5]."')";
    
        }
        function delete($json){
            return $query = "DELETE FROM $this->table WHERE 
            transactionId='$json'";

        }

        
        function editName($id,$json){
            return $this->update($id,"productName",$json);


        }  
        function editBrand($id,$json){
            return $this->update($id,"brandId",$json);


        }  
        function editPrice($id,$json){
            return $this->update($id,"price",$json);


        }  
        function editDescription($id,$json){
            return $this->update($id,"description",$json);


        }  
        function editCategory($id,$json){
            return $this->update($id,"categoryId",$json);
            

        }

        private function update($id,$field,$json){
            return $query = "UPDATE ". $this->table ." SET $field='$json' WHERE
            productId='$id'"; 
        }

        
    }


?>