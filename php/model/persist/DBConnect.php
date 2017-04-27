<?php

/**
 * Class to manage the DB
 * @name DBConnect.php
 * @author Joan Fernández
 * @date 2017-03-02
 * @version 1.0
 * @param host: Hosts name
 * user: User's name
 * pass: User's password
 * db: Database to connect with
 */
class DBConnect {

    function __construct() {
        
    }

    public static function getConection() {

        $servername = 'localhost';
        $dbname = 'pharmatesis';
        $username = 'root';
        $password = 'root';

        $conn = null;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

            //Quan hi hagi una exepció, que llenci un exception 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {            
            echo "<div class='alert alert-danger'><strong>Error!</strong> Database not found. Contact system admin.</div>";
        }
        return $conn;
    }
}
