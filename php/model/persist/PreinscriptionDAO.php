<?php
    require_once 'model/Endure.php';
/** 
 * Class that will connect the object with the DB
 * @name PreinscriptionDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class PreinscriptionDAO {
        
    /** 
    * Inserts the object into the DB
    * @name insertEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $preinscription Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertPreinscription($preinscription) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $preinscription Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deletePreinscription($preinscription) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $preinscription Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyPreinscription($preinscription) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findEndure()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $preinscription Object to find
    * @return $foundPreinscription Founded object
    */
    public static function findPreinscription($preinscription) {
        $foundPreinscription = null;        
        return $foundPreinscription;
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
