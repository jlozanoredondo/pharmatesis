<?php

/** 
 * Class to manage the Subject objects
 * @bordgender Subject.php
 * @author Joan Fernández
 * @gender 2017-02-23
 * @version 1.0
 * @param id: Subject's ID
        * bornDate: Subject's born date
        * gender: Subject's gender
        * breed: Subject's breed
        * nick: Subject's nick
        * bloodType: Subject's blood type
        * status: Subject's status
        * height: Subject's height
        * weight: Subject's weight
        * countryId: Subject's country id
        * userId: Subject's user id
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
    private $height;
    private $weight;
    private $countryId;
    private $userId;
    
    //Constructor
    function __construct($id=null, $bornDate=null, $gender=null, $breed=null, $nick=null, $bloodType=null, $status=null, $height=null, $weight=null, $countryId=null, $userId=null)  {
        $this->id = $id;
        $this->bornDate = $bornDate;
        $this->gender = $gender;
        $this->breed = $breed;
        $this->nick = $nick;
        $this->bloodType = $bloodType;
        $this->status = $status;
        $this->height = $height;
        $this->weight = $weight;
        $this->countryId = $countryId;
        $this->userId = $userId;
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

    function getHeight() {
        return $this->height;
    }

    function getWeight() {
        return $this->weight;
    }

    function getCountryId() {
        return $this->countryId;
    }

    function getUserId() {
        return $this->userId;
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

    function setHeight($height) {
        $this->height = $height;
    }

    function setWeight($weight) {
        $this->weight = $weight;
    }

    function setCountryId($countryId) {
        $this->countryId = $countryId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
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
        $data["height"] = $this->height;
        $data["weight"] = $this->weight;
        $data["countryId"] = $this->countryId;
        $data["userId"] = $this->userId;

        return $data;
    }

    public function setAll($id, $bornDate, $gender, $breed, $nick, $bloodType, $status, $height, $weight, $countryId, $userId) {
        $this->setId($id);
        $this->setBornDate($bornDate);
        $this->setGender($gender);
        $this->setBreed($breed);
        $this->setNick($nick);
        $this->setBloodType($bloodType);
        $this->setStatus($status);
        $this->setHeight($height);
        $this->setWeight($weight);
        $this->setCountryId($countryId);
        $this->setUserId($userId);
    }
}
