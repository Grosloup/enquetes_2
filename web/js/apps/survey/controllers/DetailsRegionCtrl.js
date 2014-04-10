/**
 * Created by grosloup on 10/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("DetailsRegionCtrl", ["$scope", "$sce", "$http", function($scope, $sce, $http){

    $scope.infos = "";
    $scope.datas = {};
    var today = new Date();
    var ts = Math.round(today.getTime()/1000);
    $scope.isloaded = false;
    $scope.numEnquetes = 0;
    $scope.fullYear = today.getFullYear();
    $scope.chartOptions = {
        animation: false
    };
    /*$scope.chart = {
        centre:[],
        paris:[],
        limit:[]
    };*/
    //$scope.charts = [];
    $scope.centre = [];
    $scope.paris = [];
    $scope.limit = [];
    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };

    $scope.colors = ["#2e85a3","#2f6ba3","#33aecd","#378ecd","#30c3e1","#539ae1","#3bd1f5","#889bf5"];
    $http.get("/survey/api/details-region.php",{params:{year: $scope.fullYear}})
        .success(function(data,status,headers,configs){
            $scope.isloaded = true;
            if(!data.errors){
                $scope.datas = data.datas;
                data.datas.centre.deps.forEach(function(el,idx){
                    $scope.centre.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
                });
                data.datas.paris.deps.forEach(function(el,idx){
                    $scope.paris.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
                });

                data.datas.limit.deps.forEach(function(el,idx){
                    $scope.limit.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
                });

            } else {

            }
        })
        .error(function(data,status,headers,configs){

        });
}]);