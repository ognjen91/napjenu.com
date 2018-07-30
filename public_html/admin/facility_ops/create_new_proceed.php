<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;

use \App\Facilities\Facility as Facility;

use \App\Images\Room_image as Room_image;
use \App\Images\Facility_image as Facility_image;




?>


<?php


if(!isset($_POST['facility_create'])) die('greska');


$owner_id = $_SESSION['owner_id'];


$new_facility = new Facility;


$new_facility->set_values(['owner_id'=>$owner_id]);
$new_facility->set_values($_POST, Facility::$new_fac_fields);


//1. ubac novog objekta u bazu
$creation = $new_facility->db_input_from_object(Facility::db_table(), Facility::$new_fac_fields);
if ($creation['error']) die('Greksa pri kreiranju objekta.');
$new_fac_id = $db->pdo->lastInsertId();
$new_facility->set_values(['id'=>$new_fac_id]);


//2. ubac profilne slike
$fac_profile_img = new Facility_image();
$fac_profile_img->set_values(['facility_id'=>$new_fac_id]);
$result = $fac_profile_img->add_new_image($_FILES['file_to_upload'], '../../photos/facilities', Facility_image::db_table(), Facility_image::$new_img_fields);
if ($result['error']) die('Objekat je kreiran, greska pri dodavanju slike. Molimo dodajte sliku preko korisnickog panela.');



//3. update koraka 1 - dodato ime slike

$new_facility->set_values(['profile_image'=>$fac_profile_img->get('name')]);
$new_facility->db_update_from_object(['profile_image'], ['id']);






// var_dump($update);
// var_dump($new_room);
 ?>

 <?php
 if (!$creation['error'] && !$result['error']){


 ?>

<h1>Objekat uspjesno kreiran!</h1>
<h2><a class='go_back' href="/admin">Klik za povratak na index stanicu.</a></h2>

<?php
}





?>














 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
