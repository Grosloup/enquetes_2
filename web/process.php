<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 30/03/2014
 * Time: 12:49
 */
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);

if (empty($_POST) || empty($_POST["form"]) || empty($_POST["form"]["q_1"])) {
    die("Erreur...");
}

$formArr = $_POST["form"];
$date = explode("/", $formArr["q_1"]);


$form["jour"] = $date[0]; //date de vst - normalemt non null
$form["mois"] = $date[1]; //date de vst - normalemt non null
$form["annee"] = isset($formArr["q_1_1"]) ? $formArr["q_1_1"] : null; //année de vst - normalemt non null
$form["departement"] = isset($formArr["q_2"]) ? $formArr["q_2"] : null; // departement
if ($form["departement"]) {
    $form["departement_num"] = trim(explode("-", $form["departement"])[0]);
} else {
    $form["departement_num"] = null;
}
$form["pays"] = (isset($formArr["q_2_1"]) && $formArr["q_2_1"] != "") ? $formArr["q_2_1"] : "France"; // pays si departement 100
$form["jour_passe_id"] = isset($formArr["q_3"]) ? $formArr["q_3"] : null; // jours passés sur zoo 1 ou 2
$form["context_visite_id"] = isset($formArr["q_4_1"]) ? $formArr["q_4_1"] : null; // context
$form["duree_sejour_id"] = isset($formArr["q_4_2"]) ? $formArr["q_4_2"] : null; // durée du séjour
$form["residence_id"] = isset($formArr["q_4_3"]) ? $formArr["q_4_3"] : null; // lieu de residence durant séjour
$form["temps_trajet_id"] = isset($formArr["q_5"]) ? $formArr["q_5"] : null; // temps de trajet
$form["deja_venu"] = isset($formArr["q_6"]) ? $formArr["q_6"] : null; // deja venu -normalement non null
$form["nombre_visite_id"] = isset($formArr["q_6_1"]) ? $formArr["q_6_1"] : null; // si deja venu,combien de fois
$form["derniere_visite_id"] = isset($formArr["q_6_2"]) ? $formArr["q_6_2"] : null; // a quand la dernière visite
$form["programmation_id"] = isset($formArr["q_7"]) ? $formArr["q_7"] : null; // visite programmée ou pas
$form["qd_prog"] = isset($formArr["q_7_1"]) ? $formArr["q_7_1"] : null; // programmée depuis quand
$form["panda_savoir"] = isset($formArr["q_8"]) ? $formArr["q_8"] : null; // connaissance pandas
$form["panda_decide"] = isset($formArr["q_8_1"]) ? $formArr["q_8_1"] : null; // panda influence visite


$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_0"]["way"]) ? $formArr["q_9"]["q_9_0"]["way"] : 0; // bouche-oreilles


$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_1"]["way"]) ? $formArr["q_9"]["q_9_1"]["way"] : 0; //  par affiches
$form["affichage_type"] = isset($formArr["q_9"]["q_9_1"]["how"]) ? $formArr["q_9"]["q_9_1"]["how"] : null; // grd affiche
// pour chaque valeur de $form[affichage_type] => une ligne dans affichage_type_visiteur_date

$form["paris_1"] = isset($formArr["q_9"]["q_9_1"]["where_1"]["paris"]) ? 1 : null;
$form["province_1"] = isset($formArr["q_9"]["q_9_1"]["where_1"]["province"]) ? 1 : null;

$form["paris_2"] = isset($formArr["q_9"]["q_9_1"]["where_2"]["paris"]) ? 1 : null; // array
$form["province_2"] = isset($formArr["q_9"]["q_9_1"]["where_2"]["province"]) ? 1 : null; // array

$form["paris_3"] = isset($formArr["q_9"]["q_9_1"]["where_3"]["paris"]) ? 1 : null; // array
$form["province_3"] = isset($formArr["q_9"]["q_9_1"]["where_3"]["province"]) ? 1 : null; // array

$form["paris_4"] = isset($formArr["q_9"]["q_9_1"]["where_4"]["paris"]) ? 1 : null; // array
$form["province_4"] = isset($formArr["q_9"]["q_9_1"]["where_4"]["province"]) ? 1 : null; // array


$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_2"]["way"]) ? $formArr["q_9"]["q_9_2"]["way"] : 0; // pub media
$form["pub_where"] = isset($formArr["q_9"]["q_9_2"]["how"]) ? $formArr["q_9"]["q_9_2"]["how"] : null; // array
// pour chaque valeur de $form[pub_where] => une ligne dans pub_media_visiteur_date

$form["pub_paris_1"] = isset($formArr["q_9"]["q_9_2"]["where_1"]["paris"]) ? 1 : null; // array
$form["pub_province_1"] = isset($formArr["q_9"]["q_9_2"]["where_1"]["province"]) ? 1 : null; // array
$form["pub_paris_2"] = isset($formArr["q_9"]["q_9_2"]["where_2"]["paris"]) ? 1 : null; // array
$form["pub_province_2"] = isset($formArr["q_9"]["q_9_2"]["where_2"]["province"]) ? 1 : null; // array



$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_3"]["way"]) ? $formArr["q_9"]["q_9_3"]["way"] : 0; // article media
$form["article_where"] = isset($formArr["q_9"]["q_9_3"]["where"]) ? $formArr["q_9"]["q_9_3"]["where"] : null; // array
// pour chaque valeur de $form[article_where] => une ligne dans article_media_visiteur_date

$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_4"]["way"]) ? $formArr["q_9"]["q_9_4"]["way"] : 0; // prospectus
$form["prospectus_where"] = isset($formArr["q_9"]["q_9_4"]["where"]) ? $formArr["q_9"]["q_9_4"]["where"] : null; // array
// pour chaque valeur de $form[prospectus_where] => une ligne dans prospectus_visiteur_date

$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_5"]["way"]) ? $formArr["q_9"]["q_9_5"]["way"] : 0; // promo
$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_6"]["way"]) ? $formArr["q_9"]["q_9_6"]["way"] : 0; // ecole
$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_7"]["way"]) ? $formArr["q_9"]["q_9_7"]["way"] : 0; // ce
$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_8"]["way"]) ? $formArr["q_9"]["q_9_8"]["way"] : 0; // guide
$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_9"]["way"]) ? $formArr["q_9"]["q_9_9"]["way"] : 0; // web zoo
$form["connaissance_zoo_type_id"][] = isset($formArr["q_9"]["q_9_10"]["way"]) ? $formArr["q_9"]["q_9_10"]["way"] : 0; // pub web

$form["infos_par_web_zoo"] = isset($formArr["q_10"]) ? $formArr["q_10"] : null; // connect site zoo
$form["infos_par_tel_zoo"] = isset($formArr["q_10_1"]) ? $formArr["q_10_1"] : null; // tel zoo
$form["satisfaction_zoo_id"] = isset($formArr["q_11"]) ? $formArr["q_11"] : null; // avis zoo
$form["manger_resto"] = isset($formArr["q_12"]) ? $formArr["q_12"] : null; // mangé sur place
$form["resto_id"] = isset($formArr["q_12_1"]) ? $formArr["q_12_1"] : null; // quel resto
$form["satisfaction_resto_id"] = isset($formArr["q_12_2"]) ? $formArr["q_12_2"] : null; // avis resto
$form["connait_hotel_jardin"] = isset($formArr["q_16"]["q_16_1"]) ? 1 : null;
$form["connait_hotel_hameaux"] = isset($formArr["q_16"]["q_16_2"]) ? 1 : null;
$form["remarque"] = isset($formArr["q_13"]) ? $formArr["q_13"] : null; // remarque
$form["veux_infos_zoo"] = isset($formArr["q_14"]) ? $formArr["q_14"] : null; // recevoir pub zoo
//$form["veux_infos_hotel"] = isset($formArr["q_14_1"]) ? $formArr["q_14_1"] : null; // recevoir pub hotel
$form["genre"] = isset($formArr["q_15_1"]) ? $formArr["q_15_1"] : null; // genre
$form["nom"] = isset($formArr["q_15_2"]) ? $formArr["q_15_2"] : null; // nom
$form["prenom"] = isset($formArr["q_15_3"]) ? $formArr["q_15_3"] : null; // prenom
$form["email"] = isset($formArr["q_15_4"]) ? $formArr["q_15_4"] : null; // email


try {
    $pdo = new PDO("sqlite:../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

// enregistrement du visiteur

$saveUserSql = "INSERT INTO visiteur (genre, nom, prenom, email, veux_infos_zoo, veux_infos_hotel, departement_num, departement, pays, deja_venu, derniere_visite_id, nombre_visite_id, connait_hotel_jardin, connait_hotel_hameaux) VALUES (:genre, :nom, :prenom, :email, :veux_infos_zoo, :veux_infos_hotel, :departement_num, :departement, :pays, :deja_venu, :derniere_visite_id, :nombre_visite_id, :connait_hotel_jardin, :connait_hotel_hameaux)";

$stmt = $pdo->prepare($saveUserSql);

$stmt->bindValue(":genre", $form["genre"]);
$stmt->bindValue(":nom", $form["nom"]);
$stmt->bindValue(":prenom", $form["prenom"]);
$stmt->bindValue(":email", $form["email"]);
$stmt->bindValue(":veux_infos_zoo", $form["veux_infos_zoo"]);
//$stmt->bindValue(":veux_infos_hotel", $form["veux_infos_hotel"]);
$stmt->bindValue(":veux_infos_hotel", null);
$stmt->bindValue(":departement_num", $form["departement_num"]);
$stmt->bindValue(":departement", $form["departement"]);
$stmt->bindValue(":pays", $form["pays"]);
$stmt->bindValue(":deja_venu", $form["deja_venu"]);
$stmt->bindValue(":derniere_visite_id", $form["derniere_visite_id"]);
$stmt->bindValue(":nombre_visite_id", $form["nombre_visite_id"]);
$stmt->bindValue(":connait_hotel_jardin", $form["connait_hotel_jardin"]);
$stmt->bindValue(":connait_hotel_hameaux", $form["connait_hotel_hameaux"]);


$stmt->execute();

$visiteur_id = $pdo->lastInsertId();

$saveVisiteurConnaitHotel = "INSERT INTO visiteur_connait_hotel (visiteur_id, hotel_id) VALUES (:visiteur_id, :hotel_id)";
if($form["connait_hotel_jardin"]){
    $stmt = $pdo->prepare($saveVisiteurConnaitHotel);
    $stmt->bindValue(":visiteur_id", $visiteur_id);
    $stmt->bindValue(":hotel_id", 1);
    $stmt->execute();
}
if($form["connait_hotel_hameaux"]){
    $stmt = $pdo->prepare($saveVisiteurConnaitHotel);
    $stmt->bindValue(":visiteur_id", $visiteur_id);
    $stmt->bindValue(":hotel_id", 2);
    $stmt->execute();
}


$saveVisiteSql = "INSERT INTO visite (visiteur_id , jour_passe_id , context_visite_id , duree_sejour_id , residence_id , temps_trajet_id , infos_par_web_zoo , infos_par_tel_zoo , satisfaction_zoo_id , manger_resto , resto_id , satisfaction_resto_id , remarque, programmation_id , qd_prog , panda_savoir , panda_decide , jour , mois , annee, departement_num, departement ) VALUES (:visiteur_id , :jour_passe_id , :context_visite_id , :duree_sejour_id , :residence_id , :temps_trajet_id , :infos_par_web_zoo , :infos_par_tel_zoo , :satisfaction_zoo_id , :manger_resto , :resto_id , :satisfaction_resto_id , :remarque , :programmation_id , :qd_prog , :panda_savoir , :panda_decide , :jour , :mois , :annee, :departement_num, :departement)";

$stmt = $pdo->prepare($saveVisiteSql);

$stmt->bindValue(":visiteur_id", $visiteur_id);
$stmt->bindValue(":jour_passe_id", $form["jour_passe_id"]);
$stmt->bindValue(":context_visite_id", $form["context_visite_id"]);
$stmt->bindValue(":duree_sejour_id", $form["duree_sejour_id"]);
$stmt->bindValue(":residence_id", $form["residence_id"]);
$stmt->bindValue(":temps_trajet_id", $form["temps_trajet_id"]);
$stmt->bindValue(":infos_par_web_zoo", $form["infos_par_web_zoo"]);
$stmt->bindValue(":infos_par_tel_zoo", $form["infos_par_tel_zoo"]);
$stmt->bindValue(":satisfaction_zoo_id", $form["satisfaction_zoo_id"]);
$stmt->bindValue(":manger_resto", $form["manger_resto"]);
$stmt->bindValue(":resto_id", $form["resto_id"]);
$stmt->bindValue(":satisfaction_resto_id", $form["satisfaction_resto_id"]);
$stmt->bindValue(":remarque", $form["remarque"]);
$stmt->bindValue(":programmation_id", $form["programmation_id"]);
$stmt->bindValue(":qd_prog", $form["qd_prog"]);
$stmt->bindValue(":panda_savoir", $form["panda_savoir"]);
$stmt->bindValue(":panda_decide", $form["panda_decide"]);
$stmt->bindValue(":jour", $form["jour"]);
$stmt->bindValue(":mois", $form["mois"]);
$stmt->bindValue(":annee", $form["annee"]);
$stmt->bindValue(":departement", $form["departement"]);
$stmt->bindValue(":departement_num", $form["departement_num"]);

$stmt->execute();

if (count($form["connaissance_zoo_type_id"])) {


    foreach ($form["connaissance_zoo_type_id"] as $k => $v) {
        if ($v != 0) {
            $sql = "INSERT INTO media_connaissance_zoo (visiteur_id, mois, annee, connaissance_zoo_type_id) VALUES (:visiteur_id, :mois, :annee, :connaissance_zoo_type_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":visiteur_id", $visiteur_id);
            $stmt->bindValue(":mois", $form["mois"]);
            $stmt->bindValue(":annee", $form["annee"]);
            $stmt->bindValue(":connaissance_zoo_type_id", $v);
            $stmt->execute();
        }
    }

    if (count($form["affichage_type"])) {
        foreach ($form["affichage_type"] as $k => $v) {
            if ($v != 0) {
                $sql = "INSERT INTO affichage_type_visiteur_date (visiteur_id, mois, annee, affichage_type_id, paris, province) VALUES (:visiteur_id, :mois, :annee, :affichage_type_id, :paris, :province)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":visiteur_id", $visiteur_id);
                $stmt->bindValue(":mois", $form["mois"]);
                $stmt->bindValue(":annee", $form["annee"]);
                $stmt->bindValue(":affichage_type_id", $v);

                if ($v > 0 && $v < 5) {
                    $pa = "paris_" . $v;
                    $pr = "province_" . $v;
                    $stmt->bindValue(":paris", $form[$pa]);
                    $stmt->bindValue(":province", $form[$pr]);
                } else {
                    $stmt->bindValue(":paris", null);
                    $stmt->bindValue(":province", null);
                }

                $stmt->execute();
            }
        }
    }

    if (count($form["pub_where"])) {
        foreach ($form["pub_where"] as $k => $v) {
            $sql = "INSERT INTO pub_media_visiteur_date (visiteur_id, mois, annee, pub_media_id, paris, province) VALUES (:visiteur_id, :mois, :annee, :pub_media_id, :paris, :province)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":visiteur_id", $visiteur_id);
            $stmt->bindValue(":mois", $form["mois"]);
            $stmt->bindValue(":annee", $form["annee"]);
            $stmt->bindValue(":pub_media_id", $v);
            $with_paris_province = [1,2];
            if(in_array($v, $with_paris_province)){
                $pa = "pub_paris_" . $v;
                $pr = "pub_province_" . $v;
                $stmt->bindValue(":paris", $form[$pa]);
                $stmt->bindValue(":province", $form[$pr]);
            } else {
                $stmt->bindValue(":paris", null);
                $stmt->bindValue(":province", null);
            }
            $stmt->execute();
        }
    }


    if (count($form["article_where"])) {
        foreach ($form["article_where"] as $k => $v) {
            $sql = "INSERT INTO article_media_visiteur_date (visiteur_id, mois, annee, article_media_id) VALUES (:visiteur_id, :mois, :annee, :article_media_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":visiteur_id", $visiteur_id);
            $stmt->bindValue(":mois", $form["mois"]);
            $stmt->bindValue(":annee", $form["annee"]);
            $stmt->bindValue(":article_media_id", $v);
            $stmt->execute();
        }
    }

    if (count($form["prospectus_where"])) {
        foreach ($form["prospectus_where"] as $k => $v) {
            $sql = "INSERT INTO prospectus_visiteur_date (visiteur_id, mois, annee, prospectus_id) VALUES (:visiteur_id, :mois, :annee, :prospectus_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":visiteur_id", $visiteur_id);
            $stmt->bindValue(":mois", $form["mois"]);
            $stmt->bindValue(":annee", $form["annee"]);
            $stmt->bindValue(":prospectus_id", $v);
            $stmt->execute();
        }
    }
}
?>


<pre>
    <?php var_dump($form, $visiteur_id); ?>
</pre>








































