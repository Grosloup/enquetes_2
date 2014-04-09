<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 16:05
 */
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr" <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]){ echo 'ng-app="MainApp"';} ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="fr" <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]){ echo 'ng-app="MainApp"';} ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="fr" <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]){ echo 'ng-app="MainApp"';} ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr" <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]){ echo 'ng-app="MainApp"';} ?>> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Statistiques sorties des enquêtes</title>
    <link rel="stylesheet" href="/css/survey.css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/css/animate.min.css"/>
    <script src="/js/vendor/modernizr.js"></script>

    <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]): ?>
        <script src="/js/vendor/jquery-2.1.0.min.js"></script>
        <script src="/js/vendor/Chart.min.js"></script>
        <script src="/js/vendor/angular.js"></script>
        <script src="/js/vendor/angular-route.js"></script>
        <script src="/js/vendor/angular-sanitize.js"></script>
        <script src="/js/vendor/angular-animate.js"></script>
        <script src="/js/vendor/angles.js"></script>

    <?php endif; ?>
</head>
<body <?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]){ echo 'ng-controller="MainCtrl"';} ?>>
