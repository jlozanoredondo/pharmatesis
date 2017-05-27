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
                $entity = MedicamentDAO::fromResultSet($row);

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
            $id = $res[MedicamentDAO::$colNameId];
            $name = $res[MedicamentDAO::$colNameName];

            //Object construction
            $entity = new Medicament();
            $entity->setId($id);
            $entity->setName($name);

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
                error_log("Error executing query in MedicamentDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return MedicamentDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($phase) {
            $cons = "select * from `" . MedicamentDAO::$tableName . "` where " . MedicamentDAO::$colNameId . " = ?";
            $arrayValues = [$phase->getId()];

            return MedicamentDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . MedicamentDAO::$tableName . "`";
            $arrayValues = [];

            return MedicamentDAO::findByQuery($cons, $arrayValues);
        }
       

    }

?>