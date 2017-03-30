<?php

/** 
 * Class to manage the Preinscription objects
 * @name Project.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Preinscription's id
        * subjectId: Preinscription's subject id
        * medicamenId: Preinscription's medicamenId id
*/
class Preinscription {
            
    //Attributes
    private $id;
    private $subjectId;
    private $medicamenId;
    
    //Constructor
    function __construct($id, $subjectId, $medicamenId) {
        $this->id = $id;
        $this->subjectId = $subjectId;
        $this->medicamenId = $medicamenId;
    }
    
    //Getters && Setters
    function getId() {
        return $this->id;
    }

    function getSubjectId() {
        return $this->subjectId;
    }

    function getMedicamenId() {
        return $this->medicamenId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSubjectId($subjectId) {
        $this->subjectId = $subjectId;
    }

    function setMedicamenId($medicamenId) {
        $this->medicamenId = $medicamenId;
    }

    //Own methods
    public function __toString() {
        return sprintf("ID=%s, SubjectID=%s, Medicament=%s",
                $this->endureId,$this->subjectId,$this->medicamenId);
    }
}
