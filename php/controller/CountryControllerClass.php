<?php    
    /**
    * Controller to connect the phase client data with the server
    * @name phaseControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-05-15
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Country.php";
    require_once "../model/persist/CountryDAO.php";

    class CountryControllerClass implements ControllerInterface {

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
                    $outPutData = $this->countryConnection();
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

        private function countryConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $countryList = CountryDAO::findAll();

            if (count($countryList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No phases was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $countriesArray = array();

                foreach ($countryList as $country) {
                    $countriesArray[] = $country->getAll();
                }

                $outPutData[1] = $countriesArray;
            }
            
            return $outPutData;
        }           
    }
?>
