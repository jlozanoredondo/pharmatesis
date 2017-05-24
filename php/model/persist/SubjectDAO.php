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
        private static $colNameBreed = "breed";
        private static $colNameNick = "nick";
        private static $colNameBloodType = "bloodType";
        private static $colNameStatus= "status";
        private static $colNameHeight= "height";
        private static $colNameWeight= "weight";
        private static $colNameCountryId = "countryId";
        private static $colNameUserId = "userId";

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
            $breed = $res[SubjectDAO::$colNameBreed];
            $nick = $res[SubjectDAO::$colNameNick];
            $bloodType = $res[SubjectDAO::$colNameBloodType];
            $status = $res[SubjectDAO::$colNameStatus];            
            $height = $res[SubjectDAO::$colNameHeight];            
            $weight = $res[SubjectDAO::$colNameWeight];            
            $countryId = $res[SubjectDAO::$colNameCountryId];            
            $userId = $res[SubjectDAO::$colNameUserId];            

            //Object construction
            $entity = new Subject();
            $entity->setId($id);
            $entity->setBornDate($bornDate);
            $entity->setGender($gender);
            $entity->setBreed($breed);
            $entity->setNick($nick);
            $entity->setBloodType($bloodType);
            $entity->setStatus($status);
            $entity->setHeight($height);
            $entity->setWeight($weight);
            $entity->setCountryId($userId);
            $entity->setUserId($userId);

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
        public static function findById($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameId . " = ?";
            $arrayValues = [$subject->getId()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findlikeName($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $subject->getName() . "%"];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByName($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " = ?";
            $arrayValues = [$subject->getName()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByNick()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByNick($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameNick . " = ?";
            $arrayValues = [$subject->getNick()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAllUser($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameUserId . " = ?";
            $arrayValues = [$subject->getUserId()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
         */
        public function create($subject) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . SubjectDAO::$tableName . " (`bornDate`, `gender`, `breed`, `nick`, `bloodType`, `status`, `height`, `weight`, `countryId`, `userId`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $arrayValues = [$subject->getBornDate(), $subject->getGender(), $subject->getBreed(), $subject->getNick(), $subject->getBloodType(), $subject->getStatus(), $subject->getHeight(), $subject->getWeight(), $subject->getCountryId(),$subject->getUserId()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $subject->setId($id);

              return $subject->getId(); 
        }

        /**
         * delete()
         * it deletes a row from the database
         */
        public function delete($subject) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameId . " = ?";
              $arrayValues = [$subject->getId()];

              $conn->execution($cons, $arrayValues);
             */
        }

        /**
         * update()
         * it updates a row of the database
         */
        public function update($subject) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . SubjectDAO::$tableName . "` set " . SubjectDAO::$colNameName . " = ?, " . SubjectDAO::$colNameBornDate1 . " = ?, " . SubjectDAO::$colNameNick . " = ?, " . SubjectDAO::$colNamePassword . " = ?, " . SubjectDAO::$colNameAddress . " = ?, " . SubjectDAO::$colNameTelephone . " = ?, " . SubjectDAO::$colNameMail . " = ?, " . SubjectDAO::$colNameBirthDate . " = ?, " . SubjectDAO::$colNameEntryDate . " = ?, " . SubjectDAO::$colNameDropOutDate . " = ?, " . SubjectDAO::$colNameActive . " = ?, " . SubjectDAO::$colNameImage . " = ? where " . SubjectDAO::$colNameId . " = ?";
              $arrayValues = [$subject->getName(), $subject->getBornDate1(), $subject->getNick(), $subject->getPassword(), $subject->getAddress(), $subject->getTelephone(), $subject->getMail(), $subject->getBirthDate(), $subject->getEntryDate(), $subject->getDropOutDate(), $subject->getActive(), $subject->getImage(), $subject->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>