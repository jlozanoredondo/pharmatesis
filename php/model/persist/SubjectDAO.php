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
                $entity = SubjectDAO::fromResultSet($row);

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
            $entity->setCountryId($countryId);
            $entity->setUserId($userId);

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
                error_log("Error executing query in SubjectDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return SubjectDAO::fromResultSetList($res);
        }

        /**
            * @name findById
            * @description Finds a object by the id
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findById($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameId . " = ?";
            $arrayValues = [$subject->getId()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findlikeName
            * @description Finds a object like name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findlikeName($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $subject->getName() . "%"];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findByName
            * @description Finds a object by name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findByName($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameName . " = ?";
            $arrayValues = [$subject->getName()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findByNick
            * @description Finds a object by nick
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findByNick($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameNick . " = ?";
            $arrayValues = [$subject->getNick()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
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
        public static function findAllUser($subject) {
            $cons = "select * from `" . SubjectDAO::$tableName . "` where " . SubjectDAO::$colNameUserId . " = ?";
            $arrayValues = [$subject->getUserId()];

            return SubjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $analysisType Object to find
            * @return Inserted id
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
    }

?>