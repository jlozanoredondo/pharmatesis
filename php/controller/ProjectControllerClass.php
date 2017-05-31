<?php    
    /**
    * @name ProjectControllerClass
    * Controller to connect the project client data with the server
    * @date 2017-05-11
    * @author Jonathan Lozano
    * @version 1.0
    * @params none
    * @return $outPutData. Array with method return found
    */
    require_once "ControllerInterface.php";
    require_once "../model/Project.php";
    require_once "../model/persist/ProjectDAO.php";

    class ProjectControllerClass implements ControllerInterface {

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
                    $outPutData = $this->projectConnection();
                    break;  
                case 10010:
                    $outPutData = $this->addProject();
                    break;   
                case 10020:
                    $outPutData = $this->deleteProject();
                    break;                 
                case 10030:
                    $outPutData = $this->closeProject();
                    break;                  
                case 10040:
                    $outPutData = $this->findProject();
                    break;                
                default:
                    $errors = array();
                    $outPutData[0] = false;
                    $errors[] = "Sorry, there has been an error. Try again later.";
                    $outPutData[] = $errors;
                    error_log("Action not correct in ProjectControllerClass, value: " . $this->getAction());
                    break;
            }

            return $outPutData;
        }

        /**
        * @name projectConnection
        * Method to load projects found in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with projects found
        */
        private function projectConnection() {
            $projectObj = json_decode(stripslashes($this->getJsonData()));

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $project = new Project(0,$projectObj->userId,0,0,0,0);

            $projectList = ProjectDAO::findAllUser($project);

            if (count($projectList) == 0) {
                $outPutData[0] = false;
                $errors[] = "No projects was found with these data.";
                $outPutData[1] = $errors;
            } else {
                $projectsArray = array();

                foreach ($projectList as $project) {
                    $projectsArray[] = $project->getAll();
                }

                $outPutData[1] = $projectsArray;
            }
            
            return $outPutData;
        }

        /**
        * @name findProject
        * Method to load projects found in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with projects found
        */
        private function findProject() {
            $projectObj = json_decode(stripslashes($this->getJsonData()));

            $outPutData = array();
            $errors = array();
            $outPutData[0] = true;

            $project = new Project($projectObj->id,0,0,0,0,0);

            $projectList = ProjectDAO::findProjectId($project);

            if (count($projectList) == 0) {
                $outPutData[0] = false;
                $errors[] = "Project wasn't found with these data.";
                $outPutData[1] = $errors;
            } else {
                $projectsArray = array();

                foreach ($projectList as $project) {
                    $projectsArray[] = $project->getAll();
                }

                $outPutData[1] = $projectsArray;
            }
            
            return $outPutData;
        } 



        /**
        * @name addProject
        * Method to add project to DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with project added
        */
        private function addProject(){
            $projectObj = json_decode(stripslashes($this->getJsonData()));

            $date = date("Y-m-d");

            $project = new Project();
            $disease = $projectObj->disease;
            $diseaseId = $disease->id;

            $project->setAll(0, $projectObj->userId, $projectObj->name,$date, $projectObj->testedDrug, $diseaseId);

            $project->setId(ProjectDAO::create($project));
            
            $outPutData = array();
            $outPutData[]= true;
            $outPutData[1]=$project->getAll();

            return $outPutData;
        }   

        /**
        * @name deleteProject
        * Method to delete project in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with status project deleted
        */
        private function deleteProject() {
            $projectArray = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();
            $outPutData[]= true;

            foreach($projectArray as $projectObj) {
                $project = new Project();
                $project->setId($projectObj->id);
                ProjectDAO::delete($project);
            }

            return $outPutData;
        }   

        /**
        * @name closeProject
        * Method to delete project in DDBB
        * @date 2017-05-15
        * @author Jonathan Lozano
        * @version 1.0
        * @params none
        * @return $outPutData. Array with status project deleted
        */
        private function closeProject() {
            $projectArray = json_decode(stripslashes($this->getJsonData()));
            $outPutData = array();
            $outPutData[]= true;

            foreach($projectArray as $projectObj) {
                $project = new Project();
                $date = date("Y-m-d");
                $project->setId($projectObj->id);
                $project->setEndDate($date);
                ProjectDAO::close($project);
                $outPutData[1]=$project->getAll();
            }

            return $outPutData;
        }  
    }
?>
