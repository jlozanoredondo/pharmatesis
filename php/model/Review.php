<?php

/** 
 * Class to manage the Review objects
 * @name Review.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param name: Review's name
        * email: Review's email
        * comments: Review's comments
*/
class Review {
    
    //Atributte declaration
    private $name;
    private $email;
    private $comments;

    //Constructor
    function __construct($name=null, $email=null, $comments=null) {
        $this->name = $name;
        $this->email = $email;
        $this->comments = $comments;
    }
    
    //Getters & Setters
    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getComment() {
        return $this->comments;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    function setComment($comments) {
        $this->comments = $comments;
    }

    public function getAll() {
        $data = array();
        $data["name"] = $this->name;
        $data["email"] = $this->email;
        $data["comments"] = $this->comments;

        return $data;
    }
}
