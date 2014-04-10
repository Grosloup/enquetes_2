/**
 * Created by grosloup on 10/04/2014.
 */
var mainApp = angular.module("MainApp");

mainApp.controller("DetailsRegionCtrl", ["$scope", "$sce", "$http", "appCache", function($scope, $sce, $http, appCache){

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
    $scope.centre = [];
    $scope.paris = [];
    $scope.limit = [];
    $scope.trustHtmlMessage = function(message){
        return $sce.trustAsHtml(message);
    };

    $scope.colors = ["#f54d4d","#df4df5","#4d94f5","#f0ee3a","#ed953e","#67da6a","#31d8b3","#fb9df8"];

    // TODO[Nicolas] refactor
    if(appCache["details_region"] && ts < (appCache["details_region"]["ts"] + 57600)){
        $scope.isloaded = true;
        $scope.datas = appCache["details_region"].value;
        appCache["details_region"].value.centre.deps.forEach(function(el,idx){
            $scope.centre.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });
        appCache["details_region"].value.paris.deps.forEach(function(el,idx){
            $scope.paris.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });

        appCache["details_region"].value.limit.deps.forEach(function(el,idx){
            $scope.limit.push({value: parseInt(el.effectif), color:$scope.colors[idx]});
        });

    } else {
        $http.get("/survey/api/details-region.php",{params:{year: $scope.fullYear}})
            .success(function(data,status,headers,configs){
                $scope.isloaded = true;
                if(!data.errors){
                    // TODO[Nicolas] msg d'nfos
                    appCache["details_region"] = {
                        ts:ts,
                        value: data.datas
                    };
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
                    // TODO[Nicolas] error
                }
            })
            .error(function(data,status,headers,configs){
                // TODO[Nicolas] error
            });
    }

}]);
