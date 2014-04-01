<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 31/03/2014
 * Time: 11:49
 */



try {
    $pdo = new PDO("sqlite:../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}
////////////////////////////////////////////////
$sql = "SELECT COUNT() as total_visite_juin FROM visite WHERE mois=:mois AND satisfaction_zoo_id NOT NULL";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->execute();
$total_visite_juin =$stmt->fetch()["total_visite_juin"];
/////////////////////////////////////////////////
$sql = "SELECT COUNT() as total_visite_aime_bcp_juin FROM visite WHERE mois=:mois AND satisfaction_zoo_id=:id_aime_bcp";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->bindValue(":id_aime_bcp", 1);
$stmt->execute();
$total_visite_aime_bcp_juin = $stmt->fetch()["total_visite_aime_bcp_juin"];

//////////////////////////////////////////////////
$sql = "SELECT COUNT() as total_visite_aime_juin FROM visite WHERE mois=:mois AND satisfaction_zoo_id=:id_aime";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->bindValue(":id_aime",2);
$stmt->execute();
$total_visite_aime_juin = $stmt->fetch()["total_visite_aime_juin"];

//////////////////////////////////////////////////
$sql = "SELECT COUNT() as total_visite_aime_peu_juin FROM visite WHERE mois=:mois AND satisfaction_zoo_id=:id_aime_peu";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->bindValue(":id_aime_peu",3);
$stmt->execute();
$total_visite_aime_peu_juin = $stmt->fetch()["total_visite_aime_peu_juin"];

//////////////////////////////////////////////////
$sql = "SELECT COUNT() as total_visite_aime_pas_juin FROM visite WHERE mois=:mois AND satisfaction_zoo_id=:id_aime_pas";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":mois", 6);
$stmt->bindValue(":id_aime_pas",4);
$stmt->execute();
$total_visite_aime_pas_juin = $stmt->fetch()["total_visite_aime_pas_juin"];


$r1 = ($total_visite_aime_bcp_juin/$total_visite_juin)*100;
$r2 = ($total_visite_aime_juin/$total_visite_juin)*100;
$r3 = ($total_visite_aime_peu_juin/$total_visite_juin)*100;
$r4 = ($total_visite_aime_pas_juin/$total_visite_juin)*100;

$f2 = $r2 - floor($r2);
$f3 = $r3 - floor($r3);
$f4 = $r4 - floor($r4);
//recuperer derriere la virgule et l'ajouter au top
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>test aime</title>
</head>
<body>


<table>
    <tr>
        <th></th>
        <th>06/13</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th>bcp aimé</th>
        <td><?php echo $r1 + $f2 + $f3 + $f4;  ?>%</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>Aimé</th>
        <td><?php echo floor($r2); ?>%</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>peu aimé</th>
        <td><?php echo floor($r3); ?>%</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>pas du tout aimé</th>
        <td><?php echo floor($r4); ?>%</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>



</table>
</body>
</html>























