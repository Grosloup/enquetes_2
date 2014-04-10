/**
 * Created by Nicolas on 09/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("GeoRepartCtrl", ["$scope", "$sce", "$http", "appCache", function($scope, $sce, $http, appCache){

    $scope.infos = "";
    var today = new Date();
    var ts = Math.round(today.getTime()/1000);
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

    // TODO[Nicolas] refactorisation
    if(appCache["geo_repart"] && ts < (appCache["geo_repart"]["ts"]  + 57600)){
        $scope.isloaded = true;

        $scope.numEnquetes = (appCache["geo_repart"].value["nombre_enquetes"] != null) ? appCache["geo_repart"].value["nombre_enquetes"] : 0;
        $scope.datas = appCache["geo_repart"].value;
        if($scope.numEnquetes == 0){
            $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour l'année " + $scope.fullYear + ".";
        } else {
            $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
            var i= 0, colors=["#f54d4d","#df4df5","#4d94f5","#f0ee3a"];
            for(var zone in appCache["geo_repart"].value.effectifs_par_zone){
                if(appCache["geo_repart"].value.effectifs_par_zone.hasOwnProperty(zone)){
                    $scope.chart.data.push({
                        value:appCache["geo_repart"].value.effectifs_par_zone[zone].num,
                        color:colors[i]
                    });
                    $scope.chart.legend.push({
                        name: appCache["geo_repart"].value.effectifs_par_zone[zone].name,
                        num: appCache["geo_repart"].value.effectifs_par_zone[zone].num,
                        percent: appCache["geo_repart"].value.effectifs_par_zone[zone].percent,
                        color: colors[i]
                    });
                    i++;
                }
            }
        }

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
                        appCache["geo_repart"] = {
                            ts:ts,
                            value:data.datas
                        };
                        $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
                        var i= 0, colors=["#f54d4d","#df4df5","#4d94f5","#f0ee3a"];
                        for(var zone in data.datas.effectifs_par_zone){
                            if(data.datas.effectifs_par_zone.hasOwnProperty(zone)){
                                $scope.chart.data.push({
                                    value:data.datas.effectifs_par_zone[zone].num,
                                    color:colors[i]
                                });
                                $scope.chart.legend.push({
                                    name: data.datas.effectifs_par_zone[zone].name,
                                    num: data.datas.effectifs_par_zone[zone].num,
                                    percent: data.datas.effectifs_par_zone[zone].percent,
                                    color: colors[i]
                                });
                                i++;
                            }
                        }
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

}]);
