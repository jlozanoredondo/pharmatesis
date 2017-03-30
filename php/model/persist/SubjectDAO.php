<?php
    require_once 'model/Subject.php';
/** 
 * Class that will connect the object with the DB
 * @name SubjectDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class SubjectDAO {
    
    private $data;
    
    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data,new Subject(1, "1445-10-11", "Male", "African-American", "JJ", "A0", 1, "Healthy"));
        array_push($this->data,new Subject(2, "1984-02-11", "Male", "Hispanic", "JJ", "A0", 2, "Healthy"));
        array_push($this->data,new Subject(3, "1963-10-11", "Male", "Caucasian", "SSD", "A0", 3, "Healthy"));
        array_push($this->data,new Subject(4, "2007-10-11", "Female", "Hispanic", "X23", "A0", 1, "Healthy"));
    }
    
    /** 
    * Inserts the object into the DB
    * @name insertSubject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $subject Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertSubject($subject) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteSubject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $subject Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteSubject($subject) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifySubject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $subject Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifySubject($subject) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findSubject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $subject Object to find
    * @return $foundSubject Founded object
    */
    public static function findSubject($subject) {
        $foundSubject = null;        
        return $foundSubject;
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
