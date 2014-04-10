var mainApp = angular.module("MainApp", ["ngRoute", "ngSanitize", "ngAnimate", "angles"]);



mainApp.config(["$routeProvider","$httpProvider", function($routeProvider, $httpProvider){

    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

    $routeProvider
        .when("/", { templateUrl: "/templates/survey/index.html"} )
        .when("/last-month", { templateUrl: "/templates/survey/last-month.html"})
        .when("/cumul", { templateUrl: "/templates/survey/cumul.html"})
        .when("/cumul/repartition-geographique",{templateUrl: "/templates/survey/repartition-geographique.html"})
        .when("/period", { templateUrl: "/templates/survey/period.html"})
        .otherwise({redirectTo: "/"});
}]);


mainApp.value("appCache", {});
