<?php
    require_once 'model/persist/ProjectDAO.php';
/**
 * Main controller
 * @name MainController.php
 * @author Jonathan Lozano
 * @date 2017-02-23
 * @version 1.0
 */
class MainController {

    /**
     * The model that gives data services
     * @var ArticleModel
     */
    private $model;

    function __construct() {
        //$this->processRequest();
    }

    //put your code here
    public function processRequest() {
        $action = "";
        //retrieve action from client.
        if (filter_has_var(INPUT_GET, 'action')) {
            $action = filter_input(INPUT_GET, 'action');
        }

        switch ($action) {
            case 'login':
                $this->login();
                break;
            case 'loginUser':
                $this->loginUser();
                break;
            case 'register':
                $this->register(); //list all articles
                break;
            case 'search':
                $this->search(); //show a form for an article
                break;
            case 'searchList':
                $this->searchList();
                break;
            case 'manageProjects':
                $this->manageProjects();
                break;
            case 'newProject':
                $this->newProject();
                break;
            case 'addProject':
                $this->addProject();
                break;
            default :
                break;
        }
    }

    /**
     * Method to show login view
     * @name login
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    public function login() {
        //TODO
        include 'views/login.php';
    }
    
    /**
     * Method to show login view
     * @name login
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    public function loginUser() {
        //TODO
        session.start();
    }

    /**
     * Method to show register view
     * @name login
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    public function register() {

        include 'views/register.php';
    }

    /**
     * Method to show form to search professionals in our DDBB
     * @name login
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    public function search() {
        include 'views/search-form.php';
    }

    /**
     * Method to show professionals found in our DDBB
     * @name searchList
     * @author Jonathan Lozano
     * @date 2017-02-23
     * @version 1.0
     */
    public function searchList() {
        include 'views/search-list.php';
    }

    /**
     * Method to show manage projects view
     * @name manageProjects
     * @author Jonathan Lozano
     * @date 2017-03-16
     * @version 1.0
     */
    public function manageProjects() {
        $projectDAO = new ProjectDAO();
        $projects = $projectDAO->findAll();
        include 'views/manage-projects.php';
    }

    /**
     * adds the article sent by article form to data source
     */
    public function newProject() {
        include 'views/new-project.php';        
    }
    
    /**
     * adds the article sent by article form to data source
     */
    public function addProject() {        
        $this->manageProjects();
        echo "<div class='alert alert-success'><strong>Success!</strong> Project added correctly.</div>";
    }
}
