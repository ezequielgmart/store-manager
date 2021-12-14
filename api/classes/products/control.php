<?php
/** Due to we are using the db.php and respones.php files in usersControl we dont
 * need to requiere these files in this file as well.
 */
require ("sql.querys.php");


class ProductsControl extends Db{
    
    # post method handler
    public function add($json){
        $_query = new ProductsQuerys();
      
        $query = $_query->add($json);
        return $result = parent::nonQuery($query);
    }

    public function get($typeOfGet,$json=""){
        # $typeOfGet is the type of get request we gonna do
        /**
         * 1 - GetAll
         * 2 - GetById
         */

         if ($typeOfGet == 1) {
            $_query = $this->newQuery();
            $query = $_query->select();
            $result = parent::getData($query);

            return $result;
         } else {
             echo "Nothing so far";
             # code...
         }
         
    }

    private function newQuery(){
        return $_query = new ProductsQuerys();

    }
}

?>