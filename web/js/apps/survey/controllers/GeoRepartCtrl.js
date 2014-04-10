/**
 * Created by Nicolas on 09/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("GeoRepartCtrl", ["$scope", "$sce", "$http", function($scope, $sce, $http){

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

    // TODO[Nicolas] mise en cache
    $http.get("/survey/api/georepart.php", {params:{year: $scope.fullYear}})
        .success(function(data,status,headers,config){
            $scope.isloaded = true;
            if(!data.errors){
                $scope.numEnquetes = (data.datas["nombre_enquetes"] != null) ? parseInt(data.datas["nombre_enquetes"]) : 0;
                $scope.datas = data.datas;
                if($scope.numEnquetes == 0){
                    $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Il n'y a pas (encore) de données enregistrées pour l'année " + $scope.fullYear + ".";
                }else {
                    $scope.infos = "<i class='fa fa-info-circle text-blue'></i> Le nombre total d'enquêtes depuis le début de l'année est de " + $scope.numEnquetes + ".";
                }
                console.log(data.datas);


                var i= 0, colors=["#e08427","#2e85a3","#31974f","#e45449"];
                for(var zone in data.datas.effectifs_par_zone){
                    console.log(zone);
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
                console.log($scope.chart);



            } else {
                // TODO[Nicolas] relance en cas d'erreur
            }


        })
        .error(function(data,status,headers,config){
            /* relance */
            // TODO[Nicolas] relance en cas d'erreur serveur
        });
}]);
