//Angular code
(function () {
    angular.module('pharmatesisApp').controller("InterfaceController", ['$http', '$scope', '$window', '$cookies', 'accessService',
        'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {
        
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
})();