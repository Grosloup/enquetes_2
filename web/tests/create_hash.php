<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 08/04/2014
 * Time: 23:31
 */
include_once "../../libs/PasswordLib/PasswordLib.php";

$passLib = new \PasswordLib\PasswordLib();
$hash = $passLib->createPasswordHash("grosloup");
echo $hash;
