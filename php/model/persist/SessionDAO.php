<?php

    require_once "DBConnect.php";
    require_once "../model/Session.php";

    /**
     * Class that will connect the object with the DB
     * @name SessionDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class SessionDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "session";
        private static $colNameId = "id";
        private static $colNameName = "name";
        private static $colNameSessionDate = "sessionDate";
        private static $colNameSessionEndDate = "sessionEndDate";

        /**
            * @name fromResultSetList
            * @description Transforms the resultset to a list
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $res DB result
            * @return Object list
        */
        public static function fromResultSetList($res) {
            $entityList = array();
            $i = 0;
            //while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
            foreach ($res as $row) {
                //We get all the values an add into the array
                $entity = SessionDAO::fromResultSet($row);

                $entityList[$i] = $entity;
                $i++;
            }
            return $entityList;
        }

        /**
            * @name fromResultSet
            * @description Transforms the resultset to a object
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $res DB result
            * @return Object converted
        */
        public static function fromResultSet($res) {
            //We get all the values form the query
            $id = $res[SessionDAO::$colNameId];
            $name = $res[SessionDAO::$colNameName];
            $date = $res[SessionDAO::$colNameSessionDate];
            $endDate = $res[SessionDAO::$colNameSessionEndDate];

            //Object construction
            $entity = new session();
            $entity->setId($id);
            $entity->setName($name);
            $entity->setDate($date);
            $entity->setEndDate($endDate);

            return $entity;
        }

        /**
            * @name findByQuery
            * @description Finds a query into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $cons Query to find                     
            * @params $vector Data to find
            * @return Call to fromResultSetList function
        */
        public static function findByQuery($cons, $vector) {
            //Connection with the database
            try {
                $conn = DBConnect::getInstance();
            } catch (PDOException $e) {
                echo "Error executing query.";
                error_log("Error executing query in SessionDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return SessionDAO::fromResultSetList($res);
        }

        /**
            * @name findAll
            * @description Finds all objects into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return Call to findByQuery function
        */
        public static function findAll() {
            $cons = "select * from `" . SessionDAO::$tableName . "`";
            $arrayValues = [];

            return SessionDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $session Object to find
            * @return Inserted id
        */
        public function create($session) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . SessionDAO::$tableName . " (`name`, `sessionDate`) values (?, ?)";
              $arrayValues = [$session->getName(), $session->getDate()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $session->setId($id);

              return $session->getId(); 
        }
        
        /**
            * @name closeSession
            * @description Closses a session in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $session Object to close
            * @return none
        */
        public function closeSession($session){
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . SessionDAO::$tableName . "` set " . SessionDAO::$colNameSessionEndDate . " = ? where " . SessionDAO::$colNameId . " = ?";
              $arrayValues = [date("Y-m-d H:i:s"), $session->getId()];

              $conn->execution($cons, $arrayValues);
        }

        /**
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $session Object to delete
            * @return none
        */
        public function delete($session) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . SessionDAO::$tableName . "` where " . SessionDAO::$colNameId . " = ?";
              $arrayValues = [$session->getId()];

              $conn->execution($cons, $arrayValues);
             
        }
    }
?>