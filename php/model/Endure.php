<?php

/** 
 * Class to manage the Endure objects
 * @name Endure.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: ID of the endure
        * subjectId: Endures's subject id
        * diseaseId: Endures's disease id
*/
class Endure {
    
    //Attributes
    private $id;
    private $subjectId;
    private $diseaseId;
    
    //Constructor
    function __construct($id=null, $subjectId=null, $diseaseId=null) {
        $this->id = $id;
        $this->subjectId = $subjectId;
        $this->diseaseId = $diseaseId;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getSubjectId() {
        return $this->subjectId;
    }

    function getDiseaseId() {
        return $this->diseaseId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSubjectId($subjectId) {
        $this->subjectId = $subjectId;
    }

    function setDiseaseId($diseaseId) {
        $this->diseaseId = $diseaseId;
    }
   
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["subjectId"] = $this->subjectId;
        $data["diseaseId"] = $this->diseaseId;

        return $data;
    }

    public function setAll($id, $subjectId, $diseaseId) {
        $this->setId($id);
        $this->setSubjectId($subjectId);
        $this->setDiseaseId($diseaseId);
    }
}
