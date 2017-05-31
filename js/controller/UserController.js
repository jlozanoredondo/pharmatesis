/**
    * Controller to manage the users data
    * @name UserController.js
    * @author Joan Fernández
    * @date 2017-03-16
    * @version 1.0
*/
(function () {
    angular.module('pharmatesisApp').controller("UserController", ['$http', '$scope', '$window', '$cookies', 'accessService', function ($http, $scope, $window, $cookies, accessService) {

            //scope variables
            $scope.userOption = 0;
            $scope.repPass = "";
            $scope.user = new User();
            $scope.userReg = new User();
            $scope.userReg.construct(1, "John", "", "Sullivan", "sullivan.john@mail.com", 123456789, "", "Genomics", 1);
            
            //Review instance
            $scope.review = new Review();
            
            //Recovery instance
            $scope.userRec = new User();

            //Time variables
            var yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            $scope.userReg.setBornDate(yesterday);

            //Scope variables for datepicker
            $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
            $scope.format = $scope.formats[1]; //Aquesta es la opcio que posem al format uib-datepicker-popup de l'html
            $scope.dateOptions = {
                dateDisabled: disabled,
                formatYear: 'yyyy',
                maxDate: new Date(2020, 5, 22),
                minDate: new Date(1910, 1, 01),
                startingDay: 1
            };

            $scope.bornDate = {
                opened: false
            };

            //Session control
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
                        $scope.user.construct(objAux.id, objAux.name, objAux.password, objAux.surnames, objAux.email, objAux.phone, objAux.bornDate, objAux.specialism, objAux.professionId);
                    }
                }
            }

            /*
                * @name connection
                * @description Finds the user in the DB and creates the connection.
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.connection = function ()
            {
                //Angular copy
                $scope.user = angular.copy($scope.user);

                //Server conenction to verify user's data
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10000, jsonData: JSON.stringify($scope.user)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        if (typeof (Storage) !== "undefined") {
                            sessionStorage.userConnected = JSON.stringify(outPutData[1][0]);
                            window.open("home.html", "_self");
                        } else {
                            alert("Your browser is not compatible with this application, upgrade it!");
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
            
            /*
                * @name register
                * @description Inserts a new user into the DB
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.register = function () {                

                if ($scope.userReg.getPassword() == $scope.repPass)
                {
                    $scope.userReg = angular.copy($scope.userReg);

                    var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10010, jsonData: JSON.stringify($scope.userReg)});

                    promise.then(function (outPutData) {
                        if (outPutData[0] === true)
                        {
                            alert("Registrated successfully.");
                            $scope.registerForm.$setPristine();
                            window.open("index.html", "_self");
                        } else
                        {
                            if (angular.isArray(outPutData[1]))
                            {
                                alert(outPutData[1]);
                            } else {
                                alert("Email already registered or wrong field data!");
                            }
                        }
                    });
                } else
                {
                    alert("Error! Passwords don't match.")
                }
            }
            
            /*
                * @name loadProfessions
                * @description Loads all the DB professions in an array
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.loadProfessions = function () {

                $scope.professionsArray = new Array();

                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 11, action: 10000, jsonData: JSON.stringify("")});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        for (var i = 0; i < outPutData[1].length; i++) {

                            var profession = new Profession();
                            profession.construct(outPutData[1][i].id, outPutData[1][i].name);                   
                            $scope.professionsArray.push(profession);
                        }                        
                        $scope.userReg.setProfessionId($scope.professionsArray[1]);
                        $scope.user.setProfessionId($scope.professionsArray[$scope.user.getProfessionId()]);
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
            
            /*
                * @name sendReview
                * @description Sends a review to the Pharmatesis mail
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.sendReview = function() {
                $scope.review = angular.copy($scope.review);
                //Server conenction to verify user's data
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10050, jsonData: JSON.stringify($scope.review)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        alert(outPutData[1]);
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server, try again later.");
                            alert(outPutData[1]);
                        }
                    }
                });
            }                        
            
            /*
                * @name loadUser
                * @description Load the connected user data.
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.loadUser = function()
            {
                $scope.user = angular.copy($scope.user);
                
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10070, jsonData: JSON.stringify($scope.user)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        $scope.profileUser = new User();
                        $scope.profileUser.construct(outPutData[1][0].id, outPutData[1][0].name, outPutData[1][0].password, outPutData[1][0].surnames, outPutData[1][0].email, outPutData[1][0].phone, outPutData[1][0].bornDate, outPutData[1][0].specialism, outPutData[1][0].professionId);
                        $scope.profileUser.setProfessionId($scope.professionsArray[$scope.profileUser.getProfessionId()]);
                        $scope.profileUser.setPassword("");
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server. Try again later.");
                        }
                    }
                });
            }
            
            /*
                * @name removeUser
                * @description Removes a user in the DB
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.removeUser = function()
            {
                if (confirm("Are you sure you want to delete your user and all its data?") == true) {
                    if (confirm("Are you really sure you want to delete your user and all its data?") == true) {
                        $scope.user = angular.copy($scope.user);                
                        var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10060, jsonData: JSON.stringify($scope.user)});

                        promise.then(function (outPutData) {
                            if (outPutData[0] === true)
                            {
                                alert("User deleted successfully.");
                                $scope.logOut();
                            } else
                            {
                                if (angular.isArray(outPutData[1]))
                                {
                                    alert(outPutData[1]);
                                } else {
                                    alert("Error! Can't delete profile because internal problems. Try again later.");
                                }
                            }
                        });                        
                    }
                }
            }
            
            /*
                * @name updateProfile
                * @description Updates user profile in the DB
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.updateProfile = function()
            {
                $scope.profileUser = angular.copy($scope.profileUser);
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10020, jsonData: JSON.stringify($scope.profileUser)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        alert("User updated successfully.");
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("Email already registered!");
                        }
                    }
                });  
            }
            
            /*
                * @name passwordRecovery
                * @description Sends a mail to the user with its new password
                * @date 2017-04-06
                * @author Joan Fernández
                * @version 1.2
                * @params none
                * @return none
            */
            this.passwordRecovery = function()
            {
                $scope.userRec = angular.copy($scope.userRec);
                
                var promise = accessService.getData("php/controller/MainController.php", true, "POST", {controllerType: 0, action: 10080, jsonData: JSON.stringify($scope.userRec)});

                promise.then(function (outPutData) {
                    if (outPutData[0] === true)
                    {
                        alert(outPutData[1]);
                    } else
                    {
                        if (angular.isArray(outPutData[1]))
                        {
                            alert(outPutData[1]);
                        } else {
                            alert("There has been an error in the server. Try again later.");
                        }
                    }
                });
            }
            

            $scope.openBornDate = function () {
                $scope.bornDate.opened = true;
            };
        }]);
})();

//Own code
function disabled(data) {
    var date = data.date,
            mode = data.mode;
    return "";
}