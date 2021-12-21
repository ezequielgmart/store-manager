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

  


    private function newQuery(){
        return $_query = new ProductsQuerys();

    }
}

?>