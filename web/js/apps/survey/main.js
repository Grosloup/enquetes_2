var mainApp = angular.module("MainApp", ["ngRoute", "ngSanitize", "ngAnimate", "angles"]);
var Monthes = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];

function capitalizr(word){
    return word.charAt(0).toUpperCase() + word.slice(1);
}


mainApp.config(["$routeProvider","$httpProvider", function($routeProvider, $httpProvider){

    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

    $routeProvider
        .when("/", { templateUrl: "/templates/survey/index.html"} )
        .when("/last-month", { templateUrl: "/templates/survey/last-month.html"})
        .when("/cumul", { templateUrl: "/templates/survey/cumul.html"})
        .when("/cumul/repartition-geographique",{templateUrl: "/templates/survey/repartition-geographique.html"})
        .when("/cumul/details-region",{templateUrl: "/templates/survey/details-region.html"})
        .when("/cumul/deps-region-evolution",{templateUrl: "/templates/survey/deps-region-evolution.html"})
        .when("/period", { templateUrl: "/templates/survey/period.html"})
        .otherwise({redirectTo: "/"});
}]);


mainApp.value("appCache", {});

mainApp.factory("CacheFct", function(){

    return {
        datas: {},
        get: function(key){
            if(this.datas.hasOwnProperty(key) && this.datas[key].ts + 57600000 > Date.now()){
                return this.datas[key].value;
            }
            return null;
        },
        set: function(key, value){
            this.datas[key] = {
                ts: Date.now(),
                value: value
            }
        }
    };

});
