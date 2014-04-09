/**
 * Created by grosloup on 08/04/2014.
 */

var mainApp = angular.module("MainApp");

mainApp.controller("MainCtrl", ["$scope", "$window", function($scope, $window){
    $scope.slider = {
        direction: "",
        back: false
    };

    $scope.$on("$routeChangeSuccess", function(evt, next, current){
        $scope.slider.back = $window.location.hash != "#/";
    });

    $scope.setDirection = function(){
        $scope.slider.direction = "left";
    };

    $scope.back = function(){
        $scope.slider.direction = "right";
        $window.history.back();
    };
}]);
