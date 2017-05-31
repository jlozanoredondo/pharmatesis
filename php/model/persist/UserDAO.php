<?php

    require_once "DBConnect.php";
    require_once "../model/User.php";

    /**
     * Class that will connect the object with the DB
     * @name UserDAO.php
     * @author Joan Fernández
     * @date 2017-02-23
     * @version 1.0
     */
    class UserDAO {

        //----------Data base Values---------------------------------------
        private static $tableName = "user";
        private static $colNameId = "id";
        private static $colNameName = "name";
        private static $colNameSurname = "surname";
        private static $colNameEmail = "email";
        private static $colNamePassword = "password";
        private static $colNamePhone = "phone";
        private static $colNameBornDate= "bornDate";
        private static $colNameSpecialism = "specialism";
        private static $colNameProfessionId = "professionId";

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
                $entity = UserDAO::fromResultSet($row);

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
            $id = $res[UserDAO::$colNameId];
            $name = $res[UserDAO::$colNameName];
            $surname = $res[UserDAO::$colNameSurname];
            $email = $res[UserDAO::$colNameEmail];
            $password = $res[UserDAO::$colNamePassword];
            $phone = $res[UserDAO::$colNamePhone];
            $bornDate = $res[UserDAO::$colNameBornDate];
            $specialism = $res[UserDAO::$colNameSpecialism];
            $professionId = $res[UserDAO::$colNameProfessionId];

            //Object construction
            $entity = new User();
            $entity->setId($id);
            $entity->setName($name);
            $entity->setSurnames($surname);
            $entity->setEmail($email);
            $entity->setPassword($password);
            $entity->setPhone($phone);
            $entity->setBornDate($bornDate);
            $entity->setSpecialism($specialism);
            $entity->setProfessionId($professionId);      

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
                error_log("Error executing query in UserDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return UserDAO::fromResultSetList($res);
        }

        /**
            * @name findById
            * @description Finds a object by the id
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Analysis to find
            * @return Call to findByQuery function
        */
        public static function findById($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameId . " = ?";
            $arrayValues = [$user->getId()];
            
            return UserDAO::findByQuery($cons, $arrayValues);
        }
        
        /**
            * @name findByEmail
            * @description Finds a object by the email
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Analysis to find
            * @return Call to findByQuery function
        */
        public static function findByEmail($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameEmail . " = ?";
            $arrayValues = [$user->getEmail()];
            

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findlikeName
            * @description Finds a object like name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Object to find
            * @return Call to findByQuery function
        */
        public static function findlikeName($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $user->getName() . "%"];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findByName
            * @description Finds a object by name
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Object to find
            * @return Call to findByQuery function
        */
        public static function findByName($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameName . " = ?";
            $arrayValues = [$user->getName()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findByNick
            * @description Finds a object by nick
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Object to find
            * @return Call to findByQuery function
        */
        public static function findByNick($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameNick . " = ?";
            $arrayValues = [$user->getNick()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name findByEmailAndPass
            * @description Finds a object by email and password
            * @date 2017-04-06
            * @author Joan Ferńandez
            * @version 1.0
            * @params $user Object to find
            * @return Call to findByQuery function
        */
        public static function findByEmailAndPass($user) {
            //$cons = "select * from `".UserDAO::$tableName."` where ".UserDAO::$colNameNick." = \"".$user->getNick()."\" and ".UserDAO::$colNamePassword." = \"".$user->getPassword()."\"";
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameEmail . " = ? and " . UserDAO::$colNamePassword . " = ?";
            $arrayValues = [$user->getEmail(), $user->getPassword()];

            return UserDAO::findByQuery($cons, $arrayValues);
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
            $cons = "select * from `" . UserDAO::$tableName . "`";
            $arrayValues = [];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
            * @name create
            * @description Inserts a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $user Object to create
            * @return Inserted id
        */
        public function create($user) {
            //Connection with the database
            try {
            $conn = DBConnect::getInstance();
            } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
            }

            $cons = "insert into " . UserDAO::$tableName . " (`name`,`surname`,`email`,`password`,`phone`,`bornDate`,`specialism`,`professionId`) values (?, ?, ?, ?, ?, ?, ?, ?)";
            $arrayValues = [$user->getName(), $user->getSurnames(), $user->getEmail(), $user->getPassword(), $user->getPhone(), $user->getBornDate(), $user->getSpecialism(), $user->getProfessionId()];

            $id = $conn->executionInsert($cons, $arrayValues);              
            $user->setId($id);

	    return $user->getId();
        }

        /**
            * @name delete
            * @description Deletes a object in the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $user Object to delete
            * @return none
        */
        public function delete($user) {
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameId . " = ?";
              $arrayValues = [$user->getId()];

              $conn->execution($cons, $arrayValues);             
        }

        /**
            * @name update
            * @description Updates a object into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params $user Object to update
            * @return none
        */
        public function update($user) {
            try {
                $conn = DBConnect::getInstance();

                $cons = "update `" . UserDAO::$tableName . "` set " . UserDAO::$colNameName . " = ?, " . UserDAO::$colNameSurname . " = ?, " . UserDAO::$colNameEmail . " = ?, " . UserDAO::$colNamePassword . " = ?, " . UserDAO::$colNamePhone . " = ?, " . UserDAO::$colNameBornDate . " = ?, " . UserDAO::$colNameSpecialism . " = ?, " . UserDAO::$colNameProfessionId . " = ? where " . UserDAO::$colNameId . " = ?";
                $arrayValues = [$user->getName(), $user->getSurnames(), $user->getEmail(), $user->getPassword(), $user->getPhone(), $user->getBornDate(), $user->getSpecialism(), $user->getProfessionId(), $user->getId()];

                $conn->execution($cons, $arrayValues);
            } catch (PDOException $e) {
                print "Error connecting database: " . $e->getMessage() . " ";                
            }
        }
        
        /**
            * @name updupdatePasswordate
            * @description Updates password from a user into the DB
            * @date 2017-04-06
            * @author Joan Fernández
            * @version 1.0
            * @params updatePassword Object to update the password
            * @return none
        */
        public function updatePassword($user) {
            try {
                $conn = DBConnect::getInstance();

                $cons = "update `" . UserDAO::$tableName . "` set " . UserDAO::$colNamePassword . " = ? where " . UserDAO::$colNameId . " = ?";
                $arrayValues = [$user->getPassword(),$user->getId()];

                $conn->execution($cons, $arrayValues);
            } catch (PDOException $e) {
                print "Error connecting database: " . $e->getMessage() . " ";                
            }
        }
    }

?>