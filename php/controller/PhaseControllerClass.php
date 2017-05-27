<?php    
    /**
    * Controller to connect the phase client data with the server
    * @name phaseControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-05-15
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Phase.php";
    require_once "../model/persist/PhaseDAO.php";

    class PhaseControllerClass implements ControllerInterface {

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
                    $outPutData = $this->phaseConnection();
                    break;                              
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in phaseControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        private function phaseConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $phaseList = PhaseDAO::findAll();

            if (count($phaseList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No phases was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $phasesArray = array();

                foreach ($phaseList as $phase) {
                    $phasesArray[] = $phase->getAll();
                }

                $outPutData[1] = $phasesArray;
            }
            
            return $outPutData;
        }           
    }
?>
