<?php

    require_once "DBConnect.php";
    require_once "../model/Medicament.php";

    /**
     * Class that will connect the object with the DB
     * @name MedicamentDAO.php
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     */
    class MedicamentDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "medicament";
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
                $entity = MedicamentDAO::fromResultSet($row);

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
            $id = $res[MedicamentDAO::$colNameId];
            $name = $res[MedicamentDAO::$colNameName];

            //Object construction
            $entity = new Medicament();
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
                error_log("Error executing query in MedicamentDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return MedicamentDAO::fromResultSetList($res);
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
            $cons = "select * from `" . MedicamentDAO::$tableName . "`";
            $arrayValues = [];

            return MedicamentDAO::findByQuery($cons, $arrayValues);
        }      
    }

?>