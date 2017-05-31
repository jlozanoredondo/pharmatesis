<?php    
    /**
    * @name DiseaseControllerClass
    * Controller to connect the disease client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    require_once "ControllerInterface.php";
    require_once "../model/Disease.php";
    require_once "../model/persist/DiseaseDAO.php";

    class DiseaseControllerClass implements ControllerInterface {

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
                    $outPutData = $this->diseaseConnection();
                    break;                
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in DiseaseControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        /**
        * @name diseaseConnection
        * Method to load diseases found in DDBB
        * @date 2017-05-11
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with diseases found
        */
        private function diseaseConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $diseaseList = DiseaseDAO::findAll();

            if (count($diseaseList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No projects was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $diseaseArray = array();

                foreach ($diseaseList as $disesase) {
                    $diseaseArray[] = $disesase->getAll();
                }

                $outPutData[1] = $diseaseArray;
            }
            
            return $outPutData;
        }        
    }
?>
