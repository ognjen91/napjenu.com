<?php
require_once "../../app/config/_env.php";
use \App\Calendars\Calendar as Calendar;
use \App\Facilities\Facility as Facility;
use \App\Db_ops\Connection as Connection;
use DateTime as DateTime;

$db = new Connection;
 ?>





 <?php
// var_dump($_POST);


$conditions = [];
if (isset($_POST['filters']['place']) && $_POST['filters']['place']) $conditions['place'] = $_POST['filters']['place'];



$all_facilities = Facility::get_all($conditions);
$return_info = [];



foreach ($all_facilities as $facility) {
  $return_info[$facility->get('id')] = [
    'id' => $facility->get('id'),
    'name' => $facility->name,
    'owner'=> $facility->get_owner_name(),
    'place'=> $facility->get('place'),
    'profile_image'=>$facility->profile_image,
    'facebook'=> $facility->get('facebook'),
    'instagram'=> $facility->get('instagram')
  ];
}



echo json_encode($return_info);

 ?>
