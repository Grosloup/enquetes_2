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
            <!--<li><button id="back-btn" ng-click="back()" ng-show="slider.back"></button></li>-->
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
            <li>
                <ul><h3 class="sb-menu-header">Le cumul de l'année</h3>
                    <li><a href="#/cumul" class="sb-menu-item" ng-click="setDirection()">l'échantillon</a></li>
                    <li><a href="#/cumul/repartition-geographique" class="sb-menu-item" ng-click="setDirection()">Régions et départements les plus cités</a></li>
                    <li><a href="#/cumul/details-region" class="sb-menu-item" ng-click="setDirection()">Détails des régions</a></li>
                    <li><a href="#/cumul/deps-region-evolution" class="sb-menu-item" ng-click="setDirection()">Régions et départements d'habitation - évolution</a></li>
                    <li></li>
                </ul>
            </li>
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
           el.addEventListener("click", function(evt){
               if(html.classList.contains("open-menu")){
                   html.classList.remove("open-menu");
               } else {
                   html.classList.add("open-menu");
               }
           })
        });




    })(window,document);
</script>
<?php if(isset($_SESSION["isConnected"]) && $_SESSION["isConnected"]): ?>
    <script src="/js/vendor/jquery-2.1.0.min.js"></script>
    <script src="/js/vendor/Chart.min.js"></script>
    <script src="/js/vendor/angular.js"></script>
    <script src="/js/vendor/angular-route.js"></script>
    <script src="/js/vendor/angular-sanitize.js"></script>
    <script src="/js/vendor/angular-animate.js"></script>
    <script src="/js/vendor/angles.js"></script>

<?php endif; ?>
<script src="/js/apps/survey/main.js"></script>
<script src="/js/apps/survey/controllers/MainCtrl.js"></script>
<script src="/js/apps/survey/controllers/LastMonthCtrl.js"></script>
<script src="/js/apps/survey/controllers/CumulCtrl.js"></script>
<script src="/js/apps/survey/controllers/GeoRepartCtrl.js"></script>
<script src="/js/apps/survey/controllers/DetailsRegionCtrl.js"></script>
<script src="/js/apps/survey/controllers/DepsRegionEvolutionCtrl.js"></script>
