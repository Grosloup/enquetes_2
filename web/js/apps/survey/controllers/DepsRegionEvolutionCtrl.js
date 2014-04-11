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
    $scope.chartCompare = {
        labels: $scope.monthes,
        datasets: []
    };
    $scope.chartCompareOptions = {
        animation: false,
        //datasetFill : false
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

    $scope.colors = ["#f54d4d","#df4df5","#4d94f5","#f0ee3a","#ed953e","#67da6a","#31d8b3","#fb9df8"];
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
                        fillColor: "rgba(245,77,77,0.6)",
                        strokeColor: $scope.colors[0],
                        data: $scope.datas.compare.percentParMoisEtZone.centre
                    });

                    $scope.chartCompare.datasets.push({
                        fillColor: "rgba(223,77,245,0.6)",
                        strokeColor: $scope.colors[1],
                        data: $scope.datas.compare.percentParMoisEtZone.paris
                    });

                    $scope.chartCompare.datasets.push({
                        fillColor: "rgba(77,148,245,0.6)",
                        strokeColor: $scope.colors[2],
                        data: $scope.datas.compare.percentParMoisEtZone.limit
                    });

                    $scope.chartCompare.datasets.push({
                        fillColor: "rgba(240,238,58,0.6)",
                        strokeColor: $scope.colors[3],
                        data: $scope.datas.compare.percentParMoisEtZone.autres
                    });



                } else {

                }
            })
            .error(function(data,status,headers,configs){

            });
    }


}]);