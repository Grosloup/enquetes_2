/**
 * Created by grosloup on 10/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("DetailsRegionCtrl", ["$scope", "$http", "CacheFct", function($scope, $http, CacheFct){

    $scope.datas = {};
    var today = new Date();
    $scope.isloaded = false;
    $scope.fullYear = today.getFullYear();
    $scope.chartOptions = {
        animation: false
    };
    $scope.centre = [];
    $scope.paris = [];
    $scope.limit = [];

    $scope.colors = ["#f54d4d","#df4df5","#4d94f5","#f0ee3a","#ed953e","#67da6a","#31d8b3","#fb9df8"];

    if(null !== ($scope.datas = CacheFct.get("details_region"))){
        $scope.isloaded = true;
        doCharts();
    } else {
        $http.get("/survey/api/details-region.php",{params:{year: $scope.fullYear}})
            .success(function(data,status,headers,configs){
                $scope.isloaded = true;
                if(!data.errors){
                    CacheFct.set("details_region", data.datas);
                    $scope.datas = data.datas;
                    doCharts();

                } else {
                    // TODO[Nicolas] error
                }
            })
            .error(function(data,status,headers,configs){
                // TODO[Nicolas] error
            });
    }

    function doCharts(){
        $scope.datas.centre.deps.forEach(function(el,idx){
            $scope.centre.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });
        $scope.datas.paris.deps.forEach(function(el,idx){
            $scope.paris.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });

        $scope.datas.limit.deps.forEach(function(el,idx){
            $scope.limit.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });
    }

}]);
