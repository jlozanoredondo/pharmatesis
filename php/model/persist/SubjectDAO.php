<?php

    require_once "DBConnect.php";
    require_once "../model/Subject.php";

    /**
     * Class that will connect the object with the DB
     * @name SubjectDAO.php
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    class SubjectDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "subject";
        private static $colNameId = "id";
        private static $colNameBornDate = "bornDate";
        private static $colNameGender = "gender";
        private static $colNameNick = "nick";
        private static $colNameBloodType = "bloodType";
        private static $colNameCountryId = "countryId";
        private static $colNameStatus= "status";

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
                $entity = SubjectDAO::fromResultSet($row);

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
            $id = $res[SubjectDAO::$colNameId];
            $bornDate = $res[SubjectDAO::$colNameBornDate];
            $gender = $res[SubjectDAO::$colNameGender];
            $nick = $res[SubjectDAO::$colNameNick];
            $bloodType = $res[SubjectDAO::$colNameBloodType];
            $countryId = $res[SubjectDAO::$colNameCountryId];            
            $status = $res[SubjectDAO::$colNameStatus];            

            //Object construction
            $entity = new Subject();
            $entity->setId($id);
            $entity->setBornDate($bornDate);
            $entity->setGender($gender);
            $entity->setNick($nick);
            $entity->setBloodType($bloodType);
            $entity->setCountryId($countryId);
            $entity->setStatus($status);

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
                error_log("Error executing query in SubjectDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return SubjectDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        public static function findById($user) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameId . " = ?";
            $arrayValues = [$user->getId()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findlikeName($user) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $user->getName() . "%"];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByName($user) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " = ?";
            $arrayValues = [$user->getName()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByNick()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByNick($user) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameNick . " = ?";
            $arrayValues = [$user->getNick()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . SubjectDAO::$tableName . "`";
            $arrayValues = [];

            return SubjectDAO::findByQuery($cons, $arrayValues);
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

              $cons = "insert into " . SubjectDAO::$tableName . " (`name`,`bornDate1`,`nick`,`password`,`address`,`telephone`,`mail`,`birthDate`,`entryDate`,`dropOutDate`,`active`,`image`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $arrayValues = [$user->getName(), $user->getBornDate1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage()];

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


              $cons = "delete from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameId . " = ?";
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

              $cons = "update `" . SubjectDAO::$tableName . "` set " . SubjectDAO::$colNameName . " = ?, " . SubjectDAO::$colNameBornDate1 . " = ?, " . SubjectDAO::$colNameNick . " = ?, " . SubjectDAO::$colNamePassword . " = ?, " . SubjectDAO::$colNameAddress . " = ?, " . SubjectDAO::$colNameTelephone . " = ?, " . SubjectDAO::$colNameMail . " = ?, " . SubjectDAO::$colNameBirthDate . " = ?, " . SubjectDAO::$colNameEntryDate . " = ?, " . SubjectDAO::$colNameDropOutDate . " = ?, " . SubjectDAO::$colNameActive . " = ?, " . SubjectDAO::$colNameImage . " = ? where " . SubjectDAO::$colNameId . " = ?";
              $arrayValues = [$user->getName(), $user->getBornDate1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage(), $user->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>