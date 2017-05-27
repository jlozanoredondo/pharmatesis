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
                $entity = UserDAO::fromResultSet($row);

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
                error_log("Error executing query in UserDAO: " . $e->getMessage() . " ");
                die();
            }

            $res = $conn->execution($cons, $vector);

            return UserDAO::fromResultSetList($res);
        }

        /**
         * findById()
         * It runs a query and returns an object array
         * @param id
         * @return object with the query results
         */
        public static function findById($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameId . " = ?";
            $arrayValues = [$user->getId()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findlikeName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findlikeName($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameName . " like ?";
            $arrayValues = ["%" . $user->getName() . "%"];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByName()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByName($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameName . " = ?";
            $arrayValues = [$user->getName()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByNick()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByNick($user) {
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameNick . " = ?";
            $arrayValues = [$user->getNick()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findByNickAndPass()
         * It runs a query and returns an object array
         * @param name
         * @return object with the query results
         */
        public static function findByEmailAndPass($user) {
            //$cons = "select * from `".UserDAO::$tableName."` where ".UserDAO::$colNameNick." = \"".$user->getNick()."\" and ".UserDAO::$colNamePassword." = \"".$user->getPassword()."\"";
            $cons = "select * from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameEmail . " = ? and " . UserDAO::$colNamePassword . " = ?";
            $arrayValues = [$user->getEmail(), $user->getPassword()];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * findAll()
         * It runs a query and returns an object array
         * @param none
         * @return object with the query results
         */
        public static function findAll() {
            $cons = "select * from `" . UserDAO::$tableName . "`";
            $arrayValues = [];

            return UserDAO::findByQuery($cons, $arrayValues);
        }

        /**
         * create()
         * insert a new row into the database
         */
        public function create($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "insert into " . UserDAO::$tableName . " (`name`,`surname1`,`nick`,`password`,`address`,`telephone`,`mail`,`birthDate`,`entryDate`,`dropOutDate`,`active`,`image`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $arrayValues = [$user->getName(), $user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage()];

              $id = $conn->executionInsert($cons, $arrayValues);

              $user->setId($id);

              return $user->getId(); */
        }

        /**
         * delete()
         * it deletes a row from the database
         */
        public function delete($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }


              $cons = "delete from `" . UserDAO::$tableName . "` where " . UserDAO::$colNameId . " = ?";
              $arrayValues = [$user->getId()];

              $conn->execution($cons, $arrayValues);
             */
        }

        /**
         * update()
         * it updates a row of the database
         */
        public function update($user) {
            /* Connection with the database
              try {
              $conn = DBConnect::getInstance();
              } catch (PDOException $e) {
              print "Error connecting database: " . $e->getMessage() . " ";
              die();
              }

              $cons = "update `" . UserDAO::$tableName . "` set " . UserDAO::$colNameName . " = ?, " . UserDAO::$colNameSurname1 . " = ?, " . UserDAO::$colNameNick . " = ?, " . UserDAO::$colNamePassword . " = ?, " . UserDAO::$colNameAddress . " = ?, " . UserDAO::$colNameTelephone . " = ?, " . UserDAO::$colNameMail . " = ?, " . UserDAO::$colNameBirthDate . " = ?, " . UserDAO::$colNameEntryDate . " = ?, " . UserDAO::$colNameDropOutDate . " = ?, " . UserDAO::$colNameActive . " = ?, " . UserDAO::$colNameImage . " = ? where " . UserDAO::$colNameId . " = ?";
              $arrayValues = [$user->getName(), $user->getSurname1(), $user->getNick(), $user->getPassword(), $user->getAddress(), $user->getTelephone(), $user->getMail(), $user->getBirthDate(), $user->getEntryDate(), $user->getDropOutDate(), $user->getActive(), $user->getImage(), $user->getId()];

              $conn->execution($cons, $arrayValues); */
        }

    }

?>