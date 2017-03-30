<?php

require_once 'model/Country.php';

/**
 * Class that will connect the object with the DB
 * @name CountryDAO.php
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 */
class CountryDAO {

    private $data;

    //Constructor
    public function __construct() {
        $this->data = array();
        array_push($this->data, new Country(1, "EEUU"));
        array_push($this->data, new Country(2, "Spain"));
        array_push($this->data, new Country(3, "Mexico"));
        array_push($this->data, new Country(4, "Porrera"));
    }

    /**
     * Inserts the object into the DB
     * @name insertCountry()
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     * @param $country Object to insert
     * @return $rowsAffected Number of rows affected
     */
    public static function insertCountry($country) {
        return 0;
    }

    /**
     * Erases the object from the DB
     * @name deleteCountry()
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     * @param $country Object to delete
     * @return $rowsAffected Number of rows affected
     */
    public static function deleteCountry($country) {
        return 0;
    }

    /**
     * Modifies the object into the DB
     * @name modifyCountry()
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     * @param $country Object to modify
     * @return $rowsAffected Number of rows affected
     */
    public static function modifyCountry($country) {
        return 0;
    }

    /**
     * Finds an object into the DB
     * @name findCountry()
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     * @param $country Object to find
     * @return $foundCountry Founded object
     */
    public static function findCountry($country) {
        $foundCountry = null;
        return $foundCountry;
    }

    /**
     * Find an object using a clause
     * @name findWhere()
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     * @param $whereClause Clause to find
     * @return array Founded objects
     */
    public function findWhere($whereClause) {
        return array();
    }

}
