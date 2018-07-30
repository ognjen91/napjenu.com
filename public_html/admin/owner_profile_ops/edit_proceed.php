<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Persons\Owner as Owner;
use \App\Db_ops\Connection as Connection;



$db = new Connection();

 ?>



<?php
// var_dump($_POST);



if(!$_POST || empty($_POST)){
  echo json_encode(['message'=>'Greska!']);
  die();
}




$user = Owner::get_all( ['id'=>$_POST['id']]);

if (empty($user)){
  echo json_encode(['message'=>'Greska!']);
  die();
}


$user = $user[0];

//priprema post za unos
unset($_POST['id']);



$user->set_values($_POST, Owner::$registration_fields);

$updated = $user->db_update_from_object(Owner::$registration_fields, ['id']);

if (!$updated['error']){
  echo json_encode($updated);
  die();
}


echo json_encode(['message'=>'Morate unjeti bar jednu izmjenu.']);





?>
