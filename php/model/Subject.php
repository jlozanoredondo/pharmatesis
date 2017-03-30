<?php

/** 
 * Class to manage the Subject objects
 * @name Subject.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Subject's ID
        * $bornDate: Subject's born Date
        * $gender: Subject's gender
        * $breed: Subject's breed
        * $nick: Subject's nick 
        * $bloodType: Subject's bloodType 
        * $country: Subject's country
        * $status: Subject's status
*/
class Subject {
    
    //Attributes
    private $id;
    private $bornDate;
    private $gender;
    private $breed;
    private $nick;
    private $bloodType;
    private $countryId;
    private $status;
    
    //Constructor
    function __construct($id, $bornDate, $gender, $breed, $nick, $bloodType, $countryId, $status) {
        $this->id = $id;
        $this->bornDate = $bornDate;
        $this->gender = $gender;
        $this->breed = $breed;
        $this->nick = $nick;
        $this->bloodType = $bloodType;
        $this->$countryId = $countryId;
        $this->status = $status;
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

    function getCountryId() {
        return $this->countryId;
    }

    function getStatus() {
        return $this->status;
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

    function setCountryId($country) {
        $this->countryId = $country;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
    //Own methods
    public function __toString() {
        return sprintf("ID=%s, Born date=%s, Gender=%s, Breed=%s, Nick=%s, Blood type=%s, Country id=%s, Status=%s",
                $this->id,$this->bornDate,$this->gender, $this->breed, $this->nick,$this->bloodType,$this->countryId, $this->status);
    }
}
