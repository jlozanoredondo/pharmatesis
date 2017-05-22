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

        //---Databese management section-----------------------
        /**
         * fromResultSetList()
         * this function runs a query and returns an array with all the result transformed into an object
         * @param res query to execute
         * @return objects collection
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
         * fromResultSet()
         * the query result is transformed into an object
         * @param res ResultSet del qual obtenir dades
         * @return object
         */
        public static function fromResultSet($res) {
            //We get all the values form the query
            $id = $res[SessionDAO::$colNameId];
            $name = $res[SessionDAO::$colNameName];
            $date = $res[SessionDAO::$colNameSessionDate];
            $endDate = $res[SessionDAO::$colNameSessionEndDate];

            //Object construction
            $entity = new Session();
            $entity->setId($id);
            $entity->setName($name);
            $entity->setDate($date);
            $entity->setEndDate($endDate);

            return $entity;
        }

        /**
         * findByQuery()
         * It runs a particular query and returns the result
         * @param cons query to run
         * @return objects collection
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
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($Session) {
            $cons = "select * from `" . SessionDAO::$tableName . "` where " . SessionDAO::$colNameId . " = ?";
            $arrayValues = [$Session->getId()];

            return SessionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findlikeName($Session) {
            $cons = "select * from `" . SessionDAO::$tableName . "` where " . SessionDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $Session->getName() . "%"];

            return SessionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findByName($Session) {
            $cons = "select * from `" . SessionDAO::$tableName . "` where " . SessionDAO::$colNameName . " = ?";
            $arrayValues = [$Session->getName()];

            return SessionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . SessionDAO::$tableName . "`";
            $arrayValues = [];

            return SessionDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
         */
        public function create($Session) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . SessionDAO::$tableName . " (`userId`, `name`, `initialDate`, `testedDrug`, `diseaseId`) values (?, ?, ?, ?, ?)";
              $arrayValues = [$Session->getUserId(), $Session->getName(), $Session->getInitialDate(), $Session->getTestedDrug(), $Session->getDiseaseId()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $Session->setId($id);

              return $Session->getId(); 
        }

        /**
         * delete()
         * it deletes a row from the database
         */
        public function delete($Session) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . SessionDAO::$tableName . "` where " . SessionDAO::$colNameId . " = ?";
              $arrayValues = [$Session->getId()];

              $conn->execution($cons, $arrayValues);
             
        }

        /**
         * update()
         * it updates a row of the database
         */
        public function update($Session) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . SessionDAO::$tableName . "` set " . SessionDAO::$colNameName . " = ?, " . SessionDAO::$colNameSurname1 . " = ?, " . SessionDAO::$colNameNick . " = ?, " . SessionDAO::$colNamePassword . " = ?, " . SessionDAO::$colNameAddress . " = ?, " . SessionDAO::$colNameTelephone . " = ?, " . SessionDAO::$colNameMail . " = ?, " . SessionDAO::$colNameBirthDate . " = ?, " . SessionDAO::$colNameEntryDate . " = ?, " . SessionDAO::$colNameDropOutDate . " = ?, " . SessionDAO::$colNameActive . " = ?, " . SessionDAO::$colNameImage . " = ? where " . SessionDAO::$colNameId . " = ?";
              $arrayValues = [$Session->getName(), $Session->getSurname1(), $Session->getNick(), $Session->getPassword(), $Session->getAddress(), $Session->getTelephone(), $Session->getMail(), $Session->getBirthDate(), $Session->getEntryDate(), $Session->getDropOutDate(), $Session->getActive(), $Session->getImage(), $Session->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>