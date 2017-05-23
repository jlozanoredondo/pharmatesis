<?php

/** 
 * Class to manage the Preinscription objects
 * @name Project.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Preinscription's id
        * subjectId: Preinscription's subject id
        * medicamentId: Preinscription's medicamentId id
*/
class Preinscription {
            
    //Attributes
    private $id;
    private $subjectId;
    private $medicamentId;
    
    //Constructor
    function __construct($id=null, $subjectId=null, $medicamentId=null) {
        $this->id = $id;
        $this->subjectId = $subjectId;
        $this->medicamentId = $medicamentId;
    }
    
    //Getters && Setters
    function getId() {
        return $this->id;
    }

    function getSubjectId() {
        return $this->subjectId;
    }

    function getMedicamentId() {
        return $this->medicamentId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSubjectId($subjectId) {
        $this->subjectId = $subjectId;
    }

    function setMedicamentId($medicamentId) {
        $this->medicamentId = $medicamentId;
    }

    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["subjectId"] = $this->subjectId;
        $data["medicamentId"] = $this->medicamentId;

        return $data;
    }

    public function setAll($id, $subjectId, $medicamentId) {
        $this->setId($id);
        $this->setSubjectId($subjectId);
        $this->setMedicamentId($medicamentId);
    }
}
