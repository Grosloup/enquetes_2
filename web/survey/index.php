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
