<?php

    require_once "DBConnect.php";
    require_once "../model/Endure.php";

    /**
     * Class that will connect the object with the DB
     * @name EndureDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class EndureDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "endure";
        private static $colNameId = "id";
        private static $colNameSubjectId = "subjectId";
        private static $colNameDiseaseId = "diseaseId";

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
                $entity = EndureDAO::fromResultSet($row);

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
            $id = $res[EndureDAO::$colNameId];
            $subjectId = $res[EndureDAO::$colNameSubjectId];
            $diseaseId = $res[EndureDAO::$colNameDiseaseId];

            //Object construction
            $entity = new Endure();
            $entity->setId($id);
            $entity->setSubjectId($subjectId);
            $entity->setDiseaseId($diseaseId);

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
                error_log("Error executing query in EndureDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return EndureDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($endure) {
            $cons = "select * from `" . EndureDAO::$tableName . "` where " . EndureDAO::$colNameId . " = ?";
            $arrayValues = [$endure->getId()];

            return EndureDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findlikeName($endure) {
            $cons = "select * from `" . EndureDAO::$tableName . "` where " . EndureDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $endure->getName() . "%"];

            return EndureDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findByName($endure) {
            $cons = "select * from `" . EndureDAO::$tableName . "` where " . EndureDAO::$colNameName . " = ?";
            $arrayValues = [$endure->getName()];

            return EndureDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . EndureDAO::$tableName . "`";
            $arrayValues = [];

            return EndureDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
         */
        public function create($endure) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . EndureDAO::$tableName . " (`subjectId`, `diseaseId`) values (?, ?)";
              $arrayValues = [$endure->getSubjectId(), $endure->getDiseaseId()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $endure->setId($id);

              return $endure->getId(); 
        }

        /**
         * delete()
         * it deletes a row from the database
         */
        public function delete($endure) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . EndureDAO::$tableName . "` where " . EndureDAO::$colNameId . " = ?";
              $arrayValues = [$endure->getId()];

              $conn->execution($cons, $arrayValues);
             
        }

        /**
         * update()
         * it updates a row of the database
         */
        public function update($endure) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . EndureDAO::$tableName . "` set " . EndureDAO::$colNameName . " = ?, " . EndureDAO::$colNameSurname1 . " = ?, " . EndureDAO::$colNameNick . " = ?, " . EndureDAO::$colNamePassword . " = ?, " . EndureDAO::$colNameAddress . " = ?, " . EndureDAO::$colNameTelephone . " = ?, " . EndureDAO::$colNameMail . " = ?, " . EndureDAO::$colNameBirthDate . " = ?, " . EndureDAO::$colNameEntryDate . " = ?, " . EndureDAO::$colNameDropOutDate . " = ?, " . EndureDAO::$colNameActive . " = ?, " . EndureDAO::$colNameImage . " = ? where " . EndureDAO::$colNameId . " = ?";
              $arrayValues = [$endure->getName(), $endure->getSurname1(), $endure->getNick(), $endure->getPassword(), $endure->getAddress(), $endure->getTelephone(), $endure->getMail(), $endure->getBirthDate(), $endure->getEntryDate(), $endure->getDropOutDate(), $endure->getActive(), $endure->getImage(), $endure->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>