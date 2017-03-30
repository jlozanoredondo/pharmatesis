<?php
    require_once 'model/Medicament.php';
/** 
 * Class that will connect the object with the DB
 * @name MedicamentDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class MedicamentDAO {
    
    private $data;
    
    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data,new Medicament(1, "XXD"));
        array_push($this->data,new Medicament(2, "SSD"));
        array_push($this->data,new Medicament(3, "YYD"));
        array_push($this->data,new Medicament(4, "443"));
    }
    
    /** 
    * Inserts the object into the DB
    * @name insertMedicament()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $medicament Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertMedicament($medicament) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteMedicament()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $medicament Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteMedicament($medicament) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyMedicament()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $medicament Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyMedicament($medicament) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findMedicament()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $medicament Object to find
    * @return $foundMedicament Founded object
    */
    public static function findMedicament($medicament) {
        $foundMedicament = null;        
        return $foundMedicament;
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
