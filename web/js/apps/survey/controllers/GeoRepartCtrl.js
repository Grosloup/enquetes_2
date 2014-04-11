/**
 * Created by Nicolas on 09/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("GeoRepartCtrl", ["$scope", "$sce", "$http", "CacheFct", function($scope, $sce, $http, CacheFct){
    $scope.datas = {};
    $scope.infos = "";
    var today = new Date();
    $scope.isloaded = false;
    $scope.numEnquetes = 0;
    $scope.fullYear = today.getFullYear();
    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };
    $scope.chartOptions = {
        animation: false
    };
    $scope.chart = {data:[],legend:[]};
    if(null !== ($scope.datas = CacheFct.get("geo_repart"))){
        $scope.isloaded = true;
        $scope.numEnquetes = $scope.datas["nombre_enquetes"];
        doCharts();
    } else {
        $http.get("/survey/api/georepart.php", {params:{year: $scope.fullYear}})
            .success(function(data,status,headers,config){
                $scope.isloaded = true;
                if(!data.errors){
                    $scope.numEnquetes = (data.datas["nombre_enquetes"] != null) ? parseInt(data.datas["nombre_enquetes"]) : 0;
                    $scope.datas = data.datas;
                    if($scope.numEnquetes == 0){
                        $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour l'année " + $scope.fullYear + ".";
                    }else {
                        CacheFct.set("geo_repart", data.datas);
                        $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
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
        var i= 0, colors=["#f54d4d","#df4df5","#4d94f5","#f0ee3a"];
        for(var zone in $scope.datas.effectifs_par_zone){
            if($scope.datas.effectifs_par_zone.hasOwnProperty(zone)){
                $scope.chart.data.push({
                    value:$scope.datas.effectifs_par_zone[zone].num,
                    color:colors[i]
                });
                $scope.chart.legend.push({
                    name: $scope.datas.effectifs_par_zone[zone].name,
                    num: $scope.datas.effectifs_par_zone[zone].num,
                    percent: $scope.datas.effectifs_par_zone[zone].percent,
                    color: colors[i]
                });
                i++;
            }
        }
    }

}]);
