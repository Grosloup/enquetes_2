<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 08/04/2014
 * Time: 23:46
 */

// utilitaires $_SERVER
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

// requetes db

function pseudoExists($pseudo){
    /** @var PDO $pdo_site */
    global $pdo_site;
    $sql = "SELECT * FROM users WHERE pseudo=:pseudo LIMIT 1";
    $stmt = $pdo_site->prepare($sql);
    $stmt->bindValue(":pseudo", $pseudo);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
}

function getNumTotalSurvey($year = 14){
    global $pdo;
    if(!is_numeric($year) || !preg_match("/^[1-4][0-9]$/", $year)){
        return null;
    }
    $sql = "SELECT COUNT() as totalSurvey FROM visite WHERE annee=:annee";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":annee", $year);
    $stmt->execute();
    return $stmt->fetch()["totalSurvey"];
}

function getNumSurveyByMonthAndYear($month = 1, $year = 14){
    global $pdo;
    if(!is_numeric($year) || !preg_match("/^[1-4][0-9]$/", $year)){
        return null;
    }
    if(!is_numeric($month) || !preg_match("/^[1-9]|1[0-2]$/", $month)){
        return null;
    }
    $sql = "SELECT COUNT() as totalMonthSurvey FROM visite WHERE mois=:mois AND annee=:annee";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":mois", $month);
    $stmt->bindValue(":annee", $year);
    $stmt->execute();
    return $stmt->fetch()["totalMonthSurvey"];
}

function effectifsParDeptEtAnnee($dept="", $annee=""){
    global $pdo;
    $sql = "SELECT COUNT() as effectif FROM visite WHERE departement_num=:dept AND annee=:annee";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":dept",$dept);
    $stmt->bindValue(":annee",$annee);
    $stmt->execute();
    return $stmt->fetch()["effectif"];


}

function effectifsParDeptEtMoisEtAnnee($dept="01", $mois=1, $annee=14){
    global $pdo;
    $sql = "SELECT COUNT() as effectif FROM visite WHERE departement_num=:dept AND mois=:mois AND annee=:annee";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":dept",$dept);
    $stmt->bindValue(":mois",$mois);
    $stmt->bindValue(":annee",$annee);
    $stmt->execute();
    return $stmt->fetch()["effectif"];


}

