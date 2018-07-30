<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;
use \App\Spaces\Room as Room;
use \App\Db_ops\Connection as Connection;
use \App\Images\Room_image as Room_image;



$db = new Connection();

 ?>

 <?php

if (empty($_POST)) die("Greska");

$img_id = $_POST['img_id'];
$room_id = $_POST['room_id'];

$room = Room::get_all(['id'=>$room_id])[0];
$new_profile_img = Room_image::get_all(['id'=>$img_id])[0];

// var_dump($room);

$room->set_values(['profile_image'=>$new_profile_img->get('name')]);


$update_profile_img = $room->db_update_from_object(['profile_image'], ['id']);

if ($update_profile_img){
  echo json_encode(['message'=>'Profilna slika uspješno postavljena.']);
} else {
  echo json_encode(['message'=>'Pokušajte ponovo postavljanje profilne slike.']);
}



?>
