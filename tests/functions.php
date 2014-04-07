<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 31/03/2014
 * Time: 08:43
 */
$departements = [
    "01"=>"Ain", "02"=>"Aisne", "03"=>"Allier", "04"=>"Alpes-de-Haute-Provence",
    "05"=>"Hautes-Alpes", "06"=>"Alpes-Maritimes", "07"=>"Ardèche", "08"=>"Ardennes",
    "09"=>"Ariège", "10"=>"Aube", "11"=>"Aude", "12"=>"Aveyron", "13"=>"Bouches-du-Rhône",
    "14"=>"Calvados", "15"=>"Cantal", "16"=>"Charente", "17"=>"Charente-Maritime", "18"=>"Cher",
    "19"=>"Corrèze", "2A" => "Corse-du-Sud", "2B" => "Haute-Corse", "21"=>"Côte-d'Or",
    "22"=>"Côtes-d'Armor", "23"=>"Creuse", "24"=>"Dordogne", "25"=>"Doubs", "26"=>"Drôme",
    "27"=>"Eure", "28"=>"Eure-et-Loir", "29"=>"Finistère", "30"=>"Gard", "31"=>"Haute-Garonne",
    "32"=>"Gers", "33"=>"Gironde", "34"=>"Hérault", "35"=>"Ille-et-Vilaine", "36"=>"Indre",
    "37"=>"Indre-et-Loire", "38"=>"Isère", "39"=>"Jura", "40"=>"Landes", "41"=>"Loir-et-Cher",
    "42"=>"Loire", "43"=>"Haute-Loire", "44"=>"Loire-Atlantique", "45"=>"Loiret", "46"=>"Lot",
    "47"=>"Lot-et-Garonne", "48"=>"Lozère", "49"=>"Maine-et-Loire", "50"=>"Manche", "51"=>"Marne",
    "52"=>"Haute-Marne", "53"=>"Mayenne", "54"=>"Meurthe-et-Moselle", "55"=>"Meuse", "56"=>"Morbihan",
    "57"=>"Moselle", "58"=>"Nièvre", "59"=>"Nord", "60"=>"Oise", "61"=>"Orne", "62"=>"Pas-de-Calais",
    "63"=>"Puy-de-Dôme", "64"=>"Pyrénées-Atlantiques", "65"=>"Hautes-Pyrénées", "66"=>"Pyrénées-Orientales",
    "67"=>"Bas-Rhin", "68"=>"Haut-Rhin", "69"=>"Rhône", "70"=>"Haute-Saône", "71"=>"Saône-et-Loire",
    "72"=>"Sarthe", "73"=>"Savoie", "74"=>"Haute-Savoie", "75"=>"Paris", "76"=>"Seine-Maritime",
    "77"=>"Seine-et-Marne", "78"=>"Yvelines", "79"=>"Deux-Sèvres", "80"=>"Somme", "81"=>"Tarn",
    "82"=>"Tarn-et-Garonne", "83"=>"Var", "84"=>"Vaucluse", "85"=>"Vendée", "86"=>"Vienne",
    "87"=>"Haute-Vienne", "88"=>"Vosges", "89"=>"Yonne", "90"=>"Territoire de Belfort",
    "91"=>"Essonne", "92"=>"Hauts-de-Seine", "93"=>"Seine-Saint-Denis", "94"=>"Val-de-Marne", "95"=>"Val-d'Oise",
    "96"=>"Guadeloupe","97"=>"Martinique","98"=>"Guyanne","99"=>"Réunion",
    "100" => "Etranger",
];
include_once "../../datas/pays.php";

try {
    $pdo = new PDO("sqlite:../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

function newVisitor(){
    global $departements;
    global $pays;
    global $pdo;

    $genre = "Mr";
    $nom = "Dupont";
    $prenom = "Albert";
    $email = "al.pon@mail.com";
    $n = rand(0,99);
    $departement = array_values($departements)[$n];
    $departementNum = array_keys($departements)[$n];
    if($n == 100){
        $np = rand(0,6);
        $_pays = $pays[$np];
    } else {
        $_pays = "France";
    }

    if(rand(1,100)%2 == 0){
        $deja_venu = 1;
    } else {
        $deja_venu = 0;
    }
    if(rand(1,100)%2 == 0){
        $veux_infos_zoo = 1;
    } else {
        $veux_infos_zoo = 0;
    }
    if(rand(1,100)%2 == 0){
        $connait_hotel_jardin = 1;
    } else {
        $connait_hotel_jardin = 0;
    }
    if(rand(1,100)%2 == 0){
        $connait_hotel_hameaux = 1;
    } else {
        $connait_hotel_hameaux = 0;
    }

    if($deja_venu){
        $derniereVisisteId = rand(1,6);
        $nbreVisite = rand(1,4);
    } else {
        $derniereVisisteId = null;
        $nbreVisite = null;
    }
    $saveUserSql = "INSERT INTO visiteur (genre, nom, prenom, email, veux_infos_zoo, veux_infos_hotel, departement_num, departement, pays, deja_venu, derniere_visite_id, nombre_visite_id, connait_hotel_jardin, connait_hotel_hameaux) VALUES (:genre, :nom, :prenom, :email, :veux_infos_zoo, :veux_infos_hotel, :departement_num, :departement, :pays, :deja_venu, :derniere_visite_id, :nombre_visite_id, :connait_hotel_jardin, :connait_hotel_hameaux)";

    $stmt = $pdo->prepare($saveUserSql);

    $stmt->bindValue(":genre", $genre);
    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":veux_infos_zoo", $veux_infos_zoo);
    $stmt->bindValue(":veux_infos_hotel", null);
    $stmt->bindValue(":departement_num", $departementNum);
    $stmt->bindValue(":departement", $departement);
    $stmt->bindValue(":pays", $_pays);
    $stmt->bindValue(":deja_venu", $deja_venu);
    $stmt->bindValue(":derniere_visite_id", $derniereVisisteId);
    $stmt->bindValue(":nombre_visite_id", $nbreVisite);
    $stmt->bindValue(":connait_hotel_jardin", $connait_hotel_jardin);
    $stmt->bindValue(":connait_hotel_hameaux", $connait_hotel_hameaux);


    $stmt->execute();

    $visiteur_id=$pdo->lastInsertId();
    $saveVisiteurConnaitHotel = "INSERT INTO visiteur_connait_hotel (visiteur_id, hotel_id) VALUES (:visiteur_id, :hotel_id)";

    if($connait_hotel_jardin){
        $stmt = $pdo->prepare($saveVisiteurConnaitHotel);
        $stmt->bindValue(":visiteur_id", $visiteur_id);
        $stmt->bindValue(":hotel_id", 1);
        $stmt->execute();
    }
    if($connait_hotel_hameaux){
        $stmt = $pdo->prepare($saveVisiteurConnaitHotel);
        $stmt->bindValue(":visiteur_id", $visiteur_id);
        $stmt->bindValue(":hotel_id", 2);
        $stmt->execute();
    }


    return [$visiteur_id, $departement, $departementNum];
}

function newVisite($visitor){
    global $pdo;
    $dateEnd = new DateTime("2014-04-30", new DateTimeZone("Europe/Paris"));
    $timeStampEnd = $dateEnd->getTimestamp();
    $timeStampStart = $timeStampEnd - 15552000;
    $dateAleatoireSecond = $timeStampStart + rand(0, 15552000);
    $dateAleatoire = new DateTime();
    $dateAleatoire->setTimestamp($dateAleatoireSecond);
    $month = $dateAleatoire->format("m");
    $year = 13;
    $day = $dateAleatoire->format("d");
    if(rand(1,100)%2 == 0){
        $jour_passe_id = 1;
    } else {
        $jour_passe_id = 2;
    }
    $r = [1,2,3,1,2,3,1,2,3,null];
    $context_visite_id = $r[rand(0,9)];
    $r = [1,2,3,4,5,1,2,3,4,5,null];
    $duree_sejour_id = $r[rand(0,10)];
    if($duree_sejour_id != null && $duree_sejour_id > 1){
        $r = [1,2,3,4,5,6,7,1,2,3,4,5,6,7,null];
        $residence_id = $r[rand(0,14)];
    } else {
        $residence_id = null;
    }
    $r = [1,2,3,1,2,3,1,2,3,null];
    $temps_trajet_id = $r[rand(0,9)];
    if(rand(1,100)%2 == 0){
        $infos_par_web_zoo  = 0;
    } else {
        $infos_par_web_zoo  = 1;
    }
    if(rand(1,100)%2 == 0){
        $infos_par_tel_zoo  = 0;
    } else {
        $infos_par_tel_zoo  = 1;
    }
    $r = [1,2,3,4,1,2,3,4,null];
    $satisfaction_zoo_id = $r[rand(0,8)];
    if(rand(1,100)%2 == 0){
        $manger_resto  = 0;
    } else {
        $manger_resto  = 1;
    }
    if($manger_resto){
        $r = [1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,null];
        $resto_id = $r[rand(0,18)];
        $r = [1,2,3,4,1,2,3,4,null];
        $satisfaction_resto_id = $r[rand(0,8)];
    } else {
        $resto_id= null;
        $satisfaction_resto_id = null;
    }
    $remarque = "lorem ipsum dolor sit amet";
    if(rand(1,100)%2 == 0){
        $programmation_id = 1;
    } else {
        $programmation_id = 2;
    }
    if($programmation_id == 2){
        $qd_prog = rand(1,16);
    } else {
        $qd_prog = null;
    }
    if(rand(1,100)%2 == 0){
        $panda_decide  = 0;
    } else {
        $panda_decide  = 1;
    }
    if(rand(1,100)%2 == 0){
        $panda_savoir  = 0;
    } else {
        $panda_savoir  = 1;
    }
    $saveVisiteSql = "INSERT INTO visite (visiteur_id , jour_passe_id , context_visite_id , duree_sejour_id , residence_id , temps_trajet_id , infos_par_web_zoo , infos_par_tel_zoo , satisfaction_zoo_id , manger_resto , resto_id , satisfaction_resto_id , remarque, programmation_id , qd_prog , panda_savoir , panda_decide , jour , mois , annee, departement_num, departement ) VALUES (:visiteur_id , :jour_passe_id , :context_visite_id , :duree_sejour_id , :residence_id , :temps_trajet_id , :infos_par_web_zoo , :infos_par_tel_zoo , :satisfaction_zoo_id , :manger_resto , :resto_id , :satisfaction_resto_id , :remarque , :programmation_id , :qd_prog , :panda_savoir , :panda_decide , :jour , :mois , :annee, :departement_num, :departement)";
    $stmt = $pdo->prepare($saveVisiteSql);
    $stmt->bindValue(":visiteur_id", $visitor[0]);
    $stmt->bindValue(":jour_passe_id", $jour_passe_id);
    $stmt->bindValue(":context_visite_id", $context_visite_id);
    $stmt->bindValue(":duree_sejour_id", $duree_sejour_id);
    $stmt->bindValue(":residence_id", $residence_id);
    $stmt->bindValue(":temps_trajet_id", $temps_trajet_id);
    $stmt->bindValue(":infos_par_web_zoo", $infos_par_web_zoo);
    $stmt->bindValue(":infos_par_tel_zoo", $infos_par_tel_zoo);
    $stmt->bindValue(":satisfaction_zoo_id", $satisfaction_zoo_id);
    $stmt->bindValue(":manger_resto", $manger_resto);
    $stmt->bindValue(":resto_id", $resto_id);
    $stmt->bindValue(":satisfaction_resto_id", $satisfaction_resto_id);
    $stmt->bindValue(":remarque", $remarque);
    $stmt->bindValue(":programmation_id", $programmation_id);
    $stmt->bindValue(":qd_prog", $qd_prog);
    $stmt->bindValue(":panda_savoir", $panda_savoir);
    $stmt->bindValue(":panda_decide", $panda_decide);
    $stmt->bindValue(":jour", $day);
    $stmt->bindValue(":mois", $month);
    $stmt->bindValue(":annee",$year);
    $stmt->bindValue(":departement_num", $visitor[2]);
    $stmt->bindValue(":departement", $visitor[1]);
    $stmt->execute();

    $connaissance_zoo_type_id = [];
    $n = rand(1,4);
    for($i=0;$i<$n;$i++){
        $connaissance_zoo_type_id[] = rand(1,11);
    }


    if (count($connaissance_zoo_type_id)) {


        foreach ($connaissance_zoo_type_id as $k => $v) {
            if ($v != 0) {
                $sql = "INSERT INTO media_connaissance_zoo (visiteur_id, mois, annee, connaissance_zoo_type_id) VALUES (:visiteur_id, :mois, :annee, :connaissance_zoo_type_id)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":visiteur_id", $visitor[0]);
                $stmt->bindValue(":mois", $month);
                $stmt->bindValue(":annee",$year);
                $stmt->bindValue(":connaissance_zoo_type_id", $v);
                $stmt->execute();
            }
        }

        if(in_array(2, $connaissance_zoo_type_id)){
            $affichage_type = [];
            $n = rand(1,4);
            for($i=0;$i<$n;$i++){
                $affichage_type[] = rand(1,9);
            }
            if (count($affichage_type)) {
                foreach ($affichage_type as $k => $v) {
                    if ($v != 0) {
                        $sql = "INSERT INTO affichage_type_visiteur_date (visiteur_id, mois, annee, affichage_type_id, paris, province) VALUES (:visiteur_id, :mois, :annee, :affichage_type_id, :paris, :province)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(":visiteur_id", $visitor[0]);
                        $stmt->bindValue(":mois", $month);
                        $stmt->bindValue(":annee",$year);
                        $stmt->bindValue(":affichage_type_id", $v);

                        if ($v > 0 && $v < 5) {
                            $r = [1,1,1,1,1,null,null,null,null,null];

                            $pa = $r[rand(0,7)];
                            $pr = $r[rand(0,7)];
                            $stmt->bindValue(":paris", $pa);
                            $stmt->bindValue(":province", $pr);
                        } else {
                            $stmt->bindValue(":paris", null);
                            $stmt->bindValue(":province", null);
                        }

                        $stmt->execute();
                    }
                }
            }
        }

        if(in_array(3, $connaissance_zoo_type_id)){
            $n = rand(1,2);
            $pub_where = [];
            for($i=0;$i<$n;$i++){
                $pub_where[] = rand(1,4);
            }

            if (count($pub_where)) {
                foreach ($pub_where as $k => $v) {
                    $sql = "INSERT INTO pub_media_visiteur_date (visiteur_id, mois, annee, pub_media_id, paris, province) VALUES (:visiteur_id, :mois, :annee, :pub_media_id, :paris, :province)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":visiteur_id", $visitor[0]);
                    $stmt->bindValue(":mois", $month);
                    $stmt->bindValue(":annee",$year);;
                    $stmt->bindValue(":pub_media_id", $v);
                    $with_paris_province = [1,2];
                    if(in_array($v, $with_paris_province)){
                        $r = [1,0,null];

                        $pa = $r[rand(0,2)];
                        $pr = $r[rand(0,2)];
                        $stmt->bindValue(":paris", $pa);
                        $stmt->bindValue(":province", $pr);
                    } else {
                        $stmt->bindValue(":paris", null);
                        $stmt->bindValue(":province", null);
                    }
                    $stmt->execute();
                }
            }
        }
        if(in_array(4, $connaissance_zoo_type_id)){
            $n = rand(1,2);
            $article_where = [];
            for($i=0;$i<$n;$i++){
                $article_where[] = rand(1,4);
            }

            if (count($article_where)) {


                foreach ($article_where as $k => $v) {
                    $sql = "INSERT INTO article_media_visiteur_date (visiteur_id, mois, annee, article_media_id) VALUES (:visiteur_id, :mois, :annee, :article_media_id)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":visiteur_id", $visitor[0]);
                    $stmt->bindValue(":mois", $month);
                    $stmt->bindValue(":annee",$year);
                    $stmt->bindValue(":article_media_id", $v);
                    $stmt->execute();
                }
            }
        }

        if(in_array(5, $connaissance_zoo_type_id)){
            $n = rand(1,3);
            $prospectus_where = [];
            for($i=0;$i<$n;$i++){
                $prospectus_where[] = rand(1,6);
            }


            if (count($prospectus_where)) {
                foreach ($prospectus_where as $k => $v) {
                    $sql = "INSERT INTO prospectus_visiteur_date (visiteur_id, mois, annee, prospectus_id) VALUES (:visiteur_id, :mois, :annee, :prospectus_id)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(":visiteur_id", $visitor[0]);
                    $stmt->bindValue(":mois", $month);
                    $stmt->bindValue(":annee",$year);
                    $stmt->bindValue(":prospectus_id", $v);
                    $stmt->execute();
                }
            }
        }


    }

}