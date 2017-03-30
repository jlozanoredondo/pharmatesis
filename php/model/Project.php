<?php

/** 
 * Class to manage the Project objects
 * @name Project.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param projectId: Project's ID
        * userId: Users's ID
        * name: Project's name
        * $initialDate: Project's initial date
        * $endDate: Project's end date 
        * $testedDrug: Project's tested drug 
        * $diseaseId: Diesease's ID
*/
class Project {
    
    //Attributes
    private $projectId;
    private $userId;
    private $name;
    private $initialDate;
    private $endDate;
    private $testedDrug;
    private $diseaseId;
    
    //Constructor
    function __construct($projectId, $userId, $name, $initialDate, $endDate, $testedDrug, $diseaseId) {
        $this->projectId = $projectId;
        $this->userId = $userId;
        $this->name = $name;
        $this->initialDate = $initialDate;
        $this->endDate = $endDate;
        $this->testedDrug = $testedDrug;
        $this->diseaseId = $diseaseId;
    }
    
    //Getters & Setters
    function getProjectId() {
        return $this->projectId;
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

    function setProjectId($projectId) {
        $this->projectId = $projectId;
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
    
    //Own methods
    public function __toString() {
        return sprintf("ID=%s, User ID=%s, Name=%s, Initial date=%s, End date=%s, Tested drug=%s, Disease ID=%s",
                $this->projectId,$this->userId,$this->name, $this->initialDate, $this->endDate,$this->testedDrug,$this->diseaseId);
    }
}
