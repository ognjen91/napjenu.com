<?php
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
?>

<?php
// =======PROVJERA DA LI JE VLASNIK SOBE=======
if(!isset($_GET['room'])) die ('Greska');
$room_id = intval($_GET['room']);

$room = Room::get_all( ['id'=>$room_id]);
if (empty($room)) die ('Greska');
$room = array_shift($room);
$facility = Facility::get_all( ['id'=>$room->get('facility_id')]);
if (empty($facility)) die ('Greska');
$facility = array_shift($facility);



// ===provjera da li je vlasnik sobe=============
if ($room->get('owner_id') !== $owner->get('id')) {
  die('Niste vlasnik ove sobe.');
}
// =============/================
 ?>
