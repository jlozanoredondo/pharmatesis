(function () {
    angular.module('pharmatesisApp').controller("ProjectController", ['$http', '$scope', '$window', '$cookies', 'accessService',
        'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {

            this.manageProject = function (projectId)
            {
                alert("Project to manage with ID "+projectId);
            }
            
            this.deleteProject = function (projectId)
            {                
                if(confirm("Are you sure you want to delete project with ID "+projectId+"?"))
                {
                    alert("Deleting project");
                }
            }
        }]);
})();