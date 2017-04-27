<?php    
    /**
    * Controller to connect the user client data with the server
    * @name UserControllerClass.php
    * @author Joan Fernández
    * @date 2017-04-27
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/User.php";
    require_once "../model/persist/UserDAO.php";

    class UserControllerClass implements ControllerInterface {

        //Atributtes
        private $action;
        private $jsonData;

        //Constructor
        function __construct($action, $jsonData) {
            $this->setAction($action);
            $this->setJsonData($jsonData);
        }

        //Getters & Setters
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

        //Own methods
        /** Controlls the action sended by the client
        * @name doAction()
        * @author Joan Fernández
        * @date 2017-02-23
        * @version 1.0
        * @param none
        * @return $outPutData formated data
        */
        public function doAction() {
            $outPutData = array();

            switch ($this->getAction()) {
                case 10000:
                    //User login
                    $outPutData = $this->userConnection();
                    break;
                case 10010:
                    //User registration
                    $outPutData = $this->entryUser();
                    break;
                case 10020:
                    //Modify user data
                    if (isset($_SESSION['connectedUser'])) {
                        $outPutData = $this->modifyUser();
                    }
                    break;
                case 10030:
                    //Session creation
                    $outPutData = $this->sessionControl();
                    break;
                case 10040:
                    //Logout
                    session_unset();
                    session_destroy();
                    $outPutData[0] = true;
                    break;
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try later";
                    $outPutData[] = $errors;
                    error_log("Action not correct in UserControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        /** Controlls the action sended by the client
        * @name entryUser()
        * @author Joan Fernández
        * @date 2017-02-23
        * @version 1.0
        * @param none
        * @return $outPutData informative data
        */
        private function entryUser() {
            $userObj = json_decode(stripslashes($this->getJsonData()));
            
            //User declaration
            $user = new User($userObj->id, $userObj->name, $userObj->password, $userObj->surnames, $userObj->email, $userObj->phone, $userObj->bornDate, $userObj->specialism, $userObj->professionId, $userObj->image);

            $outPutData = array();
            $outPutData[] = true;
            
            //1 if succes 0 if no
            $outPutData[] = UserDAO::insertUser($user);

            return $outPutData;
        }

        private function modifyUser() {
            //Films modification
            $usersArray = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();
            $outPutData[] = true;

            foreach ($usersArray as $userObj) {
                $user = new User($userObj->id, $userObj->name, $userObj->password, $userObj->surnames, $userObj->email, $userObj->phone, $userObj->bornDate, $userObj->specialism, $userObj->professionId, $userObj->image);                
                UserADO::modifyUser($user);
            }

            return $outPutData;
        }

        private function userConnection() {
            
            $userObj = json_decode(stripslashes($this->getJsonData()));

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $user = new User();
            $user->setNick($userObj->email);
            $user->setPassword($userObj->password);

            $userList = UserDAO::findUser($user);

            if (count($userList) == 0) {
                $outPutData[0] = false;
                $errors[] = "Error. No user found with this email/password.";
                $outPutData[1] = $errors;
            } else {
                $usersArray = array();

                foreach ($userList as $user) {
                    $usersArray[] = $user;
                }

                $_SESSION['connectedUser'] = $userList[0];

                $outPutData[1] = $usersArray;
            }

            return $outPutData;
        }

        private function sessionControl() {
            $outPutData = array();
            $outPutData[] = true;

            if (isset($_SESSION['connectedUser'])) {
                $outPutData[] = $_SESSION['connectedUser'];
            } else {
                $outPutData[0] = false;
                $errors[] = "No session opened";
                $outPutData[1] = $errors;
            }

            return $outPutData;
        }
    }
?>
