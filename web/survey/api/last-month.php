<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/04/2014
 * Time: 12:29
 */
include_once "connection.php";

function isPost(){
    return strtolower($_SERVER["REQUEST_METHOD"]) === "post";
}

function isGet(){
    return strtolower($_SERVER["REQUEST_METHOD"]) === "get";
}

function isAjax(){
    if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest"){
        return true;
    }
    return false;
}

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
        if(!is_numeric($_GET["lastMonthYear"]) || $_GET["lastMonthYear"] < 2010){
            // error
            $errors[] = "lastMonthYear n'est pas du bon type.";
        }
    } else {
        // error
        $errors[] = "lastMonthYear est manquant.";
    }

    if($errors == null){
        header("Content-Type: application/json; charset=utf-8");
        $sql = "SELECT COUNT(*) as num FROM visite WHERE mois=:mois AND annee=:annee";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":mois", $_GET["lastMonth"]);
        $stmt->bindValue(":annee", $_GET["lastMonthYear"]);
        $stmt->execute();
        $result = $stmt->fetch();

        $response["datas"] = ["nombre_enquetes"=>$result["num"], "mois"=>$_GET["lastMonth"], "annee"=>$_GET["lastMonthYear"]];
        // TODO[Nicolas] enlever sleep test loader
        sleep(3); // test loader
        echo json_encode($response);

        die();
    } else {
        header("Content-Type: application/json; charset=utf-8");
        $response["errors"] = $errors;
        echo json_encode($response);
        die();
    }


} else {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode("nothing to do here");
    die();
}
