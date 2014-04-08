<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 16:08
 */
?>

<div id="topnav-bar">
    <button id="sidebar-toggler"></button>
</div>

<div id="wrapper">
    <div id="sidebar">
        <ul>
            <li><a href="#/">Accueil</a></li>
            <li><a href="#/last-month">Les Stat' du mois dernier</a></li>
            <li><a href="#/cumul">Le cumul de l'année</a></li>
            <li><a href="#/period">Choisissez votre période</a></li>
        </ul>
    </div>
    <div id="main">
        <div ng-view=""></div>
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

        menuTogglerBtn.addEventListener("click", function(e){
            if(html.classList.contains("open-menu")){
                html.classList.remove("open-menu");
            } else {
                html.classList.add("open-menu");
            }
        },false)

    })(window,document);
</script>
<script src="/js/apps/survey/main.js"></script>
<script src="/js/apps/survey/controllers/MainCtrl.js"></script>
<script src="/js/apps/survey/controllers/LastMonthCtrl.js"></script>
