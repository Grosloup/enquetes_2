<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 11/04/2014
 * Time: 09:25
 */

ini_set("xdebug.var_display_max_children",-1);
ini_set("xdebug.var_display_max_data",-1);
ini_set("xdebug.var_display_max_depth",-1);

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

$depsCentre = ["18","28","36","37","41","45"];
$depsParis = ["75","77","78","91","92","93","94","95"];
$depsLimit = ["03","23","49","58","72","86","87","89"];
$obsDeps = array_merge($depsCentre, $depsParis, $depsLimit);
$keys = array_keys($departements);
$depsAutres = [];
foreach($keys as $k=>$v){
    if(!in_array($v, $obsDeps)){
        $depsAutres[] = $v;
    }
}


include_once "../../../libs/functions.php";

if( isGet() && isAjax() ){

    $errors = [];
    $response = ["datas"=>null, "errors"=>null];

    if(isset($_GET["year"]) && $_GET["year"] != null){
        if(!is_numeric($_GET["year"]) || $_GET["year"] < 2009){
            $errors[] = "Year n'est pas une année de référence.";
        }
    } else {
        $errors[] = "Vous devez donner une année de référence.";
    }

    $twoDigitsYear = $_GET["year"] - 2000;

    // region centre
    $depCentreResult = ["totalEffectif"=>0,"totalEffectifParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0], "name"=>"Région Centre", "depts"=>[]];
    foreach($depsCentre as $k=>$dep){
        $depCentreResult["depts"][$k] = ["num"=>$dep, "name"=>$departements[$dep],"effectifMois"=>[],"percentParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0]];
        for ($i=0; $i<12; $i++){
            $depCentreResult["depts"][$k]["effectifMois"][$i] = effectifsParDeptEtMoisEtAnnee($dep, $i+1, $twoDigitsYear);
            $depCentreResult["totalEffectif"] += $depCentreResult["depts"][$k]["effectifMois"][$i];
        }
    }

    foreach($depCentreResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            $depCentreResult["totalEffectifParMois"][$i] += $v["effectifMois"][$i];
        }
    }

    foreach($depCentreResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            if($depCentreResult["totalEffectifParMois"][$i] > 0){
                $depCentreResult["depts"][$k]["percentParMois"][$i] = round(($v["effectifMois"][$i] / $depCentreResult["totalEffectifParMois"][$i])*100, 2);
            } else {
                $depCentreResult["depts"][$k]["percentParMois"][$i] = 0;
            }
        }
    }






    // region parisienne
    $depParisResult = ["totalEffectif"=>0,"totalEffectifParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0], "name"=>"Région parisienne", "depts"=>[]];
    foreach($depsParis as $k=>$dep){
        $depParisResult["depts"][$k] = ["num"=>$dep, "name"=>$departements[$dep],"effectifMois"=>[],"percentParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0]];
        for ($i=0; $i<12; $i++){
            $depParisResult["depts"][$k]["effectifMois"][$i] = effectifsParDeptEtMoisEtAnnee($dep, $i+1, $twoDigitsYear);
            $depParisResult["totalEffectif"] += $depParisResult["depts"][$k]["effectifMois"][$i];
        }
    }

    foreach($depParisResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            $depParisResult["totalEffectifParMois"][$i] += $v["effectifMois"][$i];
        }
    }

    foreach($depParisResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            if($depParisResult["totalEffectifParMois"][$i] > 0){
                $depParisResult["depts"][$k]["percentParMois"][$i] = round(($v["effectifMois"][$i] / $depParisResult["totalEffectifParMois"][$i])*100, 2);
            } else {
                $depParisResult["depts"][$k]["percentParMois"][$i] = 0;
            }
        }
    }

    // region limit
    $depLimitResult = ["totalEffectif"=>0,"totalEffectifParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0], "name"=>"Départements limitrophes", "depts"=>[]];
    foreach($depsLimit as $k=>$dep){
        $depLimitResult["depts"][$k] = ["num"=>$dep, "name"=>$departements[$dep],"effectifMois"=>[],"percentParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0]];
        for ($i=0; $i<12; $i++){
            $depLimitResult["depts"][$k]["effectifMois"][$i] = effectifsParDeptEtMoisEtAnnee($dep, $i+1, $twoDigitsYear);
            $depLimitResult["totalEffectif"] += $depLimitResult["depts"][$k]["effectifMois"][$i];
        }
    }

    foreach($depLimitResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            $depLimitResult["totalEffectifParMois"][$i] += $v["effectifMois"][$i];
        }
    }

    foreach($depLimitResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            if($depLimitResult["totalEffectifParMois"][$i] > 0){
                $depLimitResult["depts"][$k]["percentParMois"][$i] = round(($v["effectifMois"][$i] / $depLimitResult["totalEffectifParMois"][$i])*100, 2);
            } else {
                $depLimitResult["depts"][$k]["percentParMois"][$i] = 0;
            }
        }
    }

    // autre
    $depAutresResult = ["totalEffectif"=>0,"totalEffectifParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0], "name"=>"Autres", "depts"=>[]];
    foreach($depsAutres as $k=>$dep){
        $depAutresResult["depts"][$k] = ["num"=>$dep, "name"=>$departements[$dep],"effectifMois"=>[],"percentParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0]];
        for ($i=0; $i<12; $i++){
            $depAutresResult["depts"][$k]["effectifMois"][$i] = effectifsParDeptEtMoisEtAnnee($dep, $i+1, $twoDigitsYear);
            $depAutresResult["totalEffectif"] += $depAutresResult["depts"][$k]["effectifMois"][$i];
        }
    }

    foreach($depAutresResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            $depAutresResult["totalEffectifParMois"][$i] += $v["effectifMois"][$i];
        }
    }

    foreach($depAutresResult["depts"] as $k=>$v){
        for($i=0; $i<12; $i++){
            if($depAutresResult["totalEffectifParMois"][$i] > 0){
                $depAutresResult["depts"][$k]["percentParMois"][$i] = round(($v["effectifMois"][$i] / $depAutresResult["totalEffectifParMois"][$i])*100, 2);
            } else {
                $depAutresResult["depts"][$k]["percentParMois"][$i] = 0;
            }
        }
    }

    // comparaison
    $depCompare = ["totalParMois"=>[0,0,0,0,0,0,0,0,0,0,0,0],
        "percentParMoisEtZone"=>[
            "centre"=>[0,0,0,0,0,0,0,0,0,0,0,0],
            "paris"=>[0,0,0,0,0,0,0,0,0,0,0,0],
            "limit"=>[0,0,0,0,0,0,0,0,0,0,0,0],
            "autres"=>[0,0,0,0,0,0,0,0,0,0,0,0]
        ]];
    for($i=0;$i<12;$i++){
        $depCompare["totalParMois"][$i] = $depCentreResult["totalEffectifParMois"][$i] + $depParisResult["totalEffectifParMois"][$i] + $depLimitResult["totalEffectifParMois"][$i] + $depAutresResult["totalEffectifParMois"][$i];
    }

    for($i=0;$i<12;$i++){
        $depCompare["percentParMoisEtZone"]["centre"][$i] = round(($depCentreResult["totalEffectifParMois"][$i] / $depCompare["totalParMois"][$i])*100, 2);
        $depCompare["percentParMoisEtZone"]["paris"][$i] = round(($depParisResult["totalEffectifParMois"][$i] / $depCompare["totalParMois"][$i])*100, 2);
        $depCompare["percentParMoisEtZone"]["limit"][$i] = round(($depLimitResult["totalEffectifParMois"][$i] / $depCompare["totalParMois"][$i])*100, 2);
        $depCompare["percentParMoisEtZone"]["autres"][$i] = round(($depAutresResult["totalEffectifParMois"][$i] / $depCompare["totalParMois"][$i])*100, 2);
    }

    $response["datas"] = [
        "centre"=>$depCentreResult,
        "paris"=>$depParisResult,
        "limit"=>$depLimitResult,
        "autres"=>$depAutresResult,
        "compare"=>$depCompare,
    ];

    header("Content-Type: application/json; charset=utf-8");

    echo json_encode($response);

    die();

} else {
    header("Content-Type: text/html; charset=utf-8");
    echo json_encode("nothing to do here");
    die();
}
























