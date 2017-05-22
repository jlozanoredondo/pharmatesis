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
                $entity = DispenseDAO::fromResultSet($row);

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
                error_log("Error executing query in DispenseDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return DispenseDAO::fromResultSetList($res);
        }

        /**
         * findByProjectId()
         * It runs a query and returns an object array
         * @param dispense
         * @return object with the query results
         */
        public static function findByProjectId($dispense) {
            $cons = "select * from `" . DispenseDAO::$tableName . "` where " . DispenseDAO::$colNameProjectId . " = ?";
            $arrayValues = [$dispense->getProjectId()];

            return DispenseDAO::findByQuery($cons, $arrayValues);
        }
        /**
         * findUpdate()
         * It runs a query and returns an object array
         * @param dispense
         * @return object with the query results
         */
        public static function findUpdate($dispense) {
            $cons = "select * from `" . DispenseDAO::$tableName . "` where " . DispenseDAO::$colNameProjectId . " = ? and ". DispenseDAO::$colNameSubjectId . " = ? and ". DispenseDAO::$colNamePhaseId . " = ? and ". DispenseDAO::$colNameSessionId . " = ?";
            $arrayValues = [$dispense->getProjectId(), $dispense->getSubjectId(), $dispense->getPhaseId(), $dispense->getSessionId()];

            return DispenseDAO::findByQuery($cons, $arrayValues);
        }

      
        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . DispenseDAO::$tableName . "`";
            $arrayValues = [];

            return DispenseDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
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
         * delete()
         * it deletes a row from the database
         */
        public function delete($dispense) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . DispenseDAO::$tableName . "` where " . DispenseDAO::$colNameId . " = ?";
              $arrayValues = [$dispense->getId()];

              $conn->execution($cons, $arrayValues);
             */
        }

        /**
         * update()
         * it updates a row of the database
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