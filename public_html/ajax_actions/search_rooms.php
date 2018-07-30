<?php
require_once "../../app/config/_env.php";
use \App\Calendars\Calendar as Calendar;
use \App\Spaces\Room as Room;
use \App\Db_ops\Connection as Connection;
use DateTime as DateTime;

$db = new Connection;
 ?>





 <?php
// var_dump($_POST);


$conditions = isset($_POST['filters'])? $_POST['filters'] : [];
if (isset($_POST['filtes']['no_of_beds'])){
  $no_of_beds = $_POST['filtes']['no_of_beds'];
  unset($_POST['filtes']['no_of_beds']);
}

// ========PROVJERA DATUMA AKO SU SETOVANI==================
if (isset($_POST['filters']['arrival_date']) && isset($_POST['filters']['arrival_date'])){
  $arrival_date = new DateTime($_POST['filters']['arrival_date']);
  $departure_date = new DateTime($_POST['filters']['departure_date']);

  unset($conditions['arrival_date']);
  unset($conditions['departure_date']);
}

// ==========FILTRIRANJE PO BROJU KREVETA===========
if (isset($_POST['filters']['no_of_beds'])){
  $no_of_beds = $_POST['filters']['no_of_beds'];
  unset($conditions['no_of_beds']);
}


$all_rooms = Room::get_all($conditions);
$return_info = [];

// ========PROVJERA DATUMA AKO SU SETOVANI==================
if (isset($_POST['filters']['arrival_date']) && isset($_POST['filters']['arrival_date'])){
  require_once "calendar_filters.php";

}

// ==========FILTRIRANJE PO BROJU KREVETA===========
if (isset($_POST['filters']['no_of_beds'])){
  require_once "bed_filter.php";
}



if (empty($all_rooms)) {
  die();
}
foreach ($all_rooms as $room) {
  $owner_info = $room->get_owner_info();
  $facility_info = $room->get_facility_info();
   $return_info[$room->get('id')] = [
    'id' => $room->get('id'),
    'name' => $room->name,
    'owner_username' => $owner_info['username'],
    'owner_id' => $owner_info['id'],
    'facility_id' => $facility_info['id'],
    'facility_name' => $facility_info['name'],
    'place' => $facility_info['place'],
    'beds' => $room->no_of_beds,
    'profile_image' => $room->profile_image,
    'facebook' => $facility_info['facebook'],
    'instagram' => $facility_info['instagram']
  ];
}

shuffle($return_info);

echo json_encode($return_info);

 ?>
