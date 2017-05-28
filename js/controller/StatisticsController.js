/*
	@name: StatisticsController.js
	@Author: Jonathan Lozano & Joan Fernández
	@Version: 1.0
	@Description: Controller for statistics (R)
	@Date: 2017-05-15
*/
//JQuery code


//Angular code
(function (){
	//Application module
	angular.module('pharmatesisApp').controller("StatisticsController", ['$http','$scope', '$window','accessService', function ($http, $scope, $window, accessService){
		//scope variables
		
		$scope.infoSubject = new Subject();
		$scope.statistics = new Statistics();

		//Observes user action and assign the result stadistics data to the corresponding variables

		$scope.$parent.$watch('infoShow', function()
		{

	        if ($scope.$parent.infoShow == 9) {
	        	$scope.$parent.infoProject = angular.copy($scope.$parent.infoProject);
				var promise = accessService.getData("r/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10000, jsonData:JSON.stringify($scope.$parent.infoProject)});

				promise.then(function (outPutData) {
					if(outPutData[0]== 1)
					{
						//Value assignation
						$scope.$parent.subjectsCountProject = outPutData[1][0]["subjectcount"][0];
						$scope.$parent.barplotSubjectsSideEffectsProject = outPutData[1][1];
						$scope.$parent.barplotSubjectsGenderProject = outPutData[1][2];
						$scope.$parent.barplotSubjectsBreedProject = outPutData[1][3];
						$scope.$parent.barplotSubjectsBloodTypeProject = outPutData[1][4];
						$scope.$parent.boxPlotSubjectHeight = outPutData[1][5];
						$scope.$parent.boxPlotSubjectWeight = outPutData[1][6];
						$scope.$parent.barplotSubjectsReactionProject = outPutData[1][7];
						$scope.$parent.boxPlotProjectDose = outPutData[1][8];
						$scope.$parent.boxPlotCorrelationWeightDose = outPutData[1][9];
						$scope.$parent.boxPlotCorrelationHeightDose = outPutData[1][10];
						$scope.$parent.boxPlotYear = outPutData[1][11];
					}
					else
					{
						if(angular.isArray(outPutData[1]))
						{
							alert(outPutData[1]);
						}
						else {alert("There has been an error in the server, try later");}
					}
				});
			}else if($scope.$parent.infoShow==10){
	        	$scope.$parent.infoProject = angular.copy($scope.$parent.infoProject);
	            var promise = accessService.getData( "php/controller/MainController.php", true, "POST", {controllerType:4,action:10020,jsonData:JSON.stringify($scope.$parent.infoSubject)}); 
	            promise.then(function (outPutData) {
	            	console.log(outPutData);
	                if(outPutData[0]=== true) { 
	                    $scope.infoSubject.construct(outPutData[1][0].id, outPutData[1][0].bornDate, outPutData[1][0].gender, outPutData[1][0].breed, outPutData[1][0].nick, outPutData[1][0].bloodType, outPutData[1][0].status, outPutData[1][0].height, outPutData[1][0].weight, outPutData[1][0].countryId,outPutData[1][0].userId);	                      

	                    $scope.statistics = new Statistics();
	                    $scope.statistics.setProject($scope.$parent.project);
	                    $scope.statistics.setSubject($scope.infoSubject);

	                    var promise = accessService.getData("r/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10010, jsonData:JSON.stringify($scope.statistics)});
	                    promise.then(function (outPutData) {
							if(outPutData[0]== 1)
							{
								$scope.$parent.subjectboxPlotSubjectDose = outPutData[1][0];
							}
						});
	                }
            	});	
			}else if($scope.$parent.infoShow==11){
				$scope.$parent.infoProject = angular.copy($scope.$parent.infoProject);
				$scope.statistics = new Statistics();
                $scope.statistics.setProject($scope.$parent.infoProject);
                $scope.statistics.setSession($scope.$parent.infoSession);	

                var promise = accessService.getData("r/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10020, jsonData:JSON.stringify($scope.statistics)});
                promise.then(function (outPutData) {
					if(outPutData[0]== 1)
					{
						$scope.$parent.barplotSessionSideEffectsSession = outPutData[1][0];
						$scope.$parent.boxPlotSessionHeight = outPutData[1][1];
						$scope.$parent.boxPlotSessionWeight = outPutData[1][2];
						$scope.$parent.barplotSubjectsViabilitySession = outPutData[1][3];
						$scope.$parent.barplotSubjectsReactionSession = outPutData[1][4];
						$scope.$parent.boxPlotSessionDose = outPutData[1][5];
						$scope.$parent.boxPlotCorrelationWeightDose = outPutData[1][6];
						$scope.$parent.boxPlotCorrelationHeightDose = outPutData[1][7];
					}
				});
	                
			}else if($scope.$parent.infoShow==12){
				$scope.$parent.infoProject = angular.copy($scope.$parent.infoProject);
				$scope.statistics = new Statistics();
                $scope.statistics.setProject($scope.$parent.infoProject);
                $scope.statistics.setPhase($scope.$parent.infoPhase);	
                console.log($scope.statistics);
                var promise = accessService.getData("r/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10030, jsonData:JSON.stringify($scope.statistics)});
                promise.then(function (outPutData) {
                	console.log(outPutData);
					if(outPutData[0]== 1)
					{
						$scope.$parent.barplotPhaseSideEffects = outPutData[1][0];
						$scope.$parent.boxPlotPhaseHeight = outPutData[1][1];
						$scope.$parent.boxPlotPhaseWeight = outPutData[1][2];
						$scope.$parent.barplotSubjectsViabilityPhase = outPutData[1][3];
						$scope.$parent.barplotSubjectsReactionPhase = outPutData[1][4];
						$scope.$parent.boxPlotPhaseDose = outPutData[1][5];
						$scope.$parent.boxPlotCorrelationWeightDose = outPutData[1][6];
						$scope.$parent.boxPlotCorrelationHeightDose = outPutData[1][7];
					}
				});
	                
			}
		
		});

	}]);
})();


//Own code
