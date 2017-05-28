//Angular code

(function () {
    //Application module
    angular.module('pharmatesisApp').controller("ProjectController", ['$http', '$scope', '$window', '$cookies', 'accessService', '$filter', function ($http, $scope, $window, $cookies, accessService, $filter) {
            
            //variable for session storage
            var userConnected = JSON.parse(sessionStorage.getItem("userConnected"));
            
            //Statistics variables
            $scope.subjectsCountProject = 0;
            $scope.barplotSubjectsSideEffectsProject = "";
            $scope.barplotSubjectsGenderProject = "";
            $scope.barplotSubjectsBreedProject = "";
            $scope.barplotSubjectsBloodTypeProject = "";
            $scope.boxPlotSubjectHeight = "";
            $scope.boxPlotSubjectWeight = "";
            $scope.barplotSubjectsReactionProject = "";
            $scope.boxPlotProjectDose = "";
            $scope.boxPlotYear = "";
            $scope.boxPlotCorrelationWeightDose = "";
            $scope.boxPlotCorrelationHeightDose = "";
            $scope.subjectboxPlotSubjectDose = "";
            $scope.barplotSessionSideEffectsSession = "";
            $scope.boxPlotSessionHeight = "";
            $scope.barplotPhaseSideEffects = "";
            $scope.boxPlotPhaseHeight = "";
            $scope.boxPlotPhaseWeight = "";
            $scope.barplotSubjectsViabilityPhase = "";
            $scope.barplotSubjectsReactionPhase = "";
            $scope.boxPlotPhaseDose = "";


            //Scope variables
            $scope.projectsArray = new Array();
            $scope.diseaseArray = new Array();
            $scope.dispenseArray = new Array();
            $scope.subjectArray = new Array();
            $scope.subjectsProjectArray = new Array();
            $scope.subjectsAddProject = new Array();
            $scope.sessionArray = new Array();
            $scope.sessionProjectArray = new Array();
            $scope.phaseArray = new Array();
            $scope.phaseProjectArray = new Array();
            $scope.countryArray = new Array();
            $scope.medicamentArray = new Array();
            $scope.preinscriptionArray = new Array();
            $scope.endureArray = new Array();
            $scope.statusArray = ["Single","Married","Divorced","Widowed"];
            $scope.viabilityArray = ["Oral","Topical","Intravenously"];
            $scope.bloodTypeArray = ["A","B","AB","0"];
            $scope.newSubject = new Subject();
            $scope.selectSubject = new Subject();
            $scope.infoSubject = new Subject();
            $scope.infoSession = new Session();
            $scope.infoPhase = new Phase();
            $scope.newSession = new Session();
            $scope.project = new Project();
            $scope.infoProject = new Project();
            $scope.dispense = new Dispense();

            $scope.project.setUserId(userConnected.id); //Set User Id from project scope

            $scope.msg=0;
            $scope.info=0;
            $scope.infoShow=0;
            $scope.newSubjectDDBB=0;
            $scope.showSubject=0;

            //DATEPICKER ANGULARJS
            //Scope variables for datepicker
            $scope.formats = ['dd-MMMM-yyyy', 'yyyy-MM-dd', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
            $scope.format = $scope.formats[1];
            $scope.maxDateBornDate = new Date();
            $scope.minDateBornDate = new Date();
            $scope.minDateBornDate.setFullYear($scope.minDateBornDate.getFullYear() - 100);             
            $scope.maxDateBornDate.setFullYear($scope.maxDateBornDate.getFullYear() - 18)

            //Scope variable for date options
            $scope.bornDateOptions = {
                formatYear: 'yyyy',
                initDate:  $scope.maxDateBornDate,
                maxDate: $scope.maxDateBornDate, // Upper than 18
                minDate: $scope.minDateBornDate, // Lower than 100
                startingDay: 1
            };

            $scope.bornDate = {
                opened: false
            };

            $scope.openBornDate = function() {
                $scope.bornDate.opened = true;         
            };

            //Pagination variables
            $scope.pageSize = 10;
            $scope.currentPage = 1;

            //Scope watch for project name
            $scope.$watch("name",function () {
                $scope.filteredData = $filter('filter')($scope.projectsArray,{name:$scope.name});
            });

            /*
            * @name         loadProjects
            * @description  This method load the projects data for user logged in filteredData scope.
            * @date         2017-05-16
            * @author       Jonathan Lozano Redondo
            * @version      2.0
            * @params       none
            * @return       none
            */
            $scope.loadProjects = function(){
                $scope.project = angular.copy($scope.project);
                $scope.filteredData = [];
                $scope.projectsArray = [];
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 1, action: 10000, jsonData: JSON.stringify($scope.project)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {
                            var disease = new Disease();
                            disease.construct(outPutData[1][i].diseaseId);
                            var project = new Project();
                            project.construct(outPutData[1][i].id, outPutData[1][i].userId,outPutData[1][i].name, outPutData[1][i].initialDate,outPutData[1][i].endDate, outPutData[1][i].testedDrug, outPutData[1][i].endDate, disease);
                            $scope.projectsArray.push(project);
                        }
                        $scope.filteredData = $scope.projectsArray;
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later.");
                        }
                    }
                });
            }

            /*
            * @name         loadDisease
            * @description  This method load the diseases data to create new projects.
            * @date         2017-05-17
            * @author       Jonathan Lozano Redondo
            * @version      1.0
            * @params       none
            * @return       none
            */
            this.loadDisease = function(){
                $scope.diseaseArray = [];
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 2, action: 10000, jsonData: JSON.stringify("")});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {
                            var disease = new Disease();
                            disease.construct(outPutData[1][i].id, outPutData[1][i].name);
                            $scope.diseaseArray.push(disease);
                        }
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later.");
                        }
                    }
                });
            }

            /*
            * @name         addProject
            * @description  This method insert the project data to DDBB.
            * @date         2017-05-17
            * @author       Jonathan Lozano Redondo
            * @version      1.5
            * @params       none
            * @return       none
            */
            this.addProject = function(){
                $scope.project = angular.copy($scope.project);
                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:1,action:10010,jsonData:JSON.stringify($scope.project)}); 

                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {
                        $scope.msg=1;
                        $scope.loadProjects();
                    } else {
                        if(angular.isArray(outPutData[1])) {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later");
                        }
                    }
                });
                $scope.$parent.action=2;
            }

            
            /*
            * @name         loadProject
            * @description  This method load the project data selected and show it in template form.
            * @date         2017-05-18
            * @author       Jonathan Lozano Redondo
            * @version      1.0
            * @params       project: object project to manage.
            * @return       none
            */
            $scope.loadProject = function(project){
                //Clean scope variables
                $scope.user = angular.copy($scope.user);
                $scope.project = project;
                $scope.filteredData = [];
                $scope.subjectArray = [];
                $scope.sessionArray = [];
                $scope.sessionProjectArray = [];
                $scope.phaseArray = [];
                $scope.countryArray = [];
                $scope.medicamentArray = [];
                $scope.phaseProjectArray = [];
                $scope.dispenseArray = [];
                $scope.subjectsProjectArray = [];
                $scope.subjectsAddProject = [];

                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:5,action:10000,jsonData:JSON.stringify("")});

                //Load session array with DDBB session's
                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {
                        for (var i = 0; i < outPutData[1].length; i++) {
                        var session = new Session();
                            session.construct(outPutData[1][i].id, outPutData[1][i].name, outPutData[1][i].date, outPutData[1][i].endDate);
                            $scope.sessionArray.push(session);
                        }
                    }
                });

                //Load subject array with DDBB user's
                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:4,action:10000,jsonData:JSON.stringify($scope.user)});

                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var subject = new Subject();
                                subject.construct(outPutData[1][i].id, outPutData[1][i].bornDate, outPutData[1][i].gender, outPutData[1][i].breed, outPutData[1][i].nick, outPutData[1][i].bloodType, outPutData[1][i].status, outPutData[1][i].height, outPutData[1][i].weight, outPutData[1][i].countryId,1);
                                $scope.subjectArray.push(subject);
                            }
                        }
                    });

                    //Load country array with DDBB country's
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:7,action:10000,jsonData:JSON.stringify("")});

                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var country = new Country();
                                country.construct(outPutData[1][i].id, outPutData[1][i].name);
                                $scope.countryArray.push(country);
                            }
                        }
                    });

                    //Load medicament array with DDBB medicament's
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:8,action:10000,jsonData:JSON.stringify("")});

                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var medicament = new Medicament();
                                medicament.construct(outPutData[1][i].id, outPutData[1][i].name);
                                $scope.medicamentArray.push(medicament);
                            }
                        }
                    });

                    //Load phase array with DDBB phase's
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:6,action:10000,jsonData:JSON.stringify("")});

                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var phase = new Phase();
                                phase.construct(outPutData[1][i].id, outPutData[1][i].name);
                                $scope.phaseArray.push(phase);
                            }
                        }
                    });

                    //Load dispense array with DDBB dispense's from project selected
                    $scope.dispense.setProject(project);
                    $scope.dispense = angular.copy($scope.dispense);
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:3,action:10000,jsonData:JSON.stringify($scope.dispense)});
                
                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {                            

                            for (var i = 0; i < outPutData[1].length; i++) {
                            var dispense = new Dispense();
                                dispense.construct(outPutData[1][i].id, outPutData[1][i].projectId, outPutData[1][i].viability, outPutData[1][i].sideEffects, outPutData[1][i].dose, outPutData[1][i].reaction);


                                for(j=0;j<$scope.phaseArray.length;j++){
                                    if($scope.phaseArray[j].getId()==outPutData[1][i].phaseId){
                                        dispense.setPhase($scope.phaseArray[j]);
                                        $scope.dispense.setPhase($scope.phaseArray[j]);
                                        
                                    }                                       
                                }


                                for(var j=0;j<$scope.subjectArray.length;j++){
                                    if($scope.subjectArray[j].getId()==outPutData[1][i].subjectId){
                                        dispense.setSubject($scope.subjectArray[j]);
                                        if($scope.subjectsProjectArray.indexOf($scope.subjectArray[j])==-1){
                                        $scope.subjectsProjectArray.push($scope.subjectArray[j]);
                                        }
                                    }   
                                    $scope.dispense.setSubject($scope.subjectArray[j]);
                                }                                

                                
                                for(var j=0;j<$scope.sessionArray.length;j++){
                                    if($scope.sessionArray[j].getId()==outPutData[1][i].sessionId){
                                        dispense.setSession($scope.sessionArray[j]);
                                        $scope.dispense.setSession($scope.sessionArray[j]);
                                    }   
                                }
                                
                                $scope.dispenseArray.push(dispense);
                            }  
                            
                            for(var j=0;j<$scope.subjectArray.length;j++){
                                if($scope.subjectsProjectArray.indexOf($scope.subjectArray[j])==-1){
                                    $scope.newSubjectDDBB=1;
                                    $scope.subjectsAddProject.push($scope.subjectArray[j]);
                                }
                            }                 
                            $scope.filteredData = $scope.dispenseArray;
                        }else{ 
                            $('#newSession').modal('show');                           
                            $scope.dispense.setPhase($scope.phaseArray[0]);
                            
                            for(var j=0;j<$scope.subjectArray.length;j++){
                                if($scope.subjectsAddProject.indexOf($scope.subjectArray[j])==-1){
                                    $scope.newSubjectDDBB=1;
                                    $scope.subjectsAddProject.push($scope.subjectArray[j]);
                                }
                            }

                        }

                    });
                                    console.log($scope.$parent.action);
                    
                $scope.$parent.action=6;
            }

            /*
            * @name         addDispense
            * @description  This method add a dispense to DDBB
            * @date         2017-05-18
            * @author       Jonathan Lozano Redondo
            * @version      3.0
            * @params       none
            * @return       none
            */
            this.addDispense = function(){
                $scope.msg=0;

                //Add dispense to a new project
                if($scope.newSession.getName()!=undefined){
                    $scope.newSession = angular.copy($scope.newSession);
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:5,action:10020,jsonData:JSON.stringify($scope.newSession)}); 
                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {  

                            var session = new Session();
                            session.construct(outPutData[1].id, outPutData[1].name, outPutData[1].date, outPutData[1].endDate);
                            $scope.dispense.setSession(session);                        
                            
                            $scope.dispense = angular.copy($scope.dispense);
                            var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:3,action:10010,jsonData:JSON.stringify($scope.dispense)}); 

                            promise.then(function (outPutData) {
                                if(outPutData[0]=== true) {
                                    $scope.info=0;   
                                    $scope.msg=2;
                                    $scope.newSession = new Session();
                                    $scope.loadProject($scope.dispense.project);
                                }
                            });
                        } else {
                            if(angular.isArray(outPutData[1])) {
                                $scope.msg=8;
                            } else {
                                alert("There has been an error in the server, try again later");
                            }
                        }
                    });
                } else{
                    //Add dispense to a existed project
                    $scope.dispense = angular.copy($scope.dispense);
                    var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:3,action:10010,jsonData:JSON.stringify($scope.dispense)}); 

                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            $scope.msg=2;
                            $scope.loadProject($scope.dispense.project);
                        } else {
                            if(angular.isArray(outPutData[1])) {
                                alert(outPutData[1]);
                            } else {
                                //Update dispense with data introduced
                                if(confirm("This subject has a dispense for this session. Do you want to update this data?")){
                                    $scope.updateDispense();
                                }
                                
                            }
                        }
                    });
                }                             
            }

            /*
            * @name         updateDispense
            * @description  This method update a dispense from DDBB
            * @date         2017-05-18
            * @author       Jonathan Lozano Redondo
            * @version      1.0
            * @params       none
            * @return       none
            */
            $scope.updateDispense = function(){

                $scope.dispense = angular.copy($scope.dispense);
                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:3,action:10020,jsonData:JSON.stringify($scope.dispense)}); 

                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {                        
                        $scope.msg=3;
                        $("#manageProject")[0].reset();                        
                        $scope.loadProject($scope.dispense.project);
                    } else {
                        if(angular.isArray(outPutData[1])) {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later");
                        }
                    }
                });
            }

            /*
            * @name         addSubject
            * @description  This method add a new subject from this user in DDBB
            * @date         2017-05-15
            * @author       Jonathan Lozano Redondo
            * @version      2.0
            * @params       none
            * @return       none
            */
            this.addSubject = function(){
                $scope.newSubject.setUser($scope.user);
                $scope.newSubject = angular.copy($scope.newSubject);
                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:4,action:10010,jsonData:JSON.stringify($scope.newSubject)}); 
                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {  
                        var subject = new Subject();
                            subject.construct(outPutData[1].id, outPutData[1].bornDate, outPutData[1].gender, outPutData[1].breed, outPutData[1].nick, outPutData[1].bloodType, outPutData[1].status, outPutData[1].height, outPutData[1].weight, outPutData[1].countryId,outPutData[1].userId);
                        $scope.subjectsProjectArray.push(subject);
                        
                        for(var i=0; i<$scope.preinscriptionArray.length;i++){
                            $scope.preinscriptionArray[i].setSubject(subject);
                        }
                        $scope.preinscriptionArray = angular.copy($scope.preinscriptionArray);
                        
                        var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:9,action:10000,jsonData:JSON.stringify($scope.preinscriptionArray)}); 
                        promise.then(function (outPutData) {
                            if(outPutData[0]=== true) {  
                                for(var i=0; i<$scope.endureArray.length;i++){
                                    $scope.endureArray[i].setSubject(subject);
                                }
                                $scope.endureArray = angular.copy($scope.endureArray);

                                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:10,action:10000,jsonData:JSON.stringify($scope.endureArray)}); 
                                promise.then(function (outPutData) {
                                    if(outPutData[0]=== true) {
                                        $scope.dispense.setSubject(subject);  
                                        $('#newSubject').modal('hide');
                                        $scope.msg=4;
                                    }else {
                                        $scope.msg=5;
                                    }
                                });
                            }else {
                                if(angular.isArray(outPutData[1])) {
                                    alert(outPutData[1]);
                                } else {
                                    alert("There has been an error in the server, try again later");
                                }
                            }
                        });
                    } else {
                        if(angular.isArray(outPutData[1])) {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later");
                        }
                    }
                });
            }

            /*
            * @name         closeSession
            * @description  This method close session opened and show modal window to insert a new one
            * @date         2017-05-20
            * @author       Joan Fernandez Abelló
            * @version      1.0
            * @params       none
            * @return       none
            */
            this.closeSession = function(){
                $scope.dispense = angular.copy($scope.dispense);
                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:5,action:10010,jsonData:JSON.stringify($scope.dispense)}); 

                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {                        
                        $('#newSession').modal('show');
                    } else {
                        if(angular.isArray(outPutData[1])) {
                            $scope.msg=7;
                        } else {
                            alert("There has been an error in the server, try again later");
                        }
                    }
                });
            }

            /*
            * @name         closePhase
            * @description  This method close session opened set phase dispense to next phase
            * @date         2017-05-20
            * @author       Joan Fernandez Abelló
            * @version      1.0
            * @params       none
            * @return       none
            */
            this.closePhase = function(){
                this.closeSession();
                for(var j=0;j<$scope.phaseArray.length;j++){
                    if($scope.phaseArray[j].getId()==$scope.dispense.getPhase().getId() && $scope.dispense.getPhase().getId()!=3){
                        $scope.dispense.setPhase($scope.phaseArray[j+1]);
                        break;
                    }   
                }
            }

            /*
            * @name         addSession
            * @date         2017-05-20
            * @description  This method save session info to save in DDBB when new dispense is inserted
            * @author       Joan Fernandez Abelló
            * @version      1.0
            * @params       none
            * @return       none
            */
            this.addSession = function(){
                $('#newSession').modal('hide'); 
                if($scope.subjectsProjectArray.length==0){
                    $('#newSubject').modal('show');     
                    $('#newSubject').css('overflow-y','scroll');               
                }else{
                    $scope.info=1;   
                }             
            }

            this.newSubMedicaments = function(index){
                var preinscription = new Preinscription();
                preinscription.setMedicament(index);
                $scope.preinscriptionArray.push(preinscription);

            }

            this.newSubDisease = function(index){
                var endure = new Endure();
                endure.setDisease(index);
                $scope.endureArray.push(endure);
            }

            this.selectSubject = function(){
                if($scope.subjectsProjectArray.indexOf($scope.selectSubject)==-1){
                    $scope.subjectsProjectArray.push($scope.selectSubject);
                }
                $('#newSubject').modal('hide');
                $scope.info=1;
            }

            /*
            * @name         deleteProject
            * @description  This method removes the project in the database.
            * @date         2017-05-16
            * @author       Jonathan Lozano Redondo
            * @version      1.0
            * @params       project: object project to remove.
            * @return       none
            */
            this.deleteProject = function (project) {

                var projectsArrayIndex = $scope.projectsArray.indexOf(project);
                var filteredDataIndex = $scope.filteredData.indexOf(project);

                var projectArray = [];
                project = angular.copy(project);
                projectArray.push(project);
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:1,action:10020,jsonData:JSON.stringify(projectArray)});

                promise.then(function (outPutData) {
                    if(outPutData[0]=== true) {
                        $scope.projectsArray.splice(projectsArrayIndex, 1);
                        if ($scope.projectsArray != $scope.filteredData) {
                            $scope.filteredData.splice(filteredDataIndex, 1);
                        }
                        alert("Project deleted correctly");
                    } else {
                        if(angular.isArray(outPutData[1])) {
                            alert(outPutData[1]);
                        }
                        else {alert("There has been an error in the server, try again later");}
                    }
                });
            }

            this.loadStatistics = function(index){
                $scope.infoProject.setId(index.getId());
                $scope.infoProject.setName(index.getName());
                $scope.infoShow=9;
                $("#statisticsProject").modal("show");
            }

            this.userStatistics = function(index){
                $scope.infoProject.setId($scope.project.getId());
                $scope.infoSubject.setId(index.getSubject().getId());
                $scope.infoShow=10;  
                $("#statisticsUser").modal("show");              
            }

            this.sessionStatistics = function(index){
                $scope.infoProject.setId($scope.project.getId());
                $scope.infoSession.setId(index.getSession().getId());
                $scope.infoSession.setName(index.getSession().getName());
                $scope.infoShow=11;    
                $("#statisticsSession").modal("show");            
            }

            this.phaseStatistics = function(index){
                $scope.infoProject.setId($scope.project.getId());
                $scope.infoPhase.setId(index.getPhase().getId());
                $scope.infoPhase.setName(index.getPhase().getName());
                $scope.infoShow=12; 
                $("#statisticsPhase").modal("show");               
            }

        }]);

    
        /*
        * @name         directive ngConfirmClick
        * @description  This method opens a modal confirm window.
        * @date         10/05/2017
        * @author       Jonathan Lozano Redondo
        * @version      1.0
        * @params       none
        * @return       none
        */
        angular.module('pharmatesisApp').directive('ngConfirmClick', [
        function(){
            return {
                link: function (scope, element, attr) {
                    var msg = attr.ngConfirmClick || "Are you sure?";
                    var clickAction = attr.confirmedClick;
                    element.bind('click',function (event) {
                        if ( window.confirm(msg) ) {
                            scope.$eval(clickAction)
                        }
                    });
                }
            };
        }])
})();
