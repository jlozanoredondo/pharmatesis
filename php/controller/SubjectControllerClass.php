<?php    
    /**
    * @name SubjectControllerClass
    * Controller to connect the subjcet client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
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
                case 10020:
                    $outPutData = $this->loadSubject();
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

        /**
        * @name subjectConnection
        * Method to load subjects from DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with subjects found
        */
        private function subjectConnection() {
            $subjectObj = json_decode(stripslashes($this->getJsonData()));

            $subject = new Subject();
            
            $subjectId = $subjectObj->userId;


            $subject->setAll(0, 0, 0, 0, 0, 0, 0, 0, 0, 0,$subjectId);

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $subjectList = SubjectDAO::findAllUser($subject);

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

        /**
        * @name addSubject
        * Method to add subject in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with new subject added
        */
        private function addSubject(){
            $subjectObj = json_decode(stripslashes($this->getJsonData()));

            $subject = new Subject();
            $country = $subjectObj->country;
            $countryId = $country->id;
            $user = $subjectObj->user;
            $userId = $user->id;

            $date = date( 'Y-m-d H:i:s', strtotime($subjectObj->bornDate) );

            $subject->setAll(0, $date, $subjectObj->gender, $subjectObj->breed, $subjectObj->nick, $subjectObj->bloodType, $subjectObj->status, $subjectObj->height, $subjectObj->weight, $countryId,$userId);

            $subject->setId(SubjectDAO::create($subject));
            
            $outPutData = array();
            $outPutData[]= true;
            $outPutData[1]=$subject->getAll();

            return $outPutData;           
        }

        /**
        * @name loadSubject
        * Method to load a selected subject from DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with subject found
        */
        private function loadSubject(){
            $subjectObj = json_decode(stripslashes($this->getJsonData()));

            $subject = new Subject();
            
            $subjectId = $subjectObj->id;


            $subject->setAll($subjectId, 0, 0, 0, 0, 0, 0, 0, 0, 0,0);

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $subjectList = SubjectDAO::findById($subject);

            if (count($subjectList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No subject was found with these data.";
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
    }
?>
