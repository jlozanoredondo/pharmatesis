//Angular code
(function () {
    angular.module('pharmatesisApp').controller("InterfaceController", ['$http', '$scope', '$window', '$cookies', 'accessService', function ($http, $scope, $window, $cookies, accessService) {
        
        //$scope.action = $cookies.getObject("action");
        
        $scope.loadInterface = function() {
            $scope.action = 2;
        }
        
        
    }]);
    
    angular.module('pharmatesisApp').directive("createProjectForm", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/create-project-form.html",
                controller:function(){

                },
            controllerAs: 'createProjectForm'
        };
    });
    
    angular.module('pharmatesisApp').directive("manageProjects", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/manage-projects.html",
                controller:function(){

                },
            controllerAs: 'manageProjects'
        };
    });

    angular.module('pharmatesisApp').directive("manageProject", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/manage-project.html",
                controller:function(){

                },
            controllerAs: 'manageProjects'
        };
    });
    
    angular.module('pharmatesisApp').directive("loginForm", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/login-form.html",
                controller:function(){

                },
            controllerAs: 'loginForm'
        };
    });
    
    angular.module('pharmatesisApp').directive("registrationForm", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/register-form.html",
                controller:function(){

                },
            controllerAs: 'registrationForm'
        };
    });
    
    angular.module('pharmatesisApp').directive("showUsers", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/show-users.html",
                controller:function(){

                },
            controllerAs: 'showUsers'
        };
    });
    
    angular.module('pharmatesisApp').directive("modifyForm", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/modify-form.html",
                controller:function(){

                },
            controllerAs: 'modifyForm'
        };
    });
    angular.module('pharmatesisApp').directive("statisticsProject", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/statistics-project.html",
                controller:function(){

                },
            controllerAs: 'statisticsProject'
        };
    });
    angular.module('pharmatesisApp').directive("userStatistics", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/user-statistics.html",
                controller:function(){

                },
            controllerAs: 'userStatistics'
        };
    });
    angular.module('pharmatesisApp').directive("sessionStatistics", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/session-statistics.html",
                controller:function(){

                },
            controllerAs: 'sessionStatistics'
        };
    });
    angular.module('pharmatesisApp').directive("phaseStatistics", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/phase-statistics.html",
                controller:function(){

                },
            controllerAs: 'phaseStatistics'
        };
    });
})();