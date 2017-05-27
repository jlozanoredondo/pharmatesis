<?php    
    /**
    * Controller to connect the user client data with the server
    * @name DispenseControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-04-27
    * @version 1.0
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
