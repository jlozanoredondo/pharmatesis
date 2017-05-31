<?php

    /**
    * @name CountryControllerClass
    * Controller to connect the country client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    require_once "ControllerInterface.php";
    require_once "../model/User.php";
    require_once "../model/Review.php";
    require_once "../model/persist/UserDAO.php";

    class UserControllerClass implements ControllerInterface {

        private $action;
        private $jsonData;

        function __construct($action, $jsonData) {
            $this->setAction($action);
            $this->setJsonData($jsonData);
        }

        public function getAction() {
            return $this->action;
        }

        public function getJsonData() {
            return $this->jsonData;
        }

        public function setAction($action) {
            $this->action = $action;
        }

        public function setJsonData($jsonData) {
            $this->jsonData = $jsonData;
        }

        public function doAction() {
            $outPutData = array();

            switch ($this->getAction()) {
                case 10000:
                    $outPutData = $this->userConnection();
                    break;
                case 10010:
                        $outPutData = $this->entryUser();
                        break;
                case 10020:
                    $outPutData = $this->modifyUser();           
                  break;
                case 10030:
                    $outPutData = $this->sessionControl();
                    break;
                case 10040:
                    //Closing session
                    session_unset();
                    session_destroy();
                    $outPutData[0] = true;
                    break;
                case 10050:
                    $outPutData = $this->sendEmail();
                    break;
                case 10060:
                    $outPutData = $this->deleteUser();
                    break;
                case 10070:
                    $outPutData = $this->findUser();
                    break;
                case 10080:
                    $outPutData = $this->passwordRecovery();
                    break;
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in UserControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }
        
        /**
            * @name userConnection
            * @description Finds a user into the DB and creates the session
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function userConnection() {
            $userObj = json_decode(stripslashes($this->getJsonData()));

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $user = new User();
            $user->setEmail($userObj->email);
            $user->setPassword($userObj->password);

            $userList = UserDAO::findByEmailAndPass($user);

            if (count($userList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No user was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $usersArray = array();

                foreach ($userList as $user) {
                    $usersArray[] = $user->getAll();
                }

                $_SESSION['connectedUser'] = $userList[0];

                $outPutData[1] = $usersArray;
            }

            return $outPutData;
        }
        
        /**
            * @name entryUser
            * @description Creates a user into the DB
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function entryUser()
        {
            $userObj = json_decode(stripslashes($this->getJsonData()));

            $user = new User();
            $date = date('Y-m-d H:i:s', strtotime($userObj->bornDate));
            $user->setAll(0, $userObj->name, $userObj->surnames, $userObj->email, $userObj->password, $userObj->phone, $date, $userObj->specialism, $userObj->professionId->id);

            $outPutData = array();
            $outPutData[]= true;
            $user->setId(UserDAO::create($user));

            //the senetnce returns de id of the user inserted
            $outPutData[]= array($user->getAll());

            return $outPutData;
        }
        
        /**
            * @name findUser
            * @description Finds a user into the DB
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function findUser()
        {
            $userObj = json_decode(stripslashes($this->getJsonData()));

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $user = new User();
            $user->setId($userObj->id);

            $userList = UserDAO::findById($user);

            if (count($userList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No user was found with this data.";
                $outPutData[1] = $errors;
            } else {
                $usersArray = array();

                foreach ($userList as $user) {
                    $usersArray[] = $user->getAll();
                }

                $outPutData[1] = $usersArray;
            }

            return $outPutData;
        }
        
        /**
            * @name sessionControl
            * @description Controlls session information
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function sessionControl() {
            $outPutData = array();
            $outPutData[] = true;

            if (isset($_SESSION['connectedUser'])) {
                $outPutData[] = $_SESSION['connectedUser']->getAll();
            } else {
                $outPutData[0] = false;
                $errors[] = "No session opened!";
                $outPutData[1] = $errors;
            }

            return $outPutData;
        }
        
        /**
            * @name sendEmail
            * @description Sends an email to Pharmatesis
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function sendEmail() {
            try{
                $reviewObj = json_decode(stripslashes($this->getJsonData()));
                $outPutData = array();       
                
                $review = new Review();

                $review->setName($reviewObj->name);
                $review->setComment($reviewObj->comments);
                
                $to = 'pharmatesis@gmail.com';
                $send = mail($to, $review->getName(), $review->getComment());

                $outPutData[0] = $send;
                $outPutData[1] = "Comment sended correctly!";
            } catch (Exception $ex) {
                $outPutData[0] = false;
                $errors[] = "Error! Comment can't be send";
                $outPutData[1] = $errors;
            }        

            return $outPutData;
        }
        
        /**
            * @name modifyUser
            * @description Modifies a user into the DB
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function modifyUser()
        {
            $userObj = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();

            $user = new User();
            $date = date('Y-m-d H:i:s', strtotime($userObj->bornDate));
            $user->setAll($userObj->id, $userObj->name, $userObj->surnames, $userObj->email, $userObj->password, $userObj->phone, $date, $userObj->specialism, $userObj->professionId->id);
            UserDAO::update($user);

            $outPutData[0]= true;
            $outPutData[1]= $user->getSurnames();

            return $outPutData;
        }
        
        /**
            * @name deleteUser
            * @description Deletes a user into the DB
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function deleteUser()
        {
            $userObj = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();

            $user = new User();
            $user->setId($userObj->id);
            UserDAO::delete($user);

            $outPutData[0]= true;
            $outPutData[1]= $user->getSurnames();

            return $outPutData;
        }
        
        /**
            * @name passwordRecovery
            * @description Sends a email to the user with its new password
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $outPutData Result data
        */
        private function passwordRecovery() {
            try{
                $userObj = json_decode(stripslashes($this->getJsonData()));

                $outPutData = array();
                $errors = array();
                $outPutData[0] = true;

                $user = new User();
                $user->setEmail($userObj->email);

                $userList = UserDAO::findByEmail($user);

                if (count($userList) == 0) {
                    $outPutData[0] = false;
                    $errors[] = "No user found with this email.";
                    $outPutData[1] = $errors;
                } else {  
                        
                    foreach ($userList as $user) {
                        $newPassword = $this->generateRandomString();
                        $user->setPassword($newPassword);

                        $to = $user->getEmail();
                        $subject = $user->getName();
                        $send = mail($to, $subject, $newPassword);
                        
                        UserDAO::updatePassword($user);

                    }  

                    $outPutData[0] = $send;
                    $outPutData[1] = "New password updated and sended correctly to the email!";
                     
                }
            } catch (Exception $ex) {
                $outPutData[0] = false;
                $errors[] = "Inernal error! Password can't be updated and sended, try again later.";
                $outPutData[1] = $errors;
            } 
            return $outPutData;
        }
        
        /**
            * @name generateRandomString
            * @description Generates a random string
            * @date 2017-05-11
            * @author Joan Fernández
            * @version 1.0
            * @params none
            * @return $randomString Generated random string
        */
        private function generateRandomString() {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }
?>
