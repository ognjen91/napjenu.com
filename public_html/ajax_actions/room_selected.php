<?php
require_once "../../app/config/_env.php";
use \App\Calendars\Calendar as Calendar;
use \App\Spaces\Room as Room;
use \App\Db_ops\Connection as Connection;
use \App\Helpers\Process as Process;
use \App\Images\Room_image as Room_image;
use \App\Calendars\Calendars as Calendars;
use \App\Calendars\Prices as Prices;


$db = new Connection;
 ?>



 <?php
//uzimanje id-a sobe iz posta
//
if(empty($_POST)) die('greska');
// var_dump($_POST);
$room_id = $_POST['room_id']; //probno
$language = $_POST['language'];
$room_info = []; //niz koji ce biti vracen


//uzimanje osnovnih informacija o sobi
$pot_rooms = Room::get_all(['id'=>$room_id]);

if (empty($pot_rooms)) die;

$room = $pot_rooms[0];
$facility_info = $room->get_facility_info();
$owner_info = $room->get_owner_info();

// ------osnovne informacije------
$room_info['basic'] = [
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

// ----pogodnosti sobe-------
//u stvari saljem odgovarajucu sliku (strik ili x) koju kasnije stavljam za img src..
//.. a za 'other_amenities_srb/eng' salje se tekst

$room_info['amenities'] = [
  'bathroom' => Process::amenity_bool_image($room->bathroom),
  'kitchen' => Process::amenity_bool_image($room->kitchen),
  'terrace' => Process::amenity_bool_image($room->terrace),
  'air_conditioner' => Process::amenity_bool_image($room->air_conditioner),
  'tv' => Process::amenity_bool_image($room->tv),
  'other_amenities_srb' => $room->other_amenities_srb,
  'other_amenities_eng' => $room->other_amenities_eng
];

// --------opisi----------
//
$description_property = "description_" . $language;
$room_info['description'] = $room->$description_property;


// ---sve slike sobe----------

$all_images = Room_image::get_all(['room_id'=>$room_id]);
if(!empty($all_images)){
  foreach ($all_images as $image) {
    $room_info['images'][] = $image->get('name');
  }
}


// -----kalendar-------------------

$calendar = new Calendar($room);
$prices = new Prices($calendar);

$room_info['calendars'] = $prices->room_calendar_with_prices(1);




echo json_encode($room_info);
  ?>
