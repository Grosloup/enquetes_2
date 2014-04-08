<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 08/04/2014
 * Time: 23:44
 */
try {
    $pdo_site = new PDO("sqlite:../../db/site.sqlite3");
    $pdo_site->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo_site->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}
