<?php
// require_once "../../../vendor/autoload.php";
require_once "../../../app/config/_env.php";
use \App\Db_ops\Sql as Sql;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;
use \App\Spaces\Room as Room;
use \App\Db_ops\Connection as Connection;



$db = new Connection();

 ?>


<?php

if (!$_POST['calendar_data']) die('greska');

$room_id = $_POST['calendar_data']['room_id'];

//ucitavanje sobe, kalendara, cijena
$room = Room::get_all(['id'=>$room_id])[0];
$calendar = new Calendar($room);
$prices = new Prices($calendar);


// var_dump($_POST['calendar_data']);



// UPDATE KALENDARA I CIJENA================

$db->pdo->beginTransaction();

try{
//1. update datuma
if(!empty($_POST['calendar_data']['unavailable'])){
  foreach ($_POST['calendar_data']['unavailable'] as $year=>$unav_dates) {

  $calendar->set_values(["y".$year => $unav_dates]);
  }
}

$calendar->db_update_from_object(['y2018', 'y2018', 'y2019'], ['room_id']);


//2. update cijena i popusta
foreach ($_POST['calendar_data']['prices_n_disc'] as $year => $months) {
  $prices->set_values(['year'=>$year]);

 foreach ($months as $month => $prices_n_discounts) {
    $month_name = Calendar::month_int_to_str($month);
    $prices->set_values([$month_name=>$prices_n_discounts]);
  }

  $prices->db_update_from_object(Prices::$english_months, ['room_id', 'year']);
}


$db->pdo->commit();
echo json_encode(['message'=>'Izmjene uspjesne']);


}catch(Exception $e){

    echo $e->getMessage();

    $db->pdo->rollBack();
    echo json_encode(['message'=>'Greška!']);
}





 ?>
