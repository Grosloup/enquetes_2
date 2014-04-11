/**
 * Created by grosloup on 10/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("DepsRegionEvolutionCtrl", ["$scope", "$http","CacheFct", function($scope, $http, CacheFct){

    var today = new Date();
    $scope.monthes = [];
    Monthes.forEach(function(m){
        $scope.monthes.push(capitalizr(m));
    });
    $scope.isloaded = false;
    $scope.fullYear = today.getFullYear();
    $scope.chartCompare = {
        labels: $scope.monthes,
        datasets: []
    };
    $scope.chartCompareOptions = {
        animation: false
    };
    $scope.chartOptions = {
        animation: false
    };
    $scope.chartCentre = {
        labels: $scope.monthes,
        datasets: []
    };
    $scope.chartParis = {
        labels: $scope.monthes,
        datasets: []
    };
    $scope.chartLimit = {
        labels: $scope.monthes,
        datasets: []
    };
    $scope.datas = {};

    $scope.colors = ["#f54d4d","#df4df5","#4d94f5","#f0ee3a","#ed953e","#67da6a","#31d8b3","#fb9df8"];
    if(null !== ($scope.datas = CacheFct.get("evolution_region"))){
        $scope.isloaded = true;
        doCharts();
    } else {
        $http.get("/survey/api/deps-region-evolution.php",{params:{year:$scope.fullYear}})
            .success(function(data,status,headers,configs){
                $scope.isloaded = true;
                if(!data.errors){
                    CacheFct.set("evolution_region", data.datas);
                    $scope.datas = data.datas;
                    doCharts();
                } else {

                }
            })
            .error(function(data,status,headers,configs){

            });
    }


    function doCharts(){
        $scope.datas.centre.depts.forEach(function(el,idx){
            $scope.chartCentre.datasets.push({
                fillColor: $scope.colors[idx],
                strokeColor: $scope.colors[idx],
                data: el.effectifMois
            });
        });

        $scope.datas.paris.depts.forEach(function(el,idx){
            $scope.chartParis.datasets.push({
                fillColor: $scope.colors[idx],
                strokeColor: $scope.colors[idx],
                data: el.effectifMois
            });
        });

        $scope.datas.limit.depts.forEach(function(el,idx){
            $scope.chartLimit.datasets.push({
                fillColor: $scope.colors[idx],
                strokeColor: $scope.colors[idx],
                data: el.effectifMois
            });
        });

        $scope.chartCompare.datasets.push({
            fillColor: "rgba(245,77,77,0.1)",
            strokeColor: $scope.colors[0],
            data: $scope.datas.compare.percentParMoisEtZone.centre
        });

        $scope.chartCompare.datasets.push({
            fillColor: "rgba(223,77,245,0.1)",
            strokeColor: $scope.colors[1],
            data: $scope.datas.compare.percentParMoisEtZone.paris
        });

        $scope.chartCompare.datasets.push({
            fillColor: "rgba(77,148,245,0.1)",
            strokeColor: $scope.colors[2],
            data: $scope.datas.compare.percentParMoisEtZone.limit
        });

        $scope.chartCompare.datasets.push({
            fillColor: "rgba(240,238,58,0.1)",
            strokeColor: $scope.colors[3],
            data: $scope.datas.compare.percentParMoisEtZone.autres
        });
    }


}]);
