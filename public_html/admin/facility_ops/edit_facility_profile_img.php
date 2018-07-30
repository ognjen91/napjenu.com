<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Facilities\Facility as Facility;
use \App\Db_ops\Connection as Connection;
use \App\Images\Facility_image as Facility_image;




$db = new Connection();

 ?>

 <?php

if (empty($_POST)) die("Greska");

$img_id = $_POST['img_id'];
$facility_id = $_POST['facility_id'];

$facility = Facility::get_all(['id'=>$facility_id])[0];
$new_profile_img = Facility_image::get_all(['id'=>$img_id])[0];

// var_dump($room);

$facility->set_values(['profile_image'=>$new_profile_img->get('name')]);


$update_profile_img = $facility->db_update_from_object(['profile_image'], ['id']);

if ($update_profile_img){
  echo json_encode(['message'=>'Profilna slika uspješno postavljena.']);
} else {
  echo json_encode(['message'=>'Pokušajte ponovo postavljanje profilne slike.']);
}



?>
