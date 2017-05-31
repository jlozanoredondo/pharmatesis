<?php

    require_once "DBConnect.php";
    require_once "../model/Dispense.php";

    /**
     * Class that will connect the object with the DB
     * @name DispenseDAO.php
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    class DispenseDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "dispense";
        private static $colNameId = "id";
        private static $colNameProjectId = "projectId";
        private static $colNameSubjectId = "subjectId";
        private static $colNamePhaseId = "phaseId";
        private static $colNameSessionId = "sessionId";
        private static $colNameViability = "viability";
        private static $colNameSideEffects= "sideEffects";
        private static $colNameDose = "dose";
        private static $colNameReaction = "reaction";

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
                $entity = DispenseDAO::fromResultSet($row);

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
            $id = $res[DispenseDAO::$colNameId];
            $projectId = $res[DispenseDAO::$colNameProjectId];
            $subjectId = $res[DispenseDAO::$colNameSubjectId];
            $phaseId = $res[DispenseDAO::$colNamePhaseId];
            $sessionId = $res[DispenseDAO::$colNameSessionId];
            $viability = $res[DispenseDAO::$colNameViability];
            $sideEffects = $res[DispenseDAO::$colNameSideEffects];
            $dose = $res[DispenseDAO::$colNameDose];
            $reaction = $res[DispenseDAO::$colNameReaction];

            //Object construction
            $entity = new Dispense();
            $entity->setId($id);
            $entity->setProjectId($projectId);
            $entity->setSubjectId($subjectId);
            $entity->setPhaseId($phaseId);
            $entity->setSessionId($sessionId);
            $entity->setViability($viability);
            $entity->setSideEffects($sideEffects);
            $entity->setDose($dose);
            $entity->setReaction($reaction);

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
                error_log("Error executing query in DispenseDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return DispenseDAO::fromResultSetList($res);
        }

        /**
            * @name findByProjectId
            * @description Finds a dispende by the project id
            * @date 2017-04-06
            * @author Jonathan Lozano
            * @version 1.0
            * @params $dispense Dispense to find
            * @return Call to findByQuery function
        */
        public static function findByProjectId($dispense) {
            $cons = "select * from `" . DispenseDAO::$tableName . "` where " . DispenseDAO::$colNameProjectId . " = ?";
            $arrayValues = [$dispense->getProjectId()];

            return DispenseDAO::findByQuery($cons, $arrayValues);
        }
        
        /**
            * @name findUpdate
            * @description Finds an updated dispense
            * @date 2017-04-06
            * @author Jonathan Lozano
            * @version 1.0
            * @params $dispense Dispense to find
            * @return Call to findByQuery function
        */
        public static function findUpdate($dispense) {
            $cons = "select * from `" . DispenseDAO::$tableName . "` where " . DispenseDAO::$colNameProjectId . " = ? and ". DispenseDAO::$colNameSubjectId . " = ? and ". DispenseDAO::$colNamePhaseId . " = ? and ". DispenseDAO::$colNameSessionId . " = ?";
            $arrayValues = [$dispense->getProjectId(), $dispense->getSubjectId(), $dispense->getPhaseId(), $dispense->getSessionId()];

            return DispenseDAO::findByQuery($cons, $arrayValues);
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
            $cons = "select * from `" . DispenseDAO::$tableName . "`";
            $arrayValues = [];

            return DispenseDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $dispense Object to find
            * @return Inserted id
        */
        public function create($dispense) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . DispenseDAO::$tableName . " (`projectId`, `subjectId`, `phaseId`, `sessionId`, `viability`, `dose`, `sideEffects`, `reaction`) values (?, ?, ?, ?, ?, ?, ?, ?)";
              $arrayValues = [$dispense->getProjectId(), $dispense->getSubjectId(), $dispense->getPhaseId(), $dispense->getSessionId(), $dispense->getViability(), $dispense->getDose(), $dispense->getSideEffects(), $dispense->getReaction()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $dispense->setId($id);

              return $dispense->getId(); 
        }        

        /**
            * @name update
            * @description Updates a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $dispense Object to update
            * @return none
        */
        public function update($dispense) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . DispenseDAO::$tableName . "` set " . DispenseDAO::$colNameViability . " = ?, " . DispenseDAO::$colNameSideEffects . " = ?, " . DispenseDAO::$colNameDose . " = ?, " . DispenseDAO::$colNameReaction . " = ? where " . DispenseDAO::$colNameId . " = ?";
              $arrayValues = [$dispense->getViability(), $dispense->getSideEffects(), $dispense->getDose(), $dispense->getReaction(), $dispense->getId()];

              $conn->execution($cons, $arrayValues);
        }

    }

?>