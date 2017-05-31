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
                $entity = EndureDAO::fromResultSet($row);

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
                error_log("Error executing query in EndureDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return EndureDAO::fromResultSetList($res);
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
            $cons = "select * from `" . EndureDAO::$tableName . "`";
            $arrayValues = [];

            return EndureDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $endure Object to find
            * @return Inserted id
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
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $endure Object to find
            * @return none
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
    }

?>