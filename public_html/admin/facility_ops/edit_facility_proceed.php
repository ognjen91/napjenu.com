<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Facilities\Facility as Facility;
use \App\Db_ops\Connection as Connection;



$db = new Connection();

 ?>



<?php
// var_dump($_POST);



if(!$_POST || empty($_POST)){
  echo json_encode(['message'=>'Greska!']);
  die();
}




$facility = Facility::get_all( ['id'=>$_POST['facility_id']]);

if (empty($facility)){
  echo json_encode(['message'=>'Greska!']);
  die();
}


$facility = $facility[0];

//priprema post za unos
unset($_POST['facility_id']);



$facility->set_values($_POST, Facility::$edit_info_fields);

$updated = $facility->db_update_from_object(Facility::$edit_info_fields, ['id']);

if (!$updated['error']){
  echo json_encode($updated);
  die();
}


echo json_encode(['message'=>'Morate unjeti bar jednu izmjenu.']);





?>
