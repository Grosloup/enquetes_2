<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 31/03/2014
 * Time: 14:34
 */
try {
    $pdo = new PDO("sqlite:../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}

$sql = "SELECT COUNT() as total_reponse_resto FROM visite WHERE manger_resto NOT NULL AND mois=:mois";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->execute();
$total_reponse_resto = $stmt->fetch()["total_reponse_resto"];

$sql = "SELECT COUNT() as total_manger_resto FROM visite WHERE manger_resto NOT NULL AND mois=:mois AND manger_resto=1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->execute();

$total_manger_resto =$stmt->fetch()["total_manger_resto"];
$percentManger = ceil(($total_manger_resto/$total_reponse_resto)*100);
$percentPasManger = 100 - $percentManger ;
var_dump($percentManger, $percentPasManger);
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>test resto</title>
</head>
<body>

</body>
</html>