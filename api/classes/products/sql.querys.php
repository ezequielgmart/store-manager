<?php

    class ProductsQuerys{
    
        public function __construct() {
            $this->table = "products";
            $this->first = "brands";
            $this->second = "productcategories";
            $this->third = "inventory";
            $this->fields = array(
                "productId",
                "productName",
                "brandId",
                "price",
                "description",
                "categoryId"
            );
        }
        public function select($id =""){
            if ($id =="") {
                

                return  $query = "SELECT products.productId,
                products.productName,
                products.price,
                products.brandId,
                brands.brandName,
                products.description,
                products.categoryId,
                productcategories.categorieName,
                SUM(inventory.entryAmount),
                SUM(inventory.outAmount),
                SUM(inventory.entryValue),
                SUM(inventory.outValue) 
                FROM 
                products,
                brands,
                productcategories,
                inventory 
                WHERE products.brandId = brands.brandId AND
                products.categoryId = productcategories.categoryId";

            } else {
                
                return  $query = "SELECT products.productId,
                products.productName,
                products.price,
                products.brandId,
                brands.brandName,
                products.description,
                products.categoryId,
                productcategories.categorieName,
                SUM(inventory.entryAmount),
                SUM(inventory.outAmount),
                SUM(inventory.entryValue),
                SUM(inventory.outValue) 
                FROM 
                products,
                brands,
                productcategories,
                inventory 
                WHERE products.brandId = brands.brandId AND
                products.categoryId = productcategories.categoryId  AND
                products.productId = inventory.productId
                AND products.productId ='$id'";
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
        
        function delete($json){
            return $query = "DELETE FROM $this->table WHERE 
            productId='$json'";

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