<?php

    require_once "DBConnect.php";
    require_once "../model/Preinscription.php";

    /**
     * Class that will connect the object with the DB
     * @name PreinscriptionDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class PreinscriptionDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "preinscription";
        private static $colNameId = "id";
        private static $colNameSubjectId = "subjectId";
        private static $colNameMedicamentId = "medicamentId";

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
                $entity = PreinscriptionDAO::fromResultSet($row);

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
            $id = $res[PreinscriptionDAO::$colNameId];
            $subjectId = $res[PreinscriptionDAO::$colNameSubjectId];
            $medicamentId = $res[PreinscriptionDAO::$colNameMedicamentId];

            //Object construction
            $entity = new Preinscription();
            $entity->setId($id);
            $entity->setSubjectId($subjectId);
            $entity->setMedicamentId($medicamentId);

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
                error_log("Error executing query in PreinscriptionDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return PreinscriptionDAO::fromResultSetList($res);
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
            $cons = "select * from `" . PreinscriptionDAO::$tableName . "`";
            $arrayValues = [];

            return PreinscriptionDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $preinscription Object to find
            * @return Inserted id
        */
        public function create($preinscription) {
            // Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . PreinscriptionDAO::$tableName . " (`subjectId`, `medicamentId`) values (?, ?)";
              $arrayValues = [$preinscription->getSubjectId(), $preinscription->getMedicamentId()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $preinscription->setId($id);

              return $preinscription->getId(); 
        }

        /**
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $preinscription Object to find
            * @return none
        */
        public function delete($preinscription) {
             //Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . PreinscriptionDAO::$tableName . "` where " . PreinscriptionDAO::$colNameId . " = ?";
              $arrayValues = [$preinscription->getId()];

              $conn->execution($cons, $arrayValues);
             
        }
    }

?>