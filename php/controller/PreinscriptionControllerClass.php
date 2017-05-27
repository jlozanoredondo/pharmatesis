<?php    
    /**
    * Controller to connect the project client data with the server
    * @name PreinscriptionControllerClass.php
    * @author Jonathan Lozano
    * @date 2017-05-15
    * @version 1.0
    */
    require_once "ControllerInterface.php";
    require_once "../model/Preinscription.php";
    require_once "../model/persist/PreinscriptionDAO.php";

    class PreinscriptionControllerClass implements ControllerInterface {

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
                    $outPutData = $this->addPreinscription();
                    break;               
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in PreinscriptionControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        private function addPreinscription() {
            $preinscriptionObj = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;
            $preinscriptionArray = array();

            foreach ($preinscriptionObj as $preinscription) {
                $s = $preinscription->subject;
                $s = $s->id;
                $m = $preinscription->medicament;
                $m = $m->id;
                $p = new Preinscription();
                $p->setAll(0,$s,$m);
                $p->setId(PreinscriptionDAO::create($p));
                $preinscriptionArray[]=$p->getAll();
            }           

            $outPutData[]=$preinscriptionArray;
            
            return $outPutData;
        } 
   
    }
?>
