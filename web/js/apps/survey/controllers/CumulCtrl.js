/**
 * Created by Nicolas on 09/04/2014.
 */
var mainApp = angular.module("MainApp");

var Monthes = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

function capitalizr(word){
    return word.charAt(0).toUpperCase() + word.slice(1);
}

mainApp.controller("CumulCtrl", ["$scope", "$sce", "$http", function($scope, $sce, $http){

    $scope.infos = "";
    var today = new Date();
    $scope.isloaded = false;
    $scope.numEnquetes = 0;
    $scope.effectifs = [];
    $scope.monthes = [];
    Monthes.forEach(function(m){
        $scope.monthes.push(capitalizr(m));
    });
    $scope.chartOptions = {
        animation: false
    };
    $scope.chart = {
        labels : $scope.monthes,
        datasets: [
            {
                fillColor : "rgba(46,133,163,.5)",
                strokeColor : "#2e85a3",
                pointColor : "rgba(46,133,163,.5)",
                pointStrokeColor : "#2e85a3",
                data : []
            }
        ]

    };



    $scope.fullYear = today.getFullYear();

    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };

    $http.get("/survey/api/cumul.php", {params:{year: $scope.fullYear}})
        .success(function(data,status,headers,config){
            $scope.isloaded = true;
            console.log(data);
            if( !data.errors ){

                $scope.numEnquetes = (data.datas["nombre_enquetes"] != null) ? parseInt(data.datas["nombre_enquetes"]) : 0;
                 if($scope.numEnquetes == 0){
                     $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour l'année " + $scope.fullYear + ".";
                 } else {
                     $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
                     $scope.effectifs = data.datas["effectifs_annee"];

                     var datasToChart = [];

                     $scope.effectifs.forEach(function(eff){
                         datasToChart.push(parseInt(eff["effectifs_mois"]));
                     });
                     console.log(datasToChart);

                     $scope.chart.datasets[0].data = datasToChart;
                 }

            } else {

            }
        })
        .error(function(data,status,headers,config){
            /* relance */
        });
}]);