<?php

/** 
 * Class to manage the Project objects
 * @name Project.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Project's ID
        * userId: Users's ID
        * name: Project's name
        * $initialDate: Project's initial date
        * $endDate: Project's end date 
        * $testedDrug: Project's tested drug 
        * $diseaseId: Diesease's ID
*/
class Project {
    
    //Attributes
    private $id;
    private $userId;
    private $name;
    private $initialDate;
    private $endDate;
    private $testedDrug;
    private $diseaseId;
    
    //Constructor
    function __construct($id=null, $userId=null, $name=null, $initialDate=null, $testedDrug=null, $diseaseId=null) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->initialDate = $initialDate;
        $this->testedDrug = $testedDrug;
        $this->diseaseId = $diseaseId;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getName() {
        return $this->name;
    }

    function getInitialDate() {
        return $this->initialDate;
    }

    function getEndDate() {
        return $this->endDate;
    }

    function getTestedDrug() {
        return $this->testedDrug;
    }

    function getDiseaseId() {
        return $this->diseaseId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setInitialDate($initialDate) {
        $this->initialDate = $initialDate;
    }

    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    function setTestedDrug($testedDrug) {
        $this->testedDrug = $testedDrug;
    }

    function setDiseaseId($diseaseId) {
        $this->diseaseId = $diseaseId;
    }
    
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["userId"] = $this->userId;
        $data["name"] = $this->name;
        $data["initialDate"] = $this->initialDate;
        $data["endDate"] = $this->endDate;        
        $data["testedDrug"] = $this->testedDrug;      
        $data["diseaseId"] = $this->diseaseId;

        return $data;
    }

    public function setAll($id, $userId, $name, $initialDate, $testedDrug, $diseaseId) {
        $this->setId($id);
        $this->setUserId($userId);
        $this->setName($name);
        $this->setInitialDate($initialDate);
        $this->setTestedDrug($testedDrug);
        $this->setDiseaseId($diseaseId);
    }
}
