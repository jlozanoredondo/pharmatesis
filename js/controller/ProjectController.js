(function () {
    angular.module('pharmatesisApp').controller("ProjectController", ['$http', '$scope', '$window', '$cookies', 'accessService',
        'userConnected', '$filter', function ($http, $scope, $window, $cookies, accessService, userConnected, $filter) {
            
            $scope.projectsArray = new Array();
            $scope.diseaseArray = new Array();
            $scope.dispenseArray = new Array();
            $scope.subjectArray = new Array();
            $scope.project = new Project();
            $scope.dispense = new Dispense();
            $scope.project.setUserId(1);
            $scope.msg=0;

            //Pagination variables
            $scope.pageSize = 10;
            $scope.currentPage = 1;
            $scope.$watch("name",function () {
                $scope.filteredData = $filter('filter')($scope.projectsArray,{name:$scope.name});
            });
          

            $scope.loadProjects = function(){
                $scope.filteredData = [];
                $scope.projectsArray = [];
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 1, action: 10000, jsonData: JSON.stringify("")});

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

            this.loadProject = function(project){
                $scope.filteredData = [];
                $scope.subjectArray = [];
                $scope.dispenseArray = [];

                $scope.project = new Project();
                $scope.project.construct(project.id, project.userId, project.name, project.initialDate,project.endDate, project.testedDrug, project.endDate, project.disease);

                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:4,action:10000,jsonData:JSON.stringify($scope.project)});

                    promise.then(function (outPutData) {
                        console.log(outPutData);
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var subject = new Subject();
                                subject.construct(outPutData[1][i].id, outPutData[1][i].bornDate, outPutData[1][i].gender, outPutData[1][i].breed, outPutData[1][i].nick, outPutData[1][i].bloodType, outPutData[1][i].status, outPutData[1][i].countryId);
                                $scope.subjectArray.push(subject);
                            }
                        }
                    });

                var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:3,action:10000,jsonData:JSON.stringify($scope.project)});
                
                    promise.then(function (outPutData) {
                        if(outPutData[0]=== true) {
                            for (var i = 0; i < outPutData[1].length; i++) {
                            var dispense = new Dispense();
                                dispense.construct(outPutData[1][i].id, outPutData[1][i].projectId, $scope.subjectArray[i], outPutData[1][i].phaseId, outPutData[1][i].sessionId, outPutData[1][i].viability, outPutData[1][i].sideEffects, outPutData[1][i].dose, outPutData[1][i].reaction);
                                $scope.dispenseArray.push(dispense);
                            }
                            console.log($scope.dispenseArray);
                            $scope.filteredData = $scope.dispenseArray;
                        }
                    });

                $scope.$parent.action=6;
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
            console.log(projectArray);
            var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType:1,action:10020,jsonData:JSON.stringify(projectArray)});

            promise.then(function (outPutData) {
                if(outPutData[0]=== true) {
                    console.log(outPutData);
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
        }]);

        /*
        * @name         directive ngConfirmClick
        * @description  This method opens a modal confirm window.
        * @date         10/05/2017
        * @author       Alba Gómez Segura
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
