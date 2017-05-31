<?php    
    /**
    * @name DispenseControllerClass
    * Controller to connect the dispense client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    require_once "ControllerInterface.php";
    require_once "../model/Dispense.php";
    require_once "../model/persist/DispenseDAO.php";

    class DispenseControllerClass implements ControllerInterface {

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
                    $outPutData = $this->dispenseConnection();
                    break;  
                case 10010:
                    $outPutData = $this->addDispense();
                    break;   
                case 10020:
                    $outPutData = $this->updateDispense();
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
        * @name dispenseConnection
        * Method to load dispenses found in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with dispenses found
        */
        private function dispenseConnection() {

            $dispenseObj = json_decode(stripslashes($this->getJsonData()));
            
            $dispense = new Dispense();
            $project = new Project();
            $project = $dispenseObj->project;

            $projectId = $project->id;

            $dispense->setProjectId($projectId);

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $dispenseList = DispenseDAO::findByProjectId($dispense);

            if (count($dispenseList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No dispenses was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $dispensesArray = array();

                foreach ($dispenseList as $dispense) {
                    $dispensesArray[] = $dispense->getAll();
                }

                $outPutData[1] = $dispensesArray;
            }
            
            return $outPutData;
        } 

        /**
        * @name addDispense
        * Method to add dispenses to DDBB
        * @date 2017-05-16
        * @author Jonathan Lozano
        * @version 2.0
        * @params none
        * @return $outPutData. Array with dispenses object inserted
        */
        private function addDispense() {
            $dispenseObj = json_decode(stripslashes($this->getJsonData()));

            $project = new Project();
            $project = $dispenseObj->project;
            $projectId = $project->id;
            
            $subject = new Subject();
            $subject = $dispenseObj->subject;
            $subjectId = $subject->id;

            $phase = new Phase();
            $phase = $dispenseObj->phase;
            $phaseId = $phase->id;
            
            $session = new Session();
            $session = $dispenseObj->session;
            $sessionId = $session->id;

            $dispense = new Dispense();

            $dispense->setAll(0, $projectId, $subjectId, $phaseId, $sessionId, $dispenseObj->viability, $dispenseObj->sideEffects, floatval($dispenseObj->dose), $dispenseObj->reaction);

            $dispense->setId(DispenseDAO::create($dispense));
            
            $outPutData = array();
            $outPutData[]= true;
            $outPutData[1]=$dispense->getAll();

            return $outPutData;
        } 

        /**
        * @name updateDispense
        * Method to update dispenses in DDBB
        * @date 2017-05-17
        * @author Jonathan Lozano
        * @version 2.0
        * @params none
        * @return $outPutData. Array with dispenses object updated
        */
        private function updateDispense() {
            $dispenseObj = json_decode(stripslashes($this->getJsonData()));

            $project = new Project();
            $project = $dispenseObj->project;
            $projectId = $project->id;
            
            $subject = new Subject();
            $subject = $dispenseObj->subject;
            $subjectId = $subject->id;

            $phase = new Phase();
            $phase = $dispenseObj->phase;
            $phaseId = $phase->id;
            
            $session = new Session();
            $session = $dispenseObj->session;
            $sessionId = $session->id;

            $dispense = new Dispense();

            $dispense->setAll(0, $projectId, $subjectId, $phaseId, $sessionId, 0, 0, 0, 0);

            $dispenseFound = DispenseDAO::findUpdate($dispense);
            $dispenseUpdate = new Dispense();

            foreach ($dispenseFound as $dispense) {                    
                    $dispenseUpdate->setAll($dispense->getId(), 0, 0, 0, 0, $dispenseObj->viability, $dispenseObj->sideEffects, floatval($dispenseObj->dose), $dispenseObj->reaction);
        
                    $dispenseUpdate->setId(DispenseDAO::update($dispenseUpdate));
            }

            
            $outPutData = array();
            $outPutData[]= true;
            $outPutData[1]=$dispenseUpdate->getAll();

            return $outPutData;
        } 
    }
?>
