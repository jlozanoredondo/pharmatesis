//JQuery code


//Angular code
(function (){
	//Application module
	angular.module('pharmatesisApp').controller("MoleculeController", ['$http','$scope', '$window', '$cookies','accessService','$filter', function ($http, $scope, $window, $cookies, accessService, $filter){
		//scope variables
		$scope.shomForm=0;
		$scope.moleculeTypesArray = new Array();
		$scope.directorsArray = new Array();
		$scope.moleculesArray = new Array();
		var molecule = new Molecule();
		molecule.construct(0,"",0,"","");
		$scope.moleculesArray.push(molecule);

		//Pagination variables
		$scope.pageSize = 4;
		$scope.currentPage = 1;


		this.addMolecule = function () {
			var molecule = new Molecule();
			molecule.construct(0,"",0,"","");
			$scope.moleculesArray.push(molecule);
		}

		this.removeMolecule = function (indexMolecule)
		{
			if($scope.moleculesArray.length ==1) {alert("At least one molecule must be inserted")}
			else {$scope.moleculesArray.splice(indexMolecule,1);}
		}

		this.entryMolecule = function () {


		}

		this.modMolecules = function () {

		}

		this.loadMolecules = function () {


		}

		$scope.$watch("formulaSearch+similarity1Search",function () {
			$scope.filteredData = $filter('filter')($scope.moleculesModArray,{moleculeFormula:$scope.formulaSearch,moleculeSimilarity1:$scope.similarity1Search});
		});

	}]);




	angular.module('geneticsPharmaApp').directive("moleculesEntryForm", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/molecules-entry-form.html",
			controller:function(){

			},
			controllerAs: 'moleculesEntryForm'
		};
	});

	angular.module('geneticsPharmaApp').directive("moleculesModForm", function (){
		return {
			restrict: 'E',
			templateUrl:"view/templates/molecules-mod-form.html",
			controller:function(){

			},
			controllerAs: 'moleculesModForm'
		};
	});
})();


//Own code
