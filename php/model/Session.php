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
    function __construct($id=null, $name=null, $date=null, $endDate=null) {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->endDate = $endDate;
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
    function getEndDate() {
        return $this->endDate;
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
    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }
    
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["name"] = $this->name;
        $data["date"] = $this->date;
        $data["endDate"] = $this->endDate;

        return $data;
    }
}
