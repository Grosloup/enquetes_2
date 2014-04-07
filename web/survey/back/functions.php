<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 02/04/2014
 * Time: 10:31
 */

/**
 * @param $table
 * @param string $conditions
 * @param array $binds
 * @return PDOStatement
 *
 */
function countRow($table, $conditions="", $binds=[]){
    /** @var $pdo PDO */
    global $pdo;
    $sql = "SELECT COUNT() as num FROM " . $table;
    if($conditions){
        $sql .= " WHERE " . $conditions;
    }
    $stmt = $pdo->prepare($sql);
    if($binds){
        foreach($binds as $k=>$v){
            $stmt->bindValue($k, $v);
        }
    }
    $stmt->execute();
    return $stmt;
}




function getNumEntryPerMonth($month, $year){
    /** @var $pdo PDO */
    global $pdo;
    // assez de données pour mois en cours ?

   $stmt = countRow("visite", "annee=:annee AND mois=:mois", [":annee"=>$year, ":mois"=>$month]);
   return $stmt->fetch()["num"];
}