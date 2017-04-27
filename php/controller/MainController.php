<?php
    /**
    * Main controller to connect the client data with the server
    * @name MainController.php
    * @author Joan Fernández
    * @date 2017-04-27
    * @version 1.0
    */

    require_once "UserControllerClass.php";
    require_once "FileControllerClass.php";

    /** Controlls that the session is started
    * @name is_session_started()
    * @author Joan Fernández
    * @date 2017-02-23
    * @version 1.0
    * @param none
    * @return true or false
    */
    function is_session_started() {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }

    if (is_session_started() === FALSE)
        session_start();

    //Return data declaration
    $outPutData = array();

    //Switch case to controll the client petitions
    if (isset($_REQUEST['controllerType'])) 
    {
        $action = (int) $_REQUEST['controllerType'];
        switch ($action) {
            case 0:
                //User controller
                $userController = new UserControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
                $outPutData = $userController->doAction();
                break;
            case 1:
                //File controller
                $fileController = new FileControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
                $outPutData = $fileController->doAction();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "There has been an error in the server. Contact with system admin.";
                $outPutData[] = $errors;
                //Apache error.log instance
                error_log("MainControllerClass: action not correct, value: " . $_REQUEST['controllerType']);
                break;
        }
    } 
    else 
    {
        $errors = array();
        $outPutData[0] = false;
        $errors[] = "There has been an error in the server. Contact with system admin.";
        error_log("MainControllerClass: action does not exist");
        $outPutData[] = $errors;
    }

    echo json_encode($outPutData);
?>
