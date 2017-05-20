<?php

/** 
 * Class to manage the Disease objects
 * @name Disease.php
 * @author Jonathan Lozano
 * @date 2017-02-23
 * @version 1.0
 * @param id: Disease's ID
        * name: Disease's name
*/
class Disease {
    
    //Attributes
    private $id;
    private $name;
    
    //Constructor
    function __construct($id=null, $name=null) {
        $this->id = $id;
        $this->name = $name;
    }
    
    //Getters & Setters
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }
    
    public function getAll() {
        $data = array();
        $data["id"] = $this->id;
        $data["name"] = $this->name;

        return $data;
    }
}
