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

        private $server;
        private $user;
        private $password;
        private $dataBase;
        private $link;
        private $stmt;
        private $array = array();
        static $_instance;

        private function __construct() {
            $this->setConnection();
            $this->connection();
        }

        private function setConnection() {

            $this->server = 'localhost';
            $this->dataBase = 'dawbio1703';
            $this->user = 'dawbio1703';
            $this->password = 'z54Qf2$v';
        }

        private function __clone() {

        }

        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        private function connection() {
            try {
                $this->link = new PDO('mysql:dbname=' . $this->dataBase . ';host=' . $this->server, $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (PDOException $e) {
                $this->link = null;
                echo "Error connecting to database.";
                error_log("Error connecting to database: " . $e);
            }
        }

        public function execution($sql, $vector) {
            if ($this->link != null) {
                $this->stmt = $this->link->prepare($sql);

                try {
                    $this->stmt->execute($vector);
                } catch (PDOException $e) {
                    $this->link = null;
                    echo "Error executing query.";
                    error_log("Error executing query: " . $e);
                }
            } else {
                $this->stmt = null;
            }

            return $this->stmt;
        }

        public function executionInsert($sql, $vector) {
            $id = null;
            if ($this->link != null) {
                $this->stmt = $this->link->prepare($sql);
                try {
                    $this->stmt->execute($vector);
                    $id = $this->link->lastInsertId();
                } catch (PDOException $e) {
                    $this->link = null;
                    echo "Error executing insert.";
                    error_log("Error executing insert: " . $e);
                }
            } else {
                $id = null;
            }
            return $id;
        }
    }
?>