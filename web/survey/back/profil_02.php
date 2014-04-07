<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 04/04/2014
 * Time: 09:54
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

$depsCentre = [18,28,36,37,41,45];
$depsParis = [75,77,78,91,92,93,94,95];
$depsLimit = [03,23,49,58,72,86,87,89];

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

include_once "header.php";
?>

<div id="main">
    <div class="row">
        <div class="col col1"></div>
        <div class="col col4">
            <h3>Départements d'habitation par région <small>Cumul <?php echo $lastYearFull ?></small></h3>

        </div>
        <div class="col col1"></div>
    </div>
    
    <!-- Région centre -->
    <div class="row">
        <div class="col col2">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>Région Centre</th>
                    <th>Effectifs</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($result as $v): ?>
                    <?php if(in_array($v["departement_num"], $depsCentre)): ?>
                        <tr>
                            <td><?php echo $v["departement_num"] . " - " . $v["departement"] ?></td>
                            <td><?php echo $v["num"] ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col col4">
            <canvas width="300" height="300" id="region-centre"></canvas>
        </div>
    </div>
    
    <!-- Région parisienne -->
    <div class="row">
        <div class="col col2">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>Région Parisiennne</th>
                    <th>Effectifs</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $v): ?>
                        <?php if(in_array($v["departement_num"], $depsParis)): ?>
                            <tr>
                                <td><?php echo $v["departement_num"] . " - " . $v["departement"] ?></td>
                                <td><?php echo $v["num"] ?></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col col4">
            <canvas width="300" height="300"></canvas>
        </div>
    </div>
    
    <!-- Départements limitrophes -->
    <div class="row">
        <div class="col col2">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>Départements limitrophes</th>
                    <th>Effectifs</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($result as $v): ?>
                    <?php if(in_array($v["departement_num"], $depsLimit)): ?>
                        <tr>
                            <td><?php echo $v["departement_num"] . " - " . $v["departement"] ?></td>
                            <td><?php echo $v["num"] ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col col4">
            <canvas width="300" height="300"></canvas>
        </div>
    </div>
</div>
<script>
    <?php $colors = ["#ff9341","#ffc839","#8fc1ff","#73ba99","#ffe28d","#6c87ff"]; $counter = 0;?>
    var ctx = document.querySelector("#region-centre").getContext("2d");
    var datas = [
    <?php foreach($result as $v): ?>
    <?php if(in_array($v["departement_num"], $depsCentre)): ?>
        <?php echo '{value:' . $v["num"] . ', color: "' . $colors[$counter] . '"}, ' ?>

    <?php $counter++; endif; ?>
    <?php endforeach ?>
    ];
    var options = {};
    var effectifsRegionChart = new Chart(ctx).Pie(datas,options);

</script>
</body>
</html>