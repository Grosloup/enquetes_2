<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 10/04/2014
 * Time: 10:14
 */
include_once "connection.php";
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
include_once "../../../libs/functions.php";

if(isGet() && isAjax()){

    $errors = [];
    $response = ["datas"=>null, "errors"=>null];

    $depsCentre = ["18","28","36","37","41","45"];
    $depsParis = ["75","77","78","91","92","93","94","95"];
    $depsLimit = ["03","23","49","58","72","86","87","89"];

    if(isset($_GET["year"]) && $_GET["year"] != null){
        if(!is_numeric($_GET["year"]) || $_GET["year"] < 2009){
            $errors[] = "Year n'est pas une année de référence.";
        }
    } else {
        $errors[] = "Vous devez donner une année de référence.";
    }
    $twoDigitsYear = $_GET["year"] - 2000;
    if($errors == null){

        // region centre
        $resultsDeptCentre = ["name"=>"Région Centre","effectifTotal"=>0, "deps"=>[]];
        $totalEffectifCentre = 0;
        foreach($depsCentre as $dep){
            $effectif = effectifsParDeptEtAnnee($dep, $twoDigitsYear);
            $totalEffectifCentre += (int) $effectif;
            $resultsDeptCentre["deps"][] = [
                "effectif"=>$effectif,
                "name"=>$departements[$dep],
                "num"=>$dep,
            ];
        }

        $resultsDeptCentre["effectifTotal"]  = $totalEffectifCentre;
        foreach($resultsDeptCentre["deps"] as $k=>$v){
            $resultsDeptCentre["deps"][$k]["percent"] = round(($v["effectif"]/$totalEffectifCentre)*100, 2);
        }


        // region parisienne
        $resultsDeptParis = ["name"=>"Région parisienne","effectifTotal"=>0, "deps"=>[]];
        $totalEffectifParis = 0;
        foreach($depsParis as $dep){
            $effectif = effectifsParDeptEtAnnee($dep, $twoDigitsYear);
            $totalEffectifParis += (int) $effectif;
            $resultsDeptParis["deps"][] = [
                "effectif"=>$effectif,
                "name"=>$departements[$dep],
                "num"=>$dep,
            ];
        }

        $resultsDeptParis["effectifTotal"]  = $totalEffectifParis;
        foreach($resultsDeptParis["deps"] as $k=>$v){
            $resultsDeptParis["deps"][$k]["percent"] = round(($v["effectif"]/$totalEffectifParis)*100, 2);
        }

        // limitrophes
        $resultsDeptLimit = ["name"=>"Départements limitrophes","effectifTotal"=>0, "deps"=>[]];
        $totalEffectifLimit = 0;
        foreach($depsLimit as $dep){
            $effectif = effectifsParDeptEtAnnee($dep, $twoDigitsYear);
            $totalEffectifLimit += (int) $effectif;
            $resultsDeptLimit["deps"][] = [
                "effectif"=>$effectif,
                "name"=>$departements[$dep],
                "num"=>$dep,
            ];
        }

        $resultsDeptLimit["effectifTotal"]  = $totalEffectifLimit;
        foreach($resultsDeptLimit["deps"] as $k=>$v){
            $resultsDeptLimit["deps"][$k]["percent"] = round(($v["effectif"]/$totalEffectifLimit)*100, 2);
        }


        header("Content-Type: application/json; charset=utf-8");
        $response["datas"] = ["centre"=>$resultsDeptCentre,"paris"=>$resultsDeptParis,"limit"=>$resultsDeptLimit];
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








