//Angular code
(function () {
    angular.module('pharmatesisApp').controller("UserController", ['$http', '$scope', '$window', '$cookies', 'accessService', 'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {

            //scope variables
            $scope.userOption = 0;
            $scope.user = new User();

            if (typeof (Storage) == "undefined")
            {
                alert("Your browser is not compatible with sessions, upgrade your browser");
            } else
            {
                if (sessionStorage.length > 0)
                {
                    var objAux = JSON.parse(sessionStorage.getItem("userConnected"));

                    if (!isNaN(objAux.id))
                    {
                        $scope.user.construct(objAux.id, objAux.name, objAux.surname1, objAux.nick, objAux.password, objAux.address, objAux.telephone, objAux.mail, new Date(objAux.birthDate), objAux.entryDate, objAux.dropOutDate, objAux.active, objAux.image);
                    }
                }
            }

            $scope.passwordValid = true;
            $scope.nickValid = true;

            $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
            $scope.format = $scope.formats[0];
            $scope.dateOptions = {
                dateDisabled: "",
                formatYear: 'yyyy',
                maxDate: new Date(),
                minDate: "",
                startingDay: 1
            };

            $scope.birthDate = {
                opened: false
            };

            $scope.openBirthDate = function () {
                $scope.birthDate.opened = true;
            };           

            this.connection = function ()
            {
                //copy
                $scope.user = angular.copy($scope.user);

                //Server conenction to verify user's data
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10000, jsonData: JSON.stringify($scope.user)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        if (typeof (Storage) !== "undefined") {

                            sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
                            //window.open("mainWindow.html", "_self");
                            console.log("Logged correctly");
                            alert("SUUUUU!");
                        } else {
                            alert("Your browser is not compatible with this application, upgrade it plase!");
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

            $scope.setFile = function (element) {
                $scope.currentFile = element.files[0];
                var reader = new FileReader();

                reader.onload = function (event) {
                    $scope.userImage = event.target.result
                    $scope.$apply();
                }

                // when the file is read it triggers the onload event above.
                reader.readAsDataURL(element.files[0]);
            }
        }]);
})();
