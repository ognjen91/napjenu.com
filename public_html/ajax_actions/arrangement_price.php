<?php
require_once "../../app/config/_env.php";
use \App\Spaces\Room as Room;
use \App\Calendars\Prices as Prices;
use \App\Calendars\Calendar as Calendar;
use \App\Db_ops\Connection as Connection;

$db = new Connection;
use DateTime as DateTime;


if (empty($_POST)) die();

$room_id = $_POST['room_id'];
$arrival_date = $_POST['arrival_date'];
$departure_date = $_POST['departure_date'];

$arrival_date = new DateTime($arrival_date);
$departure_date = new DateTime($departure_date);


$room = Room::get_all(['id'=>$room_id]);
$room = empty($room)? die() : $room[0];
$calendar = new Calendar($room);
$prices = new Prices($calendar);

$arrangement_info = $prices->arrangement_info($arrival_date, $departure_date);

echo json_encode($arrangement_info);
// var_dump($arrangement_info);








?>
