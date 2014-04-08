/**
 * Created by grosloup on 08/04/2014.
 */
var mainApp = angular.module("MainApp");

var Monthes = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

function capitalizr(word){
    return word.charAt(0).toUpperCase() + word.slice(1);
}

mainApp.controller("LastMonthCtrl", ["$scope","$http", function($scope, $http){
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

    // recup nombre enquetes pour le mois dernier:

    $http.get("/survey/api/last-month.php", {params:{"lastMonth": lastMonth + 1, "lastMonthYear": lastMonthYear}})
        .success(function(data, status, headers, config){})
        .error(function(data, status, headers, config){});




}]);