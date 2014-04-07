<?php
/**
 * Created by PhpStorm.
 * User: grosloup
 * Date: 02/04/2014
 * Time: 10:19
 */
defined("ROOT") || define("ROOT", realpath(dirname(dirname(__DIR__))));
defined("LIBS") || define("LIBS", ROOT . DIRECTORY_SEPARATOR . "libs");

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR. LIBS);
ini_set("date.timezone", "Europe/Paris");