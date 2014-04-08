<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 02/04/2014
 * Time: 10:16
 */
try {
    $pdo = new PDO("sqlite:../../../db/enquetes.sqlite3");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}