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
                $entity = ProjectDAO::fromResultSet($row);

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
                error_log("Error executing query in ProjectDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return ProjectDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($project) {
            $cons = "select * from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameId . " = ?";
            $arrayValues = [$project->getId()];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findlikeName($project) {
            $cons = "select * from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $project->getName() . "%"];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findByName($project) {
            $cons = "select * from `" . ProjectDAO::$tableName . "` where " . ProjectDAO::$colNameName . " = ?";
            $arrayValues = [$project->getName()];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . ProjectDAO::$tableName . "`";
            $arrayValues = [];

            return ProjectDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
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
         * delete()
         * it deletes a row from the database
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
         * update()
         * it updates a row of the database
         */
        public function update($project) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . ProjectDAO::$tableName . "` set " . ProjectDAO::$colNameName . " = ?, " . ProjectDAO::$colNameSurname1 . " = ?, " . ProjectDAO::$colNameNick . " = ?, " . ProjectDAO::$colNamePassword . " = ?, " . ProjectDAO::$colNameAddress . " = ?, " . ProjectDAO::$colNameTelephone . " = ?, " . ProjectDAO::$colNameMail . " = ?, " . ProjectDAO::$colNameBirthDate . " = ?, " . ProjectDAO::$colNameEntryDate . " = ?, " . ProjectDAO::$colNameDropOutDate . " = ?, " . ProjectDAO::$colNameActive . " = ?, " . ProjectDAO::$colNameImage . " = ? where " . ProjectDAO::$colNameId . " = ?";
              $arrayValues = [$project->getName(), $project->getSurname1(), $project->getNick(), $project->getPassword(), $project->getAddress(), $project->getTelephone(), $project->getMail(), $project->getBirthDate(), $project->getEntryDate(), $project->getDropOutDate(), $project->getActive(), $project->getImage(), $project->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>