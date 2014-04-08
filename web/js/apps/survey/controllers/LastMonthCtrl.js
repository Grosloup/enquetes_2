/**
 * Created by grosloup on 08/04/2014.
 */
var mainApp = angular.module("MainApp");

var Monthes = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

function capitalizr(word){
    return word.charAt(0).toUpperCase() + word.slice(1);
}

mainApp.controller("LastMonthCtrl", ["$scope","$http", function($scope, $http){
    $scope.isloaded = false;
    // mois en cours => mois dernier
    var today = new Date();
    var lastMonth, lastMonthYear, currentMonth = today.getMonth(), currentYear = today.getFullYear();
    if(currentMonth == 0){
        lastMonth = 11;
        lastMonthYear = currentYear - 1;
    } else {
        lastMonth = currentMonth - 1;
        lastMonthYear = currentYear;
    }

    $scope.lastMonth = capitalizr(Monthes[lastMonth]);
    $scope.lastMonthYear = lastMonthYear;
    $scope.infos = "";

    // recup nombre enquetes pour le mois dernier:

    $http.get("/survey/api/last-month.php", {params:{"lastMonth": lastMonth + 1, "lastMonthYear": lastMonthYear}})
        .success(function(data, status, headers, config){
            $scope.isloaded = true;
            if(!data.errors){
                var numEnquetes = parseInt(data.datas["nombre_enquetes"]);

                if(numEnquetes == 0){
                   $scope.infos = "Il n'y a pas (encore) de données enregistrées pour le mois de " + $scope.lastMonth + ".";
                } else if(numEnquetes <= 50){

                } else {

                }
            } else {

            }
        })
        .error(function(data, status, headers, config){ /* relance */});




}]);
