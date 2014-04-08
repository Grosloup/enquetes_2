<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/04/2014
 * Time: 11:05
 */
session_start();

include_once "site_connexion.php";
include_once "../../libs/PasswordLib/PasswordLib.php";
include_once "../../libs/functions.php";

if(empty($_SESSION["user"])){
    $loginError = false;
    $loginMessage = "";
    if(!empty($_POST) && isset($_POST["login_form"])){

        if(isset($_POST["login_form"]["pseudo"]) && $_POST["login_form"]["pseudo"] != "" && isset($_POST["login_form"]["password"]) && $_POST["login_form"]["password"] != ""){
            $user = pseudoExists($_POST["login_form"]["pseudo"]);
            if($user){
                $passLib = new \PasswordLib\PasswordLib();
                if($passLib->verifyPasswordHash($_POST["login_form"]["password"], $user["password"])){
                    $loginError = false;
                    $bodyFile = "body.php";
                    $_SESSION["user"] = ["pseudo"=>$user["pseudo"], "id"=>$user["id"], "email"=>$user["email"], "nom"=>$user["nom"], "prenom"=>$user["prenom"]];
                    $_SESSION["isConnected"] = true;
                } else {
                    // mauvais password
                    $loginError = true;
                    $loginMessage = "Identifiants incorrects";
                    $bodyFile = "login.php";
                }
            } else {
                // pseudo n'existe pas
                $loginMessage = "Identifiants incorrects";
                $loginError = true;
                $bodyFile = "login.php";
            }
        } else {
            // champs manquants
            $loginMessage = "Informations manquantes, tous les champs sont requis";
            $loginError = true;
            $bodyFile = "login.php";
        }
    } else {

        $bodyFile = "login.php";
    }

} else {
    if(!empty($_GET)){
        if(isset($_GET["p"])){
            if($_GET["p"]=="logout"){
                // destruction de la session
                $_SESSION = [];
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,$params["path"], $params["domain"],$params["secure"], $params["httponly"]);
                }
                session_destroy();
                // redirection vers accueil
                header("Location: /survey/index.php");
                die();

            } elseif ($_GET["p"]=="mon-compte"){
                $bodyFile = "mon-compte.php";
            }
        }
    } else {
        $bodyFile = "body.php";
    }
}


include_once "header.php";

include_once $bodyFile;

include_once "footer.php";
?>
