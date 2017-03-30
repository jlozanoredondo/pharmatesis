<?php
    require_once 'model/Dispense.php';
/** 
 * Class that will connect the object with the DB
 * @name DispenseDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class DispenseDAO {
    
    private $data;
    
    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data,new Dispense(1, 1, 1, 1, "Intravenous", "None", "xxx", "Stable"));
        array_push($this->data,new Dispense(2, 2, 2, 2, "Ocular", "Blindness", "xxy", "Stable"));
        array_push($this->data,new Dispense(3, 3, 3, 3, "Intravenous", "None", "yxx", "Stable"));
        array_push($this->data,new Dispense(4, 4, 4, 4, "Anal", "None", "xyx", "Passed away"));
    }
    
    /** 
    * Inserts the object into the DB
    * @name insertProfession()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $dispense Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertDispense($dispense) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteProfession()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $dispense Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteDispense($dispense) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyProfession()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $dispense Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyDispense($dispense) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findProfession()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $dispense Object to find
    * @return $foundDispense Founded object
    */
    public static function findDispense($dispense) {
        $foundDispense = null;
        
        return $foundDispense;
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
