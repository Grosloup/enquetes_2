<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 02/04/2014
 * Time: 09:58
 */
include_once "incs.php";
include_once "connection.php";
include_once "functions.php";

$currentDate = new DateTime();
$currentDay = $currentDate->format("j");
$currentMonth = $currentDate->format("n");
$currentYear = $currentDate->format("y");
$lastYearFull = (int) $currentDate->format("Y") - 1;
$lastYear = $currentYear-1;
$cumulForCurrentYear = getNumEntryPerMonth($currentMonth, $currentYear);
$sql = "SELECT COUNT() as numEnquete FROM visite WHERE annee=:annee AND departement_num != 100";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":annee", $lastYear);
$stmt->execute();
$numEnquete = $stmt->fetch()["numEnquete"];



$sql = "SELECT departement_num, departement, COUNT(*) as num FROM visite WHERE annee=:annee AND departement_num != 100 GROUP BY departement_num ORDER BY num DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":annee", $lastYear);
$stmt->execute();
$result = $stmt->fetchAll();
$countOther = 0;

for($i=10; $i<count($result); $i++){
    $countOther += $result[$i]["num"];
}
$depsCentre = [18,28,36,37,41,45];
$depsParis = [75,77,78,91,92,93,94,95];
$depsLimit = [03,23,49,58,72,86,87,89];

$effectifCentre = null;
$effectifParis = null;
$effectifLimit = null;
$effectifAute = null;

foreach($result as $k=>$v){
    if(in_array($v["departement_num"], $depsCentre)){
        $effectifCentre += $v["num"];
    }
    else if(in_array($v["departement_num"], $depsParis)){
        $effectifParis += $v["num"];
    }
    else if(in_array($v["departement_num"], $depsLimit)){
        $effectifLimit += $v["num"];
    } else {
        $effectifAute += $v["num"];
    }

}

/*$sql = "SELECT COUNT() as num FROM visite WHERE annee=:annee AND mois=:mois";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":annee", $currentYear);
$stmt->bindValue(":mois", $currentMonth);
$stmt->execute();
$result = $stmt->fetch()["num"];*/


include_once "header.php";
include_once "sidebar.php";

?>



<div id="main">
    <div class="row">
        <div class="col col1"></div>
        <div class="col col4">
            <h3>Régions et départements d'habitation les plus fortement cités <small>Cumul <?php echo $lastYearFull ?></small></h3>
        </div>
        <div class="col col1"></div>
    </div>
    <div class="row">

        <div class="col col3">
            <div class="row">
                <div class="col col1"></div>
                <div class="col col4">
                    <canvas id="effectifs-region" width="300" height="300"></canvas>
                </div>
                <div class="col col1"></div>
            </div>
            <div class="row">
                <div class="col col1"></div>

                <div class="col col4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Régions</th>
                            <th>Effectifs</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tr  style="background-color: #ff9341;">
                            <td>Région Centre</td>
                            <td><?php echo $effectifCentre; ?></td>
                            <td><?php if($numEnquete > 0) {echo ($effectifCentre/$numEnquete)*100;} ?></td>
                        </tr>
                        <tr  style="background-color: #8fc1ff;">
                            <td>Région Parisienne</td>
                            <td><?php echo $effectifParis; ?></td>
                            <td><?php if($numEnquete > 0) {echo ($effectifParis/$numEnquete)*100;} ?></td>
                        </tr>
                        <tr style="background-color: #ffc839;">
                            <td>Départements limitrophes</td>
                            <td><?php echo $effectifLimit; ?></td>
                            <td><?php if($numEnquete > 0) {echo ($effectifLimit/$numEnquete)*100;} ?></td>
                        </tr>
                        <tr style="background-color: #73ba99;">
                            <td>Autres</td>
                            <td><?php echo $effectifAute; ?></td>
                            <td><?php if($numEnquete > 0) {echo ($effectifAute/$numEnquete)*100;}?></td>
                        </tr>
                        <tr style="background-color: #0073b9;">
                            <td>Total</td>
                            <td><?php echo $numEnquete; ?></td>
                            <td>100%</td>
                        </tr>
                    </table>
                </div>
                <div class="col col1"></div>

            </div>
        </div>
        <div class="col col2">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th></th>
                    <th>Effectifs</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php if($result): ?>
                    <?php for($i=0; $i<10; $i++): ?>
                        <tr>
                            <td><?php echo $result[$i]["departement_num"] . " - " . $result[$i]["departement"]; ?></td>
                            <td><?php echo $result[$i]["num"]; ?></td>
                            <td><?php if($numEnquete > 0){echo ($result[$i]["num"]/$numEnquete)*100;}  ?></td>

                        </tr>
                    <?php endfor; ?>
                <?php else: ?>

                <?php endif; ?>
                <tr>
                    <td>Autres</td>
                    <td><?php echo $countOther; ?></td>
                    <td></td>
                </tr>
                </tbody>


            </table>
        </div>
        <div class="col col1"></div>
    </div>
</div>


<script src="/js/apps/survey/main.js"></script>
<script>
    var ctx = document.querySelector("#effectifs-region").getContext("2d");
    var datas = [
        <?php echo '{value:' . $effectifCentre . ', color: "#ff9341"}, ' ?>
        <?php echo '{value:' . $effectifLimit . ', color: "#ffc839"}, ' ?>
        <?php echo '{value:' . $effectifParis . ', color: "#8fc1ff"}, ' ?>
        <?php echo '{value:' . $effectifAute . ', color: "#73ba99"} ' ?>
    ];
    var options = {};
    var effectifsRegionChart = new Chart(ctx).Pie(datas,options);

</script>
</body>
</html>