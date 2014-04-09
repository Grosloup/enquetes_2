/**
 * Created by grosloup on 08/04/2014.
 */
var mainApp = angular.module("MainApp");

var Monthes = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

function capitalizr(word){
    return word.charAt(0).toUpperCase() + word.slice(1);
}

mainApp.controller("LastMonthCtrl", ["$scope", "$sce", "$http", function($scope, $sce, $http){
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

    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };

    // recup nombre enquetes pour le mois dernier:

    $http.get("/survey/api/last-month.php", {params:{"lastMonth": lastMonth + 1, "lastMonthYear": lastMonthYear}})
        .success(function(data, status, headers, config){
            $scope.isloaded = true;
            if(!data.errors){
                var numEnquetes = data.datas["nombre_enquetes"] != null ? parseInt(data.datas["nombre_enquetes"]) : 0;
                var totalEnquetes = data.datas["enquetes_total_annee"] != null ? parseInt(data.datas["enquetes_total_annee"]) : 0;
                if(numEnquetes == 0){
                   $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour le mois de " + $scope.lastMonth + ". Le nombre total d'enquêtes depuis le début de l'année est de " + totalEnquetes + ".";
                } else if(numEnquetes <= 100){
                    $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre d'enquêtes enregistrées pour le mois de " + $scope.lastMonth + " est inférieur à 100 (" + numEnquetes + "). Nombre insuffisant pour que le dépouillement des ces données soit révélateur d'une tendance. Le nombre total d'enquêtes depuis le début de l'année est de " + totalEnquetes + ".";
                } else {
                    $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre d'enquêtes enregistrées pour le mois de " + $scope.lastMonth + " est de " + numEnquetes + ". Le nombre total d'enquêtes depuis le début de l'année est de " + totalEnquetes + ".";
                }
            } else {

            }
        })
        .error(function(data, status, headers, config){ /* relance */});




}]);
