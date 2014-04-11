/**
 * Created by grosloup on 10/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("DepsRegionEvolutionCtrl", ["$scope", "$sce", "$http","appCache", function($scope,$sce,$http,appCache){
    $scope.infos = "";
    var today = new Date();
    var ts = Math.round(today.getTime()/1000);
    $scope.monthes = [];
    Monthes.forEach(function(m){
        $scope.monthes.push(capitalizr(m));
    });
    $scope.isloaded = false;
    $scope.fullYear = today.getFullYear();

    $scope.chartCentre = {
        labels: $scope.monthes,
        datasets: []
    };

    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };

    if(appCache["evolution_region"] && ts<(appCache["evolution_region"]["ts"] + 57600)){
        $scope.isloaded = true;
        $scope.datas = appCache["evolution_region"].value;
    } else {
        $http.get("/survey/api/deps-region-evolution.php",{params:{year:$scope.fullYear}})
            .success(function(data,status,headers,configs){
                $scope.isloaded = true;
                if(!data.errors){
                    appCache["evolution_region"] = {
                        ts:ts,
                        value:data.datas
                    };
                    $scope.datas = data.datas;
                    console.log($scope.datas);
                } else {

                }
            })
            .error(function(data,status,headers,configs){

            });
    }


}]);