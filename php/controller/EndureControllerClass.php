<?php    
    /**
    * @name EndureControllerClass
    * Controller to connect the endure client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    require_once "ControllerInterface.php";
    require_once "../model/Endure.php";
    require_once "../model/persist/EndureDAO.php";

    class EndureControllerClass implements ControllerInterface {

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
                    $outPutData = $this->addEndure();
                    break;               
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in EndureControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        /**
        * @name addEndure
        * Method to add endure to DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with endure inserted
        */
        private function addEndure() {
            $endureObj = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;
            $endureArray = array();

            foreach ($endureObj as $endure) {
                $s = $endure->subject;
                $s = $s->id;
                $d = $endure->disease;
                $d = $d->id;
                $e = new Endure();
                $e->setAll(0,$s,$d);
                $e->setId(EndureDAO::create($e));
                $endureArray[]=$e->getAll();
            }           

            $outPutData[]=$endureArray;
            
            return $outPutData;
        } 

    }
?>
