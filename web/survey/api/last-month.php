<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/04/2014
 * Time: 12:29
 */
include_once "connection.php";

include_once "../../../libs/functions.php";

if( isGet() && isAjax()){

    // parametre en $_GET {"lastMonth": lastMonth + 1, "lastMonthYear": lastMonthYear}

    $errors = [];
    $response = ["datas"=>null, "errors"=>null];
    if(isset($_GET["lastMonth"]) && $_GET["lastMonth"] != null){
        if(!is_numeric($_GET["lastMonth"]) || $_GET["lastMonth"] < 1 || $_GET["lastMonth"] > 12){
            // error
            $errors[] = "lastMonth n'est pas du bon type.";
        }
    } else {
        // error
        $errors[] = "lastMonth est manquant.";
    }
    if(isset($_GET["lastMonthYear"]) && $_GET["lastMonthYear"] != null){
        if(!is_numeric($_GET["lastMonthYear"]) || $_GET["lastMonthYear"] < 2009){
            // error
            $errors[] = "lastMonthYear n'est pas du bon type.";
        }
    } else {
        // error
        $errors[] = "lastMonthYear est manquant.";
    }

    if($errors == null){
        header("Content-Type: application/json; charset=utf-8");
        $twoDigitsYear = $_GET["lastMonthYear"] - 2000;
        /*$sql = "SELECT COUNT(*) as num FROM visite WHERE mois=:mois AND annee=:annee";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":mois", $_GET["lastMonth"]);
        $stmt->bindValue(":annee", $twoDigitsYear);
        $stmt->execute();
        $result = $stmt->fetch();*/

        $result = getNumSurveyByMonthAndYear($_GET["lastMonth"], $twoDigitsYear);
        $totalYear = getNumTotalSurvey($twoDigitsYear);

        $response["datas"] = ["nombre_enquetes"=>$result, "mois"=>$_GET["lastMonth"], "annee"=>$_GET["lastMonthYear"], "enquetes_total_annee"=>$totalYear];

        echo json_encode($response);

        die();
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $response["errors"] = $errors;
        echo json_encode($response);
        die();
    }


} else {
    header("Content-Type: text/html; charset=utf-8");
    echo json_encode("nothing to do here");
    die();
}
