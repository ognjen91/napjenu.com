<?php

ob_start();
if (!isset($_SESSION)) session_start();


require_once __DIR__  . "/../app/config/_env.php";
// (u fajlu _env.php je i autoload...)

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 ?>
