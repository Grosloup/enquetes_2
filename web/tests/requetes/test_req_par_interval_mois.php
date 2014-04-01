<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 01/04/2014
 * Time: 17:12
 */
define("ROOT_LIB", realpath(dirname(dirname(dirname(__DIR__)))).DIRECTORY_SEPARATOR."libs");
ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR. ROOT_LIB );
include_once "PHPExcel/PHPExcel.php";
include_once "PHPExcel/PHPExcel/Writer/Excel2007.php";

include_once "../../../datas/all.php";

try {
    $pdo = new PDO("sqlite:../../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die($e->getMessage());
}
$mois_inf = 5;
$mois_sup = 11;

$sql = "SELECT annee FROM visite WHERE mois=:mois LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", $mois_inf+1);
$stmt->execute();
$annee = $stmt->fetch()["annee"];



$mois_inf = 5;
$mois_sup = 11;
$sql = "SELECT COUNT() as num FROM visite WHERE mois>:mois_inf AND mois<=:mois_sup";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois_inf", $mois_inf);
$stmt->bindValue(":mois_sup", $mois_sup );
$stmt->execute();

$nbreVisiteurs = $stmt->fetch()["num"];


$mois = range($mois_inf+1, $mois_sup);

$effectifsByMonth = [];
$residu = 0;
foreach($mois as $m){
    $sql = "SELECT COUNT() as num FROM visite WHERE mois=:mois";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mois", $m);
    $stmt->execute();
    $effectif = $stmt->fetch()["num"];
    $reelPercent = ($effectif / $nbreVisiteurs) * 100;
    $percentFloor = floor($reelPercent);
    $residu = ($reelPercent - $percentFloor);
    if($residu <= 0.5){
        $percent = floor($reelPercent);
    } else {
        $percent = ceil($reelPercent);
    }
    $effectifsByMonth[] = ["mois"=>$datas_mois[$m-1], "effectif"=>$effectif, "pourcentage"=>$percent];
}
$objExcel = new PHPExcel();

$objExcel->setActiveSheetIndex(0);

$objExcel->getActiveSheet()->setTitle("Test Visiteurs");
$objExcel->getActiveSheet()->setCellValue("A1", "");
$objExcel->getActiveSheet()->setCellValue("B1", "Effectifs");
$objExcel->getActiveSheet()->setCellValue("C1", "%");
$counter = 2;
foreach($effectifsByMonth as $v){
    $objExcel->getActiveSheet()->setCellValue("A".$counter, ucfirst($v["mois"]) . " 20" . $annee);
    $objExcel->getActiveSheet()->setCellValue("B".$counter, $v["effectif"]);
    $objExcel->getActiveSheet()->setCellValue("C".$counter, $v["pourcentage"]);
}
$xlWriter = new PHPExcel_Writer_Excel2007($objExcel);
$xlWriter->save(str_replace(".php",".xlsx",__FILE__));


