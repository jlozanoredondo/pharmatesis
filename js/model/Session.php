<?php

/** 
 * Class to manage the Session objects
 * @name Session.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Session's ID
        * name: Session's name
        * date: Session's date
*/
class Session {
    
    //Atributte declaration
    private $id;
    private $name;
    private $date;
    
    //Constructor
    function __construct($id, $name, $date) {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDate($date) {
        $this->date = $date;
    }
    
    //Own methods
    public function __toString() {
        return sprintf("ID=%s, Name=%s, Date=%s",
                $this->id,$this->name, $this->date);
    }
}
