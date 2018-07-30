<?php
require_once "../../app/config/_env.php";
use \App\Calendars\Calendar as Calendar;

 ?>

<?php

if (empty($_POST)) die('greska');

$language = $_POST['language'];



$calendar = new Calendar();

$calendars_info = $calendar->next_month_calendars(12, 2019);
echo json_encode($calendars_info);



 ?>
