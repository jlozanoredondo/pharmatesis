<?php

/** 
 * Class to manage the Endure objects
 * @name Dispense.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param endureId: ID of the endure
        * subjectId: Endures's subject id
        * diseaseId: Endures's disease id
*/
class Endure {
    
    //Attributes
    private $endureId;
    private $subjectId;
    private $diseaseId;
    
    //Constructor
    function __construct($projectId, $subjectId, $diseaseId) {
        $this->projectId = $projectId;
        $this->subjectId = $subjectId;
        $this->diseaseId = $diseaseId;
    }
    
    //Getters & Setters
    function getEndureId() {
        return $this->endureId;
    }

    function getSubjectId() {
        return $this->subjectId;
    }

    function getDiseaseId() {
        return $this->diseaseId;
    }

    function setEndureId($endureId) {
        $this->endureId = $endureId;
    }

    function setSubjectId($subjectId) {
        $this->subjectId = $subjectId;
    }

    function setDiseaseId($diseaseId) {
        $this->diseaseId = $diseaseId;
    }
   
    //Own methods
    public function __toString() {
        return sprintf("ID=%s, SubjectID=%s, DiseaseID=%s",
                $this->endureId,$this->subjectId,$this->diseaseId);
    }
}
