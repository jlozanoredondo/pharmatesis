<?php
    require_once 'model/Project.php';
/** 
 * Class that will connect the object with the DB
 * @name ProjectDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
*/
class ProjectDAO {
    
    private $data;
    
    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data,new Project(1, 1, "Project 1", "2011-04-11", null, "XD", 1));
        array_push($this->data,new Project(2, 1, "Project 2", "2012-07-22", null, "XDD", 2));
        array_push($this->data,new Project(3, 2, "Project 1", "2014-09-13", null, "YS", 1));
        array_push($this->data,new Project(4, 4, "Project 1", "2011-11-17", null, "YDD", 1));
    }
    
    /** 
    * Inserts the object into the DB
    * @name insertProject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $project Object to insert
    * @return $rowsAffected Number of rows affected
    */
    public static function insertProject($project) {
        return 0;
    }
    
    /** 
    * Erases the object from the DB
    * @name deleteProject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $project Object to delete
    * @return $rowsAffected Number of rows affected
    */
    public static function deleteProject($project) {
        return 0;
    }
    
    /** 
    * Modifies the object into the DB
    * @name modifyProject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $project Object to modify
    * @return $rowsAffected Number of rows affected
    */
    public static function modifyProject($project) {
        return 0;
    }
    
    /** 
    * Finds an object into the DB
    * @name findProject()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param $project Object to find
    * @return $foundProject Founded object
    */
    public static function findProject($project) {
        $foundProject = null;        
        return $foundProject;
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
    public static function findWhere($whereClause) {
        return array();
    }
    
    /** 
    * Find all objects
    * @name findAll()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param none
    * @return array Founded objects
    */
    public function findAll() : array {
        return $this->data;
    }
}
