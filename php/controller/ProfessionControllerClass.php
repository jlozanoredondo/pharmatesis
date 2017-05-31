<?php

/**
    * @name CountryControllerClass
    * Controller to connect the country client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
require_once "ControllerInterface.php";
require_once "../model/Profession.php";
require_once "../model/persist/ProfessionDAO.php";

class ProfessionControllerClass implements ControllerInterface {

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
                $outPutData = $this->loadProfessions();
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
    * @name loadProfessions
    * Method to load professions found in DDBB
    * @date 2017-05-15
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with professions found
    */
    private function loadProfessions() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();

        $listProfessions = ProfessionDAO::findAll();


        if (count($listProfessions) == 0) {
            $outPutData[0] = false;
            $errors[] = "No professions found in database";
        } else {
            $professionsArray = array();

            foreach ($listProfessions as $profession) {
                $professionsArray[] = $profession->getAll();
            }
        }


        if ($outPutData[0]) {
            $outPutData[] = $professionsArray;
        } else {
            $outPutData[] = $errors;
        }

        return $outPutData;
    }
}

?>
