<?php
define("ROOT_LIB", realpath(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR."libs");

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR. ROOT_LIB );


try {
    $pdo = new PDO("sqlite:../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die($e->getMessage());
}


$visitorsSql = "SELECT * FROM visiteur LIMIT 50";

$stmt = $pdo->prepare($visitorsSql);

$stmt->execute();

$visitors = $stmt->fetchAll();

var_dump($visitors);

include_once "PHPExcel/PHPExcel.php";
include_once "PHPExcel/PHPExcel/Writer/Excel2007.php";

$objExcel = new PHPExcel();

$objExcel->setActiveSheetIndex(0);
$objExcel->getActiveSheet()->setTitle("Test Visiteurs");
$objExcel->getActiveSheet()->setCellValue("A1", "Genre");
$objExcel->getActiveSheet()->setCellValue("B1", "Nom");
$objExcel->getActiveSheet()->setCellValue("C1", "Prenom");
$objExcel->getActiveSheet()->setCellValue("D1", "Email");
$objExcel->getActiveSheet()->setCellValue("E1", "Département");
$objExcel->getActiveSheet()->setCellValue("F1", "Pays");
$objExcel->getActiveSheet()->setCellValue("G1", "Veux Infos");
$counter = 2;
foreach($visitors as $visitor){
    $infos = ((int)$visitor["veux_infos_zoo"] == 1)?"oui":"non";
    $objExcel->getActiveSheet()->setCellValue("A".$counter, $visitor["genre"]);
    $objExcel->getActiveSheet()->setCellValue("B".$counter, $visitor["nom"]);
    $objExcel->getActiveSheet()->setCellValue("C".$counter, $visitor["prenom"]);
    $objExcel->getActiveSheet()->setCellValue("D".$counter, $visitor["email"]);
    $objExcel->getActiveSheet()->setCellValue("E".$counter, $visitor["departement"]);
    $objExcel->getActiveSheet()->setCellValue("F".$counter, $visitor["pays"]);
    $objExcel->getActiveSheet()->setCellValue("G".$counter, $infos);
    $counter++;
}
$xlWriter = new PHPExcel_Writer_Excel2007($objExcel);
$xlWriter->save(str_replace(".php",".xlsx",__FILE__));