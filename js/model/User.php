<?php

/** 
 * Class to manage the User objects
 * @name User.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: ID of the user
        * name: User's name
        * password: User's password
        * surnames: User's surnames
        * email: User's email
        * phone: User's phone number
        * $bornDate: User's born date
        * $specialism: User's specialism
        * $professionId: User's profession ID (relation with Profession)
*/
class User {
    
    //Atributte declaration
    private $id;
    private $name;
    private $password;
    private $surnames;
    private $email;
    private $phone;
    private $bornDate;
    private $specialism;
    private $professionId;
    
    //Constructor
    function __construct($id, $name, $password, $surnames, $email, $phone, $bornDate, $specialism, $professionId) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->surnames = $surnames;
        $this->email = $email;
        $this->phone = $phone;
        $this->bornDate = $bornDate;
        $this->specialism = $specialism;
        $this->professionId = $professionId;
    }
        
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function getSurnames() {
        return $this->surnames;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getBornDate() {
        return $this->bornDate;
    }

    function getSpecialism() {
        return $this->specialism;
    }

    function getProfessionId() {
        return $this->professionId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
    function setSurnames($surnames) {
        $this->surnames = $surnames;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setBornDate($bornDate) {
        $this->bornDate = $bornDate;
    }

    function setSpecialism($specialism) {
        $this->specialism = $specialism;
    }

    function setProfessionId($professionId) {
        $this->professionId = $professionId;
    }
    
    //Own methods
    public function __toString() {
        return sprintf("ID=%s, Name=%s, Surname=%s, Email=%s, Phone=%s, BornDate=%s, Specialism=%s, ProfessionalID=%s",
                $this->id,$this->name,$this->surnames, $this->email, $this->phone,$this->bornDate,$this->specialism, $this->professionId);
    }
}