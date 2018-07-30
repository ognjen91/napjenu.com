<?php
require_once __DIR__ . "/../../bootstrap/init.php";
use App\Db_ops\Connection as Connection;
use App\Languages\Language as Language;
use App\Languages\Serbian as Serbian;
use App\Languages\English as English;
use App\Helpers\Process as Process;


if (!empty($_GET['lang'])){
  if($_GET['lang'] == "eng") $lang = new English;
} else{
  $lang = new Serbian;
}

?>
<?php
$db = new Connection();

if (isset($_GET['lang'])){
  $language = 'srb';
  if ($_GET['lang'] == 'eng') $language='eng';
  if ($_GET['lang'] == 'rus') $language='rus';
} else {
  $language = 'srb';
}

 ?>


<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
<?php
if ($language == 'srb') {
  ?>   <?php
}

 ?>
  <title><?php echo $lang->site_title; ?></title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Merriweather|Montserrat" rel="stylesheet">  <link rel="stylesheet" href="/resources/css/style.css">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="/images/logo.png" />
</head>
<body>

<header>
<?php
require_once "navigation.php";
 ?>
</header >

<div class="wrapper">




 <!-- SLANJE EMAILA -->
 <div class="send_email" id="send_email">
   <?php require_once "send_email.php"; ?>
 </div>
