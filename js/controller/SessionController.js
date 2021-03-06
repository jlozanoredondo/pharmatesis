
/**
    * Controller to manage the session
    * @name SessionController.js
    * @author Joan Fernández
    * @date 2017-03-16
    * @version 1.0
*/
(function () {

    angular.module('pharmatesisApp').controller("SessionController", ['$http', '$scope', '$window', '$cookies', 'accessService', function ($http, $scope, $window, $cookies, accessService) {
            //Scope variables
            $scope.user = new User();
            $scope.userAction = 0;
            $scope.sessionOpened;

            /*
                * @name sessionControl
                * @description Redirects and manage the sessions depending the page that the user executes
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.sessionControl = function ()
            {
                switch ($scope.userAction)
                {
                    //Index.html is executed
                    case 0:
                        var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10030, jsonData: JSON.stringify("")});

                        promise.then(function (outPutData) {
                            if (outPutData[0] === true)
                            {
                                window.open("home.html", "_self")
                            } else
                            {
                                if (!angular.isArray(outPutData[1]))
                                {
                                    alert("There has been an error in the server, try again later.");
                                }
                            }
                        });
                        break;
                        //home.html is executed
                    case 1:
                        var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10030, jsonData: JSON.stringify("")});

                        promise.then(function (outPutData) {
                            if (outPutData[0] === true)
                            {
                                $scope.user.construct(outPutData[1].id, outPutData[1].name, outPutData[1].password, outPutData[1].surnames, outPutData[1].email, outPutData[1].phone, outPutData[1].bornDate, outPutData[1].specialism, outPutData[1].professionId);
                                $scope.sessionOpened = true;

                                sessionStorage.userConnected = JSON.stringify($scope.user);
                                var a = 1;
                            } else
                            {
                                if (angular.isArray(outPutData[1]))
                                {
                                    window.open("index.html", "_self")
                                } else {
                                    alert("There has been an error in the server, try again later.");
                                }
                            }
                        });
                        break;
                    default:
                        alert("There has been an error, try again later.");
                        break;
                }
            }
            
            /*
                * @name logOut
                * @description Kills the session.
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.0
                * @params none
                * @return none
            */
            $scope.logOut = function ()
            {
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10040, jsonData: JSON.stringify("")});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        sessionStorage.removeItem("userConnected");
                        window.open("index.html", "_self");
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
        }]);
})();
