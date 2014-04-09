<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 09/04/2014
 * Time: 13:39
 */
include_once "connection.php";

include_once "../../../libs/functions.php";

if( isGet() && isAjax() ){
    $errors = [];
    $response = ["datas"=>null, "errors"=>null];
    //sleep(3);//control loader
    if(isset($_GET["year"]) && $_GET["year"] != null){
        if(!is_numeric($_GET["year"]) || $_GET["year"] < 2009){
            $errors[] = "Year n'est pas une année de référence.";
        }
    } else {
        $errors[] = "Vous devez donner une année de référence.";
    }

    if($errors == null){
        header("Content-Type: application/json; charset=utf-8");
        $twoDigitsYear = $_GET["year"] - 2000;

        $totalYear = getNumTotalSurvey($twoDigitsYear);

        $effectifsAnnee = [];

        for($i=0; $i<12; $i++){
            $effectifMois = getNumSurveyByMonthAndYear($i+1, $twoDigitsYear);
            $percent = round(($effectifMois / $totalYear)*100, 2);

            $effectifsAnnee[] = ["effectifs_mois"=>$effectifMois, "percent_mois"=>$percent];
        }

        $response["datas"] = ["nombre_enquetes"=>$totalYear, "annee"=> $_GET["year"], "effectifs_annee"=>$effectifsAnnee];

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
