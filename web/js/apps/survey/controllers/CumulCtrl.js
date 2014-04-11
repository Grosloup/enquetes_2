/**
 * Created by Nicolas on 09/04/2014.
 */
var mainApp = angular.module("MainApp");



mainApp.controller("CumulCtrl", ["$scope", "$sce", "$http", "CacheFct", function($scope, $sce, $http, CacheFct){
    $scope.infos = "";
    var today = new Date();
    $scope.fullYear = today.getFullYear();
    $scope.isloaded = false;
    $scope.numEnquetes = 0;
    $scope.effectifs = [];
    $scope.monthes = [];
    $scope.datas = {};
    Monthes.forEach(function(m){
        $scope.monthes.push(capitalizr(m));
    });
    $scope.chartOptions = {
        animation: false
    };
    var datasToChart = [];
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
    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };
    if(null !== ($scope.datas = CacheFct.get("cumul_annee"))){
        $scope.isloaded = true;
        $scope.effectifs = $scope.datas["effectifs_annee"];
        doCharts();
    } else {
        $http.get("/survey/api/cumul.php", {params:{year: $scope.fullYear}})
            .success(function(data,status,headers,config){
                $scope.isloaded = true;
                if( !data.errors ){
                    $scope.numEnquetes = (data.datas["nombre_enquetes"] != null) ? parseInt(data.datas["nombre_enquetes"]) : 0;
                    if($scope.numEnquetes == 0){
                        $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour l'année " + $scope.fullYear + ".";
                    } else {
                        CacheFct.set("cumul_annee", data.datas);
                        $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
                        $scope.effectifs = data.datas["effectifs_annee"];
                        doCharts();
                    }
                } else {
                    // TODO[Nicolas] relance en cas d'erreur
                }
            })
            .error(function(data,status,headers,config){
                /* relance */
                // TODO[Nicolas] relance en cas d'erreur serveur
            });
    }

    function doCharts(){
        $scope.effectifs.forEach(function(eff){
            datasToChart.push(parseInt(eff["effectifs_mois"]));
        });
        $scope.chart.datasets[0].data = datasToChart;
    }
}]);
