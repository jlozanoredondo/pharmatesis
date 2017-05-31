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
                $entity = DiseaseDAO::fromResultSet($row);

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
            $id = $res[DiseaseDAO::$colNameId];
            $name = $res[DiseaseDAO::$colNameName];

            //Object construction
            $entity = new Disease();
            $entity->setId($id);
            $entity->setName($name);

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
                error_log("Error executing query in DiseaseDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return DiseaseDAO::fromResultSetList($res);
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
            $cons = "select * from `" . DiseaseDAO::$tableName . "`";
            $arrayValues = [];

            return DiseaseDAO::findByQuery($cons, $arrayValues);
        }        
    }

?>