<?php
    require_once 'model/Endure.php';
/** 
 * Class that will connect the object with the DB
 * @name EndureDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class EndureDAO {
    
    private $data;
    
    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data,new Session(1, 1, 1));
        array_push($this->data,new Session(2, 2, 2));
        array_push($this->data,new Session(3, 3, 3));
        array_push($this->data,new Session(4, 4, 4));        
    }
    
    /** 
    * Inserts the object into the DB
    * @name insertEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $endure Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertEndure($endure) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $endure Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteEndure($endure) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $endure Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyEndure($endure) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $endure Object to find
    * @return $foundEndure Founded object
    */
    public static function findEndure($endure) {
        $foundEndure = null;        
        return $foundEndure;
    }
    
    /** 
    * Find an object using a clause
    * @name findWhere()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $whereClause Clause to find
    * @return array Founded objects
    */
    public function findWhere($whereClause) {
        return array();
    }
}
