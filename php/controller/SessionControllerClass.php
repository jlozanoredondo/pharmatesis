<?php    
    /**
    * Controller to connect the session client data with the server
    * @name sessionControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-05-15
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Session.php";
    require_once "../model/persist/SessionDAO.php";

    class SessionControllerClass implements ControllerInterface {

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
                    $outPutData = $this->sessionConnection();
                    break;                              
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in sessionControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        private function sessionConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $sessionList = SessionDAO::findAll();

            if (count($sessionList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No sessions was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $sessionsArray = array();

                foreach ($sessionList as $session) {
                    $sessionsArray[] = $session->getAll();
                }

                $outPutData[1] = $sessionsArray;
            }
            
            return $outPutData;
        }           
    }
?>
