<?php

/** 
 * Class to manage the Subject objects
 * @name Country.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: Country's ID
        * name: Country's name
*/
class Country {
    
    //Attributes
    private $id;
    private $name;
    
    //Constructor
    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
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
