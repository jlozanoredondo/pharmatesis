<?php

        require_once "DBConnect.php";
        require_once "../model/Profession.php";

    /**
     * Class that will connect the object with the DB
     * @name ProfessionDAO.php
     * @author Jonathan Lozano
     * @date 2017-05-15
     * @version 1.0
     */
    class ProfessionDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "profession";
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
        public static function fromResultSetList( $res ) {
            $entityList = array();
            $i=0;
            //while ( ($row = $res->fetch_array(MYSQLI_BOTH)) != NULL ) {
            foreach ( $res as $row)
            {
                    //We get all the values an add into the array
                    $entity = ProfessionDAO::fromResultSet( $row );

                    $entityList[$i]= $entity;
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
        public static function fromResultSet( $res ) {
            //We get all the values form the query
            $id = $res[ ProfessionDAO::$colNameId];
            $name = $res[ ProfessionDAO::$colNameName ];


                    //Object construction
            $entity = new Profession();
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
        public static function findByQuery( $cons, $vector ) {
            //Connection with the database
            try {
                    $conn = DBConnect::getInstance();
            }
            catch (PDOException $e) {
                    echo "Error executing query.";
                    error_log("Error executing query in ProfessionDAO: " . $e->getMessage() . " ");
                    die();
            }

            //Run the query
            $res = $conn->execution($cons, $vector);

            return ProfessionDAO::fromResultSetList( $res );
        }

        /**
            * @name findById
            * @description Finds a object by the id
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findById( $analysisType ) {
            $cons = "select * from `".ProfessionDAO::$tableName."` where ".ProfessionDAO::$colNameId." = ?";
            $arrayValues = [$film->getId()];

            return ProfessionDAO::findByQuery( $cons, $arrayValues );
        }

        /**
            * @name findlikeName
            * @description Finds a object like name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findlikeName( $analysisType ) {
            $cons = "select * from `".ProfessionDAO::$tableName."` where ".ProfessionDAO::$colNameName." like ?";
            $arrayValues = ["%".$film->getName()."%"];

            return ProfessionDAO::findByQuery( $cons, $arrayValues );
        }


        /**
            * @name findByName
            * @description Finds a object by name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $analysisType Analysis to find
            * @return Call to findByQuery function
        */
        public static function findByName( $analysisType ) {
            $cons = "select * from `".ProfessionDAO::$tableName."` where ".ProfessionDAO::$colNameName." = ?";
            $arrayValues = [$film->getName()];

            return ProfessionDAO::findByQuery( $cons, $arrayValues );
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
            $cons = "select * from `".ProfessionDAO::$tableName."`";
            $arrayValues = [];

            return ProfessionDAO::findByQuery( $cons, $arrayValues );
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $analysisType Object to create
            * @return Inserted id
        */
        public function create($analysisType) {
            //Connection with the database
            try {
                        $conn = DBConnect::getInstance();
                }
                catch (PDOException $e) {
                        print "Error connecting database: " . $e->getMessage() . " ";
                        die();
                }

                $cons="insert into ".ProfessionDAO::$tableName." values (?)";
                $arrayValues= [$analysisType->getName()];

                $id = $conn->executionInsert($cons, $arrayValues);

                $analysisType->setId($id);

            return $analysisType->getId();
        }

        /**
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $analysisType Object to delete
            * @return none
        */
        public function delete($analysisType) {
            //Connection with the database
            try {
                    $conn = DBConnect::getInstance();
            }
            catch (PDOException $e) {
                    print "Error connecting database: " . $e->getMessage() . " ";
                    die();
            }


            $cons="delete from `".ProfessionDAO::$tableName."` where ".ProfessionDAO::$colNameId." = ?";
            $arrayValues= [$analysisType->getId()];

            $conn->execution($cons, $arrayValues);
        }

        /**
            * @name update
            * @description Updates a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $analysisType Object to update
            * @return none
        */
        public function update($analysisType) {
            //Connection with the database
            try {
                    $conn = DBConnect::getInstance();
            }
            catch (PDOException $e) {
                    print "Error connecting database: " . $e->getMessage() . " ";
                    die();
            }

            $cons="update `".ProfessionDAO::$tableName."` set ".ProfessionDAO::$colNameName." = ? where ".ProfessionDAO::$colNameId." = ?";
            $arrayValues= [$analysisType->getName(), $analysisType->getId()];

            $conn->execution($cons, $arrayValues);
        }
    }
?>
