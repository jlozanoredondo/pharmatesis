<?php

/**
 * Controller to connect the user client data with the server
 * @name UserControllerClass.php
 * @author Joan Fernández
 * @date 2017-04-27
 * @version 1.0
 */
require_once "ControllerInterface.php";
require_once "../model/User.php";
require_once "../model/persist/UserDAO.php";

class UserControllerClass implements ControllerInterface {

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
                $outPutData = $this->userConnection();
                break;
            /* case 10020:
              if (isset($_SESSION['connectedUser'])) {
              $outPutData = $this->modifyUser();
              }
              break; */
            case 10030:
                $outPutData = $this->sessionControl();
                break;
            case 10040:
                //Closing session
                session_unset();
                session_destroy();
                $outPutData[0] = true;
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

    private function userConnection() {
        $userObj = json_decode(stripslashes($this->getJsonData()));

        $outPutData = array();
        $errors = array();
        $outPutData[0] = true;

        $user = new User();
        $user->setEmail($userObj->email);
        $user->setPassword($userObj->password);

        $userList = UserDAO::findByEmailAndPass($user);

        if (count($userList) == 0) {
            $outPutData[0] = false;
            $errors[] = "No user was found with these data.";
            $outPutData[1] = $errors;
        } else {
            $usersArray = array();

            foreach ($userList as $user) {
                $usersArray[] = $user->getAll();
            }

            $_SESSION['connectedUser'] = $userList[0];

            $outPutData[1] = $usersArray;
        }

        return $outPutData;
    }

    private function sessionControl() {
        $outPutData = array();
        $outPutData[] = true;

        if (isset($_SESSION['connectedUser'])) {
            $outPutData[] = $_SESSION['connectedUser']->getAll();
        } else {
            $outPutData[0] = false;
            $errors[] = "No session opened!";
            $outPutData[1] = $errors;
        }

        return $outPutData;
    }

}

?>
