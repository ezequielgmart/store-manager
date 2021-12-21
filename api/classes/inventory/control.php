<?php
/** Due to we are using the db.php and respones.php 
 * files in usersControl we dont
 * need to requiere these files in this file as well.
 */
require ("sql.querys.php");


class InventoryControl extends Db{
    
    # post method handlerz
    public function buy($json){
        $_query = new ProductsQuerys();
        
        $query = $_query->newBuy($json);
        return $result = parent::nonQuery($query);
    }

    public function sell($json){
        $_query = new ProductsQuerys();
        
        $query = $_query->newSell($json);
        return $result = parent::nonQuery($query);
    }
    
    public function get($criteria="",$json=""){
        if ($criteria == "" || $json == "") {
            $_query = $this->newQuery();
            $query = $_query->select();
            return $result = parent::getData($query);

        } else{
            if ($criteria == "date") {
                $_query = $this->newQuery();
                // the 1 means: is able to use WHERE LIKE
                $query = $_query->select($criteria,$json,1);
                return $result = parent::getData($query);

            } else {
                    
                $_query = $this->newQuery();
                $query = $_query->select($criteria,$json);
                return $result = parent::getData($query);

            }
            
        }
        
    }

    public function delete($json){
        
        $_query = $this->newQuery();
        $query = $_query->delete($json);
        $result = parent::nonQuery($query);

        return $result;
    }

    public function edit($id,$json,$edit){
        $_query = $this->newQuery();


        if($edit == 1){

            $query = $_query->editName($id,$json);
            $result = parent::nonQuery($query);
    
            return $result;

         }else if($edit == 2){
            $query = $_query->editBrand($id,$json);
            $result = parent::nonQuery($query);
    
            return $result;
            

         }else if($edit == 3){
            $query = $_query->editPrice($id,$json);
            $result = parent::nonQuery($query);
    
            return $result;
            

         }else if($edit == 4){
            $query = $_query->editDescription($id,$json);

            $result = parent::nonQuery($query);
    
            return $result;
            


         }else if($edit == 5){
            $query = $_query->editCategory($id,$json);
            $result = parent::nonQuery($query);
    
            return $result;

           

         }else if($edit > 5 || $edit < 1){

             echo "Wrong data. Try again";

         }else{

             http_response_code(402);
             echo json_encode("Data not found. Try again");

        }



    }
    private function newQuery(){
        return $_query = new ProductsQuerys();

    }
}

?>