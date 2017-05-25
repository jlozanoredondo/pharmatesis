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
	angular.module('pharmatesisApp').controller("StatisticsController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.showForm=0;
		$scope.showData = 0;
		$scope.statisticMean = 0;
		$scope.statisticMedian = 0;
		$scope.statisticVar = 0;
		$scope.statisticSd = 0;
		$scope.statisticCV = 0;
		$scope.statisticBoxplot = "#";
		$scope.statisticHist = "";	

		//Observes user action and assign the result stadistics data to the corresponding variables

		$scope.$parent.$watch('action', function()
		{
			
	        if ($scope.$parent.action == 9) {
	        	$scope.$parent.project = angular.copy($scope.$parent.project);
				var promise = accessService.getData("r/controller/StatisticsController.R", true, "POST", "", {controllerType:0,action:10000, jsonData:JSON.stringify($scope.$parent.project.id)});

				promise.then(function (outPutData) {
					console.log(outPutData);
					if(outPutData[0]== 1)
					{
						console.log(outPutData);
						//Value assignation
						$scope.statisticMean = outPutData[1];
						$scope.statisticMedian = outPutData[2];
						$scope.statisticVar = outPutData[3];
						$scope.statisticSd = outPutData[4];
						$scope.statisticCV = outPutData[5];
						$scope.statisticBoxplot = outPutData[6];
						$scope.statisticHist = outPutData[7];
						$scope.showData = 1;
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
			}
		});



	}]);
})();


//Own code
