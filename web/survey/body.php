<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 16:08
 */
?>

<div id="topnav-bar">

    <div class="nav">
        <ul>
            <li><button id="sidebar-toggler"></button></li>
            <li><button id="back-btn" ng-click="back()" ng-show="slider.back"></button></li>
        </ul>
    </div>
    <div class="nav nav-right">
        <ul>
            <li><a href="/survey/index.php?p=mon-compte">Mon compte</a></li>
            <li><a href="/survey/index.php?p=logout">Déconnexion</a></li>
        </ul>
    </div>
</div>
<div id="wrapper">
    <div id="sidebar">
        <ul id="sb-menu">
            <li><a href="#/" class="sb-menu-item" ng-click="setDirection()">Accueil</a></li>
            <li><a href="#/last-month" class="sb-menu-item" ng-click="setDirection()">Les Stat' du mois dernier</a></li>
            <li><a href="#/cumul" class="sb-menu-item" ng-click="setDirection()">Le cumul de l'année</a></li>
            <li><a href="#/period" class="sb-menu-item" ng-click="setDirection()">Choisissez votre période</a></li>
            <li><a href="#/period" class="sb-menu-item" ng-click="setDirection()">Et plus encore</a></li>
        </ul>
    </div>
    <div id="main">
        <div class="page {{slider.direction}}" ng-view=""></div>
    </div>
</div>


<script>
    (function(w,d){

        function setMaxHeight(_node, relative){
            var wh;
            var h = _node.offsetHeight;
            if(!relative){
                relative = w;
                wh = w.innerHeight
            } else {
                wh = relative.offsetHeight;
            }
            if(wh > h){
                _node.style.height = wh + "px";
            } else {
                if(relative != w){
                    relative.style.height = h + "px";
                }
            }
        }

        var wrapper = d.querySelector("#wrapper"),
            sidebar = d.querySelector("#sidebar"),
            menuTogglerBtn = d.querySelector("#sidebar-toggler"),
            html = d.querySelector("html");


        setMaxHeight(wrapper);
        setMaxHeight(sidebar, wrapper);
        w.addEventListener("resize", function(){
            setMaxHeight(wrapper);
            setMaxHeight(sidebar, wrapper);
        },false);

        menuTogglerBtn.addEventListener("click", function(evt){
            evt.preventDefault();
            if(html.classList.contains("open-menu")){
                html.classList.remove("open-menu");
            } else {
                html.classList.add("open-menu");
            }
        },false);

        var sbMenuItems = d.querySelectorAll(".sb-menu-item");
        [].slice.call(sbMenuItems).forEach(function(el){
           el.addEventListener("click", function(){
               if(html.classList.contains("open-menu")){
                   html.classList.remove("open-menu");
               } else {
                   html.classList.add("open-menu");
               }
           })
        });




    })(window,document);
</script>
<script src="/js/apps/survey/main.js"></script>
<script src="/js/apps/survey/controllers/MainCtrl.js"></script>
<script src="/js/apps/survey/controllers/LastMonthCtrl.js"></script>
