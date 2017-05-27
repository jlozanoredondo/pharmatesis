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
                $entity = PreinscriptionDAO::fromResultSet($row);

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
                error_log("Error executing query in PreinscriptionDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return PreinscriptionDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        /*public static function findById($preinscription) {
            $cons = "select * from `" . PreinscriptionDAO::$tableName . "` where " . PreinscriptionDAO::$colNameId . " = ?";
            $arrayValues = [$preinscription->getId()];

            return PreinscriptionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findlikeName($preinscription) {
            $cons = "select * from `" . PreinscriptionDAO::$tableName . "` where " . PreinscriptionDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $preinscription->getName() . "%"];

            return PreinscriptionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        /*public static function findByName($preinscription) {
            $cons = "select * from `" . PreinscriptionDAO::$tableName . "` where " . PreinscriptionDAO::$colNameName . " = ?";
            $arrayValues = [$preinscription->getName()];

            return PreinscriptionDAO::findByQuery($cons, $arrayValues);
        }*/

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . PreinscriptionDAO::$tableName . "`";
            $arrayValues = [];

            return PreinscriptionDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
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
         * delete()
         * it deletes a row from the database
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

        /**
         * update()
         * it updates a row of the database
         */
        public function update($preinscription) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . PreinscriptionDAO::$tableName . "` set " . PreinscriptionDAO::$colNameName . " = ?, " . PreinscriptionDAO::$colNameSurname1 . " = ?, " . PreinscriptionDAO::$colNameNick . " = ?, " . PreinscriptionDAO::$colNamePassword . " = ?, " . PreinscriptionDAO::$colNameAddress . " = ?, " . PreinscriptionDAO::$colNameTelephone . " = ?, " . PreinscriptionDAO::$colNameMail . " = ?, " . PreinscriptionDAO::$colNameBirthDate . " = ?, " . PreinscriptionDAO::$colNameEntryDate . " = ?, " . PreinscriptionDAO::$colNameDropOutDate . " = ?, " . PreinscriptionDAO::$colNameActive . " = ?, " . PreinscriptionDAO::$colNameImage . " = ? where " . PreinscriptionDAO::$colNameId . " = ?";
              $arrayValues = [$preinscription->getName(), $preinscription->getSurname1(), $preinscription->getNick(), $preinscription->getPassword(), $preinscription->getAddress(), $preinscription->getTelephone(), $preinscription->getMail(), $preinscription->getBirthDate(), $preinscription->getEntryDate(), $preinscription->getDropOutDate(), $preinscription->getActive(), $preinscription->getImage(), $preinscription->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>