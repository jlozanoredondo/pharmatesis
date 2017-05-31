<?php    
    /**
    * @name SessionControllerClass
    * Controller to connect the sessions client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
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
                case 10010:
                    $outPutData = $this->closeSession();
                    break;   
                case 10020:
                    $outPutData = $this->addSession();
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

        /**
        * @name sessionConnection
        * Method to load sessions from DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with sessions found
        */
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

        /**
        * @name closeSession
        * Method to close session in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with info from session closed
        */
        private function closeSession(){
            $dispenseObject = json_decode(stripslashes($this->getJsonData()));
            
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $session = new Session();
            $session = $dispenseObject->session;
            $sessionId = $session->id;

            $sessionClose = new Session();
            $sessionClose->setAll($sessionId,0,0,0);

            SessionDAO::closeSession($sessionClose);
            
            return $outPutData;
        } 

        /**
        * @name addSession
        * Method to add a new session in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with new session inserted
        */
        private function addSession(){
            $sessionObject = json_decode(stripslashes($this->getJsonData()));
            
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $sessionAdd = new Session();
            $name = $sessionObject->name;
            $sessionAdd->setAll(0,$name,date("Y-m-d H:i:s"),null);

            $sessionAdd->setId(SessionDAO::create($sessionAdd));            
            $outPutData[1]=$sessionAdd->getAll();
            
            return $outPutData;
        }           
    }
?>
