<?php    
    /**
    * Controller to connect the subject client data with the server
    * @name SubjectControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-04-27
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Subject.php";
    require_once "../model/persist/SubjectDAO.php";

    class SubjectControllerClass implements ControllerInterface {

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
                    $outPutData = $this->subjectConnection();
                    break;     
                case 10010:
                    $outPutData = $this->addSubject();
                    break;                               
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in SubjectControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        private function subjectConnection() {
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $subjectList = SubjectDAO::findAll();

            if (count($subjectList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No subjects was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $subjectsArray = array();

                foreach ($subjectList as $subject) {
                    $subjectsArray[] = $subject->getAll();
                }

                $outPutData[1] = $subjectsArray;
            }
            
            return $outPutData;
        }

        private function addSubject(){
            $subjectObj = json_decode(stripslashes($this->getJsonData()));

            $subject = new Subject();
            $country = $subjectObj->country;
            $countryId = $country->id;

            $date = date( 'Y-m-d H:i:s', strtotime($subjectObj->bornDate) );

            $subject->setAll(0, $date, $subjectObj->gender, $subjectObj->breed, $subjectObj->nick, $subjectObj->bloodType, $subjectObj->status, $countryId);

            $subject->setId(SubjectDAO::create($subject));
            
            $outPutData = array();
            $outPutData[]= true;
            $outPutData[1]=$subject->getAll();

            return $outPutData;           
        }

    }
?>
