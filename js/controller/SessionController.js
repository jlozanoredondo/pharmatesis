//Angular code
(function () {

    angular.module('pharmatesisApp').controller("SessionController", ['$http', '$scope', '$window', '$cookies', 'accessService', 'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {

            //scope variables
            //$scope.user = new User();
            $scope.userAction = 0;

            this.sessionControl = function ()
            {
                switch ($scope.userAction)
                {
                    //Index.html is executed
                    case 0:

                        break;
                        //mainWindow.html is executed
                    case 1:

                        break;
                    default:
                        alert("There has been an error, try later");
                        console.log("user action not correcte: " + $scope.userAction);
                        break;
                }
            }

            this.logOut = function ()
            {
                //Local session destroy

            }
        }]);
})();
