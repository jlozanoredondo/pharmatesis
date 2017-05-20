<?php

    require_once "DBConnect.php";
    require_once "../model/Disease.php";

    /**
     * Class that will connect the object with the DB
     * @name DiseaseDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class DiseaseDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "disease";
        private static $colNameId = "id";
        private static $colNameName = "name";

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
                $entity = DiseaseDAO::fromResultSet($row);

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
            $id = $res[DiseaseDAO::$colNameId];
            $name = $res[DiseaseDAO::$colNameName];

            //Object construction
            $entity = new Disease();
            $entity->setId($id);
            $entity->setName($name);

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
                error_log("Error executing query in DiseaseDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return DiseaseDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($user) {
            $cons = "select * from `" . DiseaseDAO::$tableName . "` where " . DiseaseDAO::$colNameId . " = ?";
            $arrayValues = [$user->getId()];

            return DiseaseDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findlikeName($user) {
            $cons = "select * from `" . DiseaseDAO::$tableName . "` where " . DiseaseDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $user->getName() . "%"];

            return DiseaseDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findByName($user) {
            $cons = "select * from `" . DiseaseDAO::$tableName . "` where " . DiseaseDAO::$colNameName . " = ?";
            $arrayValues = [$user->getName()];

            return DiseaseDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . DiseaseDAO::$tableName . "`";
            $arrayValues = [];

            return DiseaseDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
         */
        public function create($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . DiseaseDAO::$tableName . " (`name`,`surname1`,`nick`,`password`,`address`,`telephone`,`mail`,`birthDate`,`entryDate`,`dropOutDate`,`active`,`image`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $arrayValues = [$user->getName(), $user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $user->setId($id);

              return $user->getId(); */
        }

        /**
         * delete()
         * it deletes a row from the database
         */
        public function delete($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . DiseaseDAO::$tableName . "` where " . DiseaseDAO::$colNameId . " = ?";
              $arrayValues = [$user->getId()];

              $conn->execution($cons, $arrayValues);
             */
        }

        /**
         * update()
         * it updates a row of the database
         */
        public function update($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . DiseaseDAO::$tableName . "` set " . DiseaseDAO::$colNameName . " = ?, " . DiseaseDAO::$colNameSurname1 . " = ?, " . DiseaseDAO::$colNameNick . " = ?, " . DiseaseDAO::$colNamePassword . " = ?, " . DiseaseDAO::$colNameAddress . " = ?, " . DiseaseDAO::$colNameTelephone . " = ?, " . DiseaseDAO::$colNameMail . " = ?, " . DiseaseDAO::$colNameBirthDate . " = ?, " . DiseaseDAO::$colNameEntryDate . " = ?, " . DiseaseDAO::$colNameDropOutDate . " = ?, " . DiseaseDAO::$colNameActive . " = ?, " . DiseaseDAO::$colNameImage . " = ? where " . DiseaseDAO::$colNameId . " = ?";
              $arrayValues = [$user->getName(), $user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage(), $user->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>