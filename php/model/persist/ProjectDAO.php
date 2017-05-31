<?php

    require_once "DBConnect.php";
    require_once "../model/Project.php";

    /**
     * Class that will connect the object with the DB
     * @name ProjectDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class ProjectDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "project";
        private static $colNameId = "id";
        private static $colNameUserId = "userId";
        private static $colNameName = "name";
        private static $colNameInitialDate = "initialDate";
        private static $colNameEndDate = "endDate";
        private static $colNameTestedDrug = "testedDrug";
        private static $colNameDiseaseId= "diseaseId";

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
                $entity = ProjectDAO::fromResultSet($row);

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
            $id = $res[ProjectDAO::$colNameId];
            $userId = $res[ProjectDAO::$colNameUserId];
            $name = $res[ProjectDAO::$colNameName];
            $initialDate = $res[ProjectDAO::$colNameInitialDate];
            $endDate = $res[ProjectDAO::$colNameEndDate];
            $testedDrug = $res[ProjectDAO::$colNameTestedDrug];
            $diseaseId = $res[ProjectDAO::$colNameDiseaseId];

            //Object construction
            $entity = new Project();
            $entity->setId($id);
            $entity->setUserId($userId);
            $entity->setName($name);
            $entity->setInitialDate($initialDate);
            $entity->setEndDate($endDate);
            $entity->setTestedDrug($testedDrug);
            $entity->setDiseaseId($diseaseId);

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
                error_log("Error executing query in ProjectDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return ProjectDAO::fromResultSetList($res);
        }
        /**
            * @name findProjectId
            * @description Finds a object by the id
            * @date 2017-04-06
            * @author Jonathan Lozano
            * @version 1.0
            * @params $project Object to find
            * @return Call to findByQuery function
        */
        public static function findProjectId($project) {
            $cons = "select * from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameId . " = ?";
            $arrayValues = [$project->getId()];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }
        /**
            * @name findAllUser
            * @description Finds a object by the id
            * @date 2017-04-06
            * @author Jonathan Lozano
            * @version 1.0
            * @params $project Object to find
            * @return Call to findByQuery function
        */
        public static function findAllUser($project) {
            $cons = "select * from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameUserId . " = ?";
            $arrayValues = [$project->getUserId()];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $project Object to create
            * @return Inserted id
        */
        public function create($project) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . ProjectDAO::$tableName . " (`userId`, `name`, `initialDate`, `testedDrug`, `diseaseId`) values (?, ?, ?, ?, ?)";
              $arrayValues = [$project->getUserId(), $project->getName(), $project->getInitialDate(), $project->getTestedDrug(), $project->getDiseaseId()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $project->setId($id);

              return $project->getId(); 
        }

        /**
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $project Object to delete
            * @return none
        */
        public function delete($project) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameId . " = ?";
              $arrayValues = [$project->getId()];

              $conn->execution($cons, $arrayValues);
             
        }

        /**
            * @name close
            * @description Close a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $project Object to close
            * @return none
        */
        public function close($project) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "update `" . ProjectDAO::$tableName . "` set " . ProjectDAO::$colNameEndDate . " = ? where " . ProjectDAO::$colNameId . " = ?";
              $arrayValues = [$project->getEndDate(), $project->getId()];

              $conn->execution($cons, $arrayValues);
             
        }
    }

?>