 <?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/03/2014
 */

 include_once "../datas/depts.php";
 include_once "../datas/pays.php";
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title></title>

    <!-- <link rel="stylesheet" href="/web/css/master.css"/>
    <link rel="stylesheet" href="/web/css/font-awesome.min.css"/> -->

    <link rel="stylesheet" href="/css/master.css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css"/>

    <script src="/js/vendor/modernizr.js"></script>

</head>
<body>
<!-- if html.lt-ie9 -->
<div class="browserhappy">
    <p>Vous utilisez une version d'internet explorer incompatible avec ce site. Mettez à jour internet explorer vers la version 11, ou utilisez des navigateurs tels que
        <a href="https://www.google.com/intl/fr/chrome/browser/">Google Chrome</a>, <a href="http://www.mozilla.org/en-US/firefox/all/">Firefox</a>,...</p>
</div>

<div id="main-front">
    <div class="container">
            <div id="front-menu">
                <div class="gridder-4-1">
                    <div class="grid-block">
                        <div class="block-menu">
                            <div class="text">
                                Enquetes
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gridder-4-4">
                        <div class="grid-block"></div>
                        <div class="grid-block">
                            <div class="block-menu">
                                <a href="/enquete.php">
                                <!--<a href="/web/enquete.php">-->
                                    <div class="icon">
                                        <i class="fa fa-list-ol"></i>
                                    </div>
                                    <div class="text">
                                        Saisie
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="grid-block">
                            <div class="block-menu">
                                <a href="/statistiques.php">
                                <!--<a href="/web/statistiques.php">-->
                                    <div class="icon">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="text">
                                        Statistiques
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="grid-block">
                            <div class="block-menu">
                                <a href="/tests">
                                    <!--<a href="/web/statistiques.php">-->
                                    <div class="icon">
                                        <i class="fa fa-bug"></i>
                                    </div>
                                    <div class="text">
                                        tests
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
</div>
</body>
</html>
