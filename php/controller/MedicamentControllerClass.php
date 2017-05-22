<?php    
    /**
    * Controller to connect the phase client data with the server
    * @name phaseControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-05-15
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Medicament.php";
    require_once "../model/persist/MedicamentDAO.php";

    class MedicamentControllerClass implements ControllerInterface {

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
                    $outPutData = $this->medicamentConnection();
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

        private function medicamentConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $phaseList = MedicamentDAO::findAll();

            if (count($phaseList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No medicaments was found with these data.";
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
