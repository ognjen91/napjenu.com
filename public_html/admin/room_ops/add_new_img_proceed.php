<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;


use \App\Images\Image as Image;
use \App\Images\Room_image as Room_image;


?>
<?php
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "check_room_owner.php";
 ?>


 <?php

// var_dump($_FILES);


$no_of_imgs = count($_FILES['file_to_upload']['name']);
//kreiram novi objekat i objekat prima potrebne vrijednosti svosjtava
$room_img = new Room_image();
$room_id = strval($_GET['room']);

$room_img->set_values(['room_id'=>$room_id]);
$results = [];

for ($i=0; $i<$no_of_imgs; $i++){
  // var_dump($_FILES['file_to_upload']);
  $file_to_upload = [];

  $file_to_upload['name'] = $_FILES['file_to_upload']['name'][$i];
  if (!$file_to_upload['name']) continue;

  $file_to_upload['tmp_name'] = $_FILES['file_to_upload']['tmp_name'][$i];
  $file_to_upload['type'] = $_FILES['file_to_upload']['type'][$i];
  $file_to_upload['error'] = $_FILES['file_to_upload']['error'][$i];
  $file_to_upload['size'] = $_FILES['file_to_upload']['size'][$i];



  // var_dump($file_to_upload);


// var_dump(${"photo" . $i});
  //unos objekta u bazu

  $results[] = $room_img->add_new_image($file_to_upload, '../../photos/suites', Room_image::db_table(), Room_image::$new_img_fields);
  // echo "<br><br>";


// var_dump($file_to_upload);
 unset($file_to_upload);
}

foreach ($results as $result) {

  if ($result['error'] == 1){
    echo 'Jedna ili više slika nije uspješno uploadovana. Molimo da provjerite
      slike u korisničkom panelu sobe.';
      die();
  }
  }

  echo "<a href='/admin/room_ops/room_photos.php?room=" .$room_id. "' class='go_back'>Povratak na slike sobe</a>";

  echo "<a href='/admin/view_room.php?room=" .$room_id. "' class='go_back'>Povratak na stranicu sobe</a>";
  echo "<br />";
echo "<h1>Slike uspjesno ubacene!</h1>";


  ?>









   <!-- ============= FOOTER  ==================== -->
   <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
