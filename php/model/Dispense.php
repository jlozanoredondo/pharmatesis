<?php

/** 
 * Class to manage the Profession objects
 * @name Dispense.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param projectId: ID of the dispense project to dispende
        * subjectId: Dispense's subject id
        * phaseId: Dispense's phase id
        * sessionId: Dispense's session id
        * viability: Dispense's visbility way
        * sideEffects: Dispense's side effects
        * dose: Dispense's dose
        * reaction: Dispense's subject reaction
*/
class Dispense {
    
    //Attributes
    private $id;
    private $projectId;
    private $subjectId;
    private $phaseId;
    private $sessionId;
    private $viability;
    private $sideEffects;
    private $dose;
    private $reaction;
    
    //Constructor
    function __construct($id=null,$projectId=null, $subjectId=null, $phaseId=null, $sessionId=null, $viability=null, $sideEffects=null, $dose=null, $reaction=null) {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->subjectId = $subjectId;
        $this->phaseId = $phaseId;
        $this->sessionId = $sessionId;
        $this->viability = $viability;
        $this->sideEffects = $sideEffects;
        $this->dose = $dose;
        $this->reaction = $reaction;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }
        
    function getProjectId() {
        return $this->projectId;
    }

    function getSubjectId() {
        return $this->subjectId;
    }

    function getPhaseId() {
        return $this->phaseId;
    }

    function getSessionId() {
        return $this->sessionId;
    }

    function getViability() {
        return $this->viability;
    }

    function getSideEffects() {
        return $this->sideEffects;
    }

    function getDose() {
        return $this->dose;
    }

    function getReaction() {
        return $this->reaction;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setProjectId($projectId) {
        $this->projectId = $projectId;
    }

    function setSubjectId($subjectId) {
        $this->subjectId = $subjectId;
    }

    function setPhaseId($phaseId) {
        $this->phaseId = $phaseId;
    }

    function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    function setViability($viability) {
        $this->viability = $viability;
    }

    function setSideEffects($sideEffects) {
        $this->sideEffects = $sideEffects;
    }

    function setDose($dose) {
        $this->dose = $dose;
    }

    function setReaction($reaction) {
        $this->reaction = $reaction;
    }
    
    //Own methods
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["projectId"] = $this->projectId;
        $data["subjectId"] = $this->subjectId;
        $data["phaseId"] = $this->phaseId;
        $data["sessionId"] = $this->sessionId;        
        $data["viability"] = $this->viability;      
        $data["sideEffects"] = $this->sideEffects;
        $data["dose"] = $this->dose;
        $data["reaction"] = $this->reaction;

        return $data;
    }

    public function setAll($id, $projectId, $subjectId, $phaseId, $sessionId, $viability, $sideEffects, $dose, $reaction) {
        $this->setId($id);
        $this->setProjectId($projectId);
        $this->setSubjectId($subjectId);
        $this->setPhaseId($phaseId);
        $this->setSessionId($sessionId);
        $this->setViability($viability);
        $this->setSideEffects($sideEffects);
        $this->setDose($dose);
        $this->setReaction($reaction);
    }
}
