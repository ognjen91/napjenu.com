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
//1. BRISANJE iz baze
//2. brisanje iz foldera
//

$img_id = $_POST['img_id'];
$image = Facility_image::get_all( ['id'=>$img_id]);
if (empty($image)){
  echo json_encode(['message'=>'Slika ne postoji']);
  die();
}
$image = $image[0];


$delete = $image->delete_img(Facility_image::db_table(), "../../photos");

if(!$delete['error']){
  echo json_encode(['message'=>'Uspješno izbrisano']);
  die();
} else {
  echo json_encode(['message'=>'Greska pri brisanju']);
  die();
}







  ?>
