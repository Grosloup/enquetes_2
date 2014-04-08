<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 11:05
 */
session_start();

if(empty($_SESSION["user"])){

    if(!empty($_POST) && isset($_POST["login_form"])){
        if($_POST["login_form"]["pseudo"] == "nico" && $_POST["login_form"]["password"] =="nico"){
            $bodyFile = "body.php";

            $_SESSION["user"] = ["pseudo"=>"nico", "id"=>1];

            $_SESSION["isConnected"] = true;
        }
    } else {
        $bodyFile = "login.php";
    }

} else {
    $bodyFile = "body.php";
}


include_once "header.php";

include_once $bodyFile;

include_once "footer.php";
?>