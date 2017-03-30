//Angular code
(function () {
    angular.module('pharmatesisApp').controller("UserController", ['$http', '$scope', '$window', '$cookies', 'accessService',
        'userConnected', function ($http, $scope, $window, $cookies, accessService, userConnected) {
//accessService and userConnected are factories we defined in app.js and declare in all controllers we need to use
            //scope variables
            $scope.userOption = 0;
            //$scope.user = new User();
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

            //Session control in order to inform $scope.user            

            //Methods
            
            
            this.logIn = function ()
            {
                alert("User logged correctly");
                $scope.action = 0;
            }
            
            this.register = function ()
            {
                alert("User registrated correctly");
                $scope.action = 0;
            }
            
            
            
            this.userManagement = function ()
            {
                switch ($scope.userOption)
                {
                    //User entry: index.html
                    case 1:
                        /* Enviar la imagen */

                        //Seleccionamos la imagen
                        var imageFile = $("#imageUser")[0].files[0];

                        var imagesArrayToSend = new FormData(); //FormData: Array para enviar ficheros
                        imagesArrayToSend.append('images[]', imageFile); //Añadimos la imagen
                        //imagesArrayToSend['images[]']

                        $http({
                            method: 'POST',
                            url: 'php/controllers/MainController.php?controllerType=2&action=10010&jsonData=' + $scope.user.getNick(),
                            headers: {'Content-Type': undefined}, //Cambiamos los headers para poder enviar fichero
                            data: imagesArrayToSend,
                            transformRequest: function (data, headersGetterFunction) {
                                return data;
                            }
                        }).success(function (outPutData) {
                            if (outPutData[0] === true) {
                                //File uploaded
                                $scope.user.setId(0);
                                $scope.user.setActive(1);
                                $scope.user.setImage(outPutData[1]); //En la primera posicion nos devuelve la ruta del archivo subido (FileControllerClass)
                                $scope.user = angular.copy($scope.user);

                                var promise = accessService.getData("php/controllers/MainController.php", true, "POST"
                                        , {controllerType: 0, action: 10010, jsonData: JSON.stringify($scope.user)});


                                promise.then(function (outPutData) {
                                    if (outPutData[0] === true)
                                    {
                                        console.log(outPutData[1]);
                                    } else
                                    {
                                        if (angular.isArray(outPutData[1]))
                                        {
                                            alert(outPutData[1]);
                                        } else {
                                            alert("There has been an error in the server, try later");
                                        }
                                    }
                                });

                            } else
                            {

                                if (angular.isArray(outPutData[1]))
                                {
                                    showErrors(outPutData[1]);
                                } else {
                                    alert("There has been an error in the server, try later");
                                }
                            }
                        });


                        break;
                        //user modification: mainWindow.html
                    case 2:

                        break;
                    default:
                        alert("There has been an error, try later");
                        console.log("user action not correcte: " + $scope.userOption);
                        break;
                }
            }                        

            this.connection = function ()
            {
                //copy
                $scope.user = angular.copy($scope.user);

                //Server conenction to verify user's data

                //use the getData function from accessService factory
                //var promise = accessService.getData( url, async, method, params, data); 
                //url: ruta al controlador del servidor
                //async connection: true si la conexion se realiza asincronamente, la web sigue en ejecución sin pararse
                //method: post o get 
                //params: lo que el servidor espera(MainController.php). 
                //	- controllerType: 0, 
                //	- action: 10000 (UserControllerClass)
                //	- jsonData: JSON.stringify($scope.user) Funcion para convertir el objeto en formato json
                //data: Se utiliza para enviar ficheros. No se utiliza aquí.
                //var promise. Variable de angular para ejecutar ajax.

                var promise = accessService.getData("php/controllers/MainController.php", true, "POST"
                        , {controllerType: 0, action: 10000, jsonData: JSON.stringify($scope.user)});

                //outPutData es siempre un array. 
                //Primera posición. True/False. 
                //Segunda posicion. 
                //	- Si es true: Array de usuarios
                //	- Si es false: Mensaje de error

                //PARA LA CONEXION MIRAR LOS DATOS DE BDgeneticsPharma y cargar el .sql a la base de datos.

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        console.log(outPutData[1]);
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try later");
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

    angular.module('pharmatesisApp').directive("userDataManagement", function () {
        return {
            restrict: 'E',
            templateUrl: "view/templates/user-data-management.html",
            controller: function () {

            },
            controllerAs: 'userDataManagement'
        };
    });
})();


//Own code


/*
 var imageFile = $("#imageUser")[0].files[0];
 
 var imagesArrayToSend = new FormData();
 imagesArrayToSend.append('images[]', imageFile);
 //imagesArrayToSend['images[]']
 
 $http({
 method: 'POST',
 url: 'php/controllers/MainController.php?controllerType=2&action=10010&jsonData=' + $scope.user.getNick(),
 headers: {'Content-Type': undefined},
 data: imagesArrayToSend,
 transformRequest: function (data, headersGetterFunction) {
 return data;
 }
 }).success(function (outPutData) {
 if (outPutData[0] === true) {
 //File uploaded
 
 
 } else
 {
 
 if (angular.isArray(outPutData[1]))
 {
 showErrors(outPutData[1]);
 } else {
 alert("There has been an error in the server, try later");
 }
 }
 });
 */
