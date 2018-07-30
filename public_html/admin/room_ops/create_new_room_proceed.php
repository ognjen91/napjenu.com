<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Images\Image as Image;
use \App\Images\Room_image as Room_image;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;

use \App\Calendars\Prices as Prices;
use \App\Calendars\Calendar as Calendar;



?>

<?php
require_once "check_fac_owner.php";

?>

<?php


if(!isset($_POST['room_create'])) die('greska');


$owner_id = $_SESSION['owner_id'];


$new_room = new Room;


$new_room->set_values(['owner_id'=>$owner_id, 'facility_id'=>$active_facility->get('id')]);
$new_room->set_values($_POST, Room::$new_room_fields);


//1. ubac novog objekta u bazu
$creation = $new_room->db_input_from_object(Room::db_table(), Room::$new_room_fields);
if ($creation['error']) die('Greksa pri kreiranju objekta.');
$new_room_id = $db->pdo->lastInsertId();
$new_room->set_values(['id'=>$new_room_id]);


//2. ubac profilne slike
$room_profile_img = new Room_image();
$room_profile_img->set_values(['room_id'=>$new_room_id]);
$result = $room_profile_img->add_new_image($_FILES['file_to_upload'], '../../photos/suites', Room_image::db_table(), Room_image::$new_img_fields);
if ($result['error']) die('Objekat je kreiran, greska pri dodavanju slike. Molimo dodajte sliku preko korisnickog panela.');



//3. update koraka 1 - dodato ime slike

$new_room->set_values(['profile_image'=>$room_profile_img->get('name')]);
$new_room->db_update_from_object(['profile_image'], ['id']);






// var_dump($update);
// var_dump($new_room);
 ?>

 <?php
 if (!$creation['error'] && !$result['error']){


 ?>

<h1>Soba uspjesno kreirana!</h1>
<h3><a href="/admin/view_facility.php?facility=<?php  echo $active_facility->get('id')?>">Povratak na stranicu objekta</a></h3>

<?php
}




//treba ubaciti kalendare i cijene u bazu
$new_room_calendars = new Calendar();
$new_room_calendars->set_values(['room_id'=>$new_room_id]);
$created = $new_room_calendars->db_input_from_object(Calendar::db_table(), Calendar::$new_cal_fields);
//cijene
$new_prices = new Prices();
$new_prices->set_values(['room_id'=>$new_room_id]);
$new_prices->create_db_prices_for_room();



?>














 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
