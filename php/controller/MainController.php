<?php
	/**
    * @name MainController
    * Controller to manage controllers in server.
    * @date 2017-05-10
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    
	require_once "UserControllerClass.php";
	require_once "ProjectControllerClass.php";
	require_once "DiseaseControllerClass.php";
	require_once "DispenseControllerClass.php";
	require_once "SubjectControllerClass.php";
	require_once "SessionControllerClass.php";
	require_once "PhaseControllerClass.php";
	require_once "CountryControllerClass.php";
	require_once "MedicamentControllerClass.php";
	require_once "PreinscriptionControllerClass.php";
	require_once "EndureControllerClass.php";
	require_once "ProfessionControllerClass.php";
	
	/**
    * @name is_session_started
    * Method to check the session status and start's it.
    * @date 2017-05-10
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return session info or false
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


	$outPutData = array();

	if (isset($_REQUEST['controllerType'])) {
	    $action = (int) $_REQUEST['controllerType'];
	    switch ($action) {
	        case 0:
	            $userController = new UserControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $userController->doAction();
	            break;
	        case 1:
	            $projectController = new ProjectControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $projectController->doAction();
	            break;
	        case 2:
	            $diseaseController = new DiseaseControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $diseaseController->doAction();
	            break;
	        case 3:
	            $dispenseController = new DispenseControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $dispenseController->doAction();
	            break;
	        case 4:
	            $subjectController = new SubjectControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $subjectController->doAction();
	            break;
	        case 5:
	            $sessionController = new SessionControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $sessionController->doAction();
	            break;
	        case 6:
	            $phaseController = new PhaseControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $phaseController->doAction();
	            break;
	        case 7:
	            $countryController = new CountryControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $countryController->doAction();
	            break;
	        case 8:
	            $medicamentController = new MedicamentControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $medicamentController->doAction();
	            break;
	        case 9:
	            $preinscriptionController = new PreinscriptionControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $preinscriptionController->doAction();
	            break;
	        case 10:
	            $endureController = new EndureControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $endureController->doAction();
	            break;
            case 11:
	            $professionController = new ProfessionControllerClass($_REQUEST['action'], $_REQUEST['jsonData']);
	            $outPutData = $professionController->doAction();
            	break;
	        default:
	            $errors = array();
	            $outPutData[0] = false;
	            $errors[] = "Sorry, there has been an error. Try again later.";
	            $outPutData[] = $errors;
	            error_log("MainControllerClass: action not correct, value: " . $_REQUEST['controllerType']);
	            break;
	    }
	} else {
	    $errors = array();
	    $outPutData[0] = false;
	    $errors[] = "Sorry, there has been an error. Try again later.";
	    error_log("MainControllerClass: action does not exist.");
	    $outPutData[] = $errors;
	}

	echo json_encode($outPutData);
?>
