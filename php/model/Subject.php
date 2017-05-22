<?php

/** 
 * Class to manage the Session objects
 * @bordgender Session.php
 * @author Joan Fernández
 * @gender 2017-02-23
 * @version 1.0
 * @param id: Session's ID
        * bordgender: Session's bordgender
        * gender: Session's gender
*/
class Subject {
    
    //Atributte declaration
    private $id;
    private $bornDate;
    private $gender;
    private $breed;
    private $nick;
    private $bloodType;
    private $status;
    private $countryId;
    
    //Constructor
    function __construct($id=null, $bornDate=null, $gender=null, $breed=null, $nick=null, $bloodType=null, $status=null, $countryId=null)  {
        $this->id = $id;
        $this->bornDate = $bornDate;
        $this->gender = $gender;
        $this->breed = $breed;
        $this->nick = $nick;
        $this->bloodType = $bloodType;
        $this->status = $status;
        $this->countryId = $countryId;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getBornDate() {
        return $this->bornDate;
    }

    function getGender() {
        return $this->gender;
    }

    function getBreed() {
        return $this->breed;
    }

    function getNick() {
        return $this->nick;
    }

    function getBloodType() {
        return $this->bloodType;
    }

    function getStatus() {
        return $this->status;
    }

    function getCountryId() {
        return $this->countryId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBornDate($bornDate) {
        $this->bornDate = $bornDate;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }
    
    function setBreed($breed) {
        $this->breed = $breed;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setBloodType($bloodType) {
        $this->bloodType = $bloodType;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCountryId($countryId) {
        $this->countryId = $countryId;
    }
    
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["bornDate"] = $this->bornDate;
        $data["gender"] = $this->gender;
        $data["breed"] = $this->breed;
        $data["nick"] = $this->nick;        
        $data["bloodType"] = $this->bloodType;      
        $data["status"] = $this->status;
        $data["countryId"] = $this->countryId;

        return $data;
    }

    public function setAll($id, $bornDate, $gender, $breed, $nick, $bloodType, $status, $countryId) {
        $this->setId($id);
        $this->setBornDate($bornDate);
        $this->setGender($gender);
        $this->setBreed($breed);
        $this->setNick($nick);
        $this->setBloodType($bloodType);
        $this->setStatus($status);
        $this->setCountryId($countryId);
    }
}
