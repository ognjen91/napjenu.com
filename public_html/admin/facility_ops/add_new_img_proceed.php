<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;


use \App\Images\Image as Image;
use \App\Images\Facility_image as Facility_image;


?>
<?php
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "../room_ops/check_fac_owner.php";
 ?>


 <?php

// var_dump($_FILES);


$no_of_imgs = count($_FILES['file_to_upload']['name']);
//kreiram novi objekat i objekat prima potrebne vrijednosti svosjtava
$fac_img = new Facility_image();
$fac_id = strval($_GET['facility']);

$fac_img->set_values(['facility_id'=>$fac_id]);
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

  $results[] = $fac_img->add_new_image($file_to_upload, '../../photos/facilities', Facility_image::db_table(), Facility_image::$new_img_fields);
  // echo "<br><br>";


// var_dump($file_to_upload);
 unset($file_to_upload);
}

foreach ($results as $result) {

  if ($result['error'] == 1){
    echo 'Jedna ili više slika nije uspješno uploadovana. Molimo da provjerite
      slike u korisničkom panelu objekta.';
      die();
  }
  }


echo "<h1>Slike uspjesno ubacene!</h1>";
echo "<h3><a class='go_back' href='/admin/facility_ops/facility_photos.php?facility=" .$fac_id. "'>Povratak na slike objekta</a></h3>";
echo "<h3><a class='go_back' href='/admin/view_facility.php?facility=" .$fac_id. "'>Povratak na glavnu stranicu objekta</a></h3>";

  ?>









   <!-- ============= FOOTER  ==================== -->
   <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
