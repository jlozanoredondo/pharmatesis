/**
    * Main JS App
    * @name app.js
    * @author Joan Fernández
    * @date 2017-03-09
    * @version 1.5
*/
(function () {
    var pharmatesisApp = angular.module('pharmatesisApp', ['ng-currency', 'ui.bootstrap', 'ngCookies', 'angularUtils.directives.dirPagination']);
    
    //AJAX call
    pharmatesisApp.factory('accessService', function ($http, $log, $q) {
        return {
            getData: function (url, async, method, params, data) {
                var deferred = $q.defer();
                $http({
                    url: url,
                    method: method,
                    asyn: async,
                    params: params,
                    data: data
                })
                        .success(function (response, status, headers, config) {
                            deferred.resolve(response);
                        })
                        .error(function (msg, code) {
                            deferred.reject(msg);
                            $log.error(msg, code);
                            alert("There has been an error in the server, try later");
                        });

                return deferred.promise;
            }
        }
    });
    
    //Directive to run the menu navbar
    pharmatesisApp.directive("topMenu", function (){
        return {
                restrict: 'E',
                templateUrl:"views/templates/top-menu.html",
                controller:function(){

                },
            controllerAs: 'topMenu'
        };
    });        
    
})();
