<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;
use \App\Spaces\Room as Room;
use \App\Db_ops\Connection as Connection;



$db = new Connection();

 ?>



<?php
// var_dump($_POST);

if(!$_POST || empty($_POST)){
  echo json_encode(['message'=>'Greska!']);
  die();
}


$room = Room::get_all( ['id'=>$_POST['room_id']]);

if (empty($room)){
  echo json_encode(['message'=>'Greska!']);
  die();
}


$room = $room[0];

//priprema post za unos
unset($_POST['room_id']);

$room->set_values($_POST, Room::$edit_info_fields);

$updated = $room->db_update_from_object(Room::$edit_info_fields, ['id']);

if (!$updated['error']){
  echo json_encode($updated);
  die();
}


echo json_encode(['message'=>'Morate unjeti bar jednu izmjenu.']);





?>
