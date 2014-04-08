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
