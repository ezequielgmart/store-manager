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
}

?>