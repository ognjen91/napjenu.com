<?php
use App\Db_ops\Sql;
use App\Db_ops\Connection;
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Helpers\Check as Check;


require_once __DIR__  . "/../../../bootstrap/init.php";


?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Merriweather|Montserrat" rel="stylesheet">  <link rel="stylesheet" href="/resources/css/style.css">

  <link rel="stylesheet" href="/resources/admin_css/admin.css">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<body>


<?php


// define ('SITE_ADRESS', getenv('APP_URL'));


$db = new Connection();

require_once "check_session.php";
?>

<div class="admin_wrap">
  <div class='navigation'>
  <?php require_once "index/navigation.php"; ?>
  </div>
