<?php
namespace App\Calendars;


use App\Db_ops\Db_object as Db_object;
use App\Spaces\Room as Room;
use Traits\Calendar\calendar_functions as calendar_functions;
use DateTime as DateTime;

/*
//u construct-u prima argument objekat sobe, iz koga uzima id sobe i setuje objekat
//set_calendar_object : uzima podatke iz db polja i SVE zauzete datume ubacuje u svojstvo all_unavailable_dates
//is_reservtion_possible : provjera rezervacije

*/

class Calendar extends Db_object {
use calendar_functions;


public $room_id;
protected $id;
protected $y2018;
protected $y2019;
protected $y2020;




protected $active_month;
protected $active_year;
public $all_unavailable_dates = array(); //array sa objektima zauzetih datuma


protected static $db_table = "calendars";
public static $english_months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
public static $serbian_months = ['Januar', 'Februar', 'Mart', 'April', 'May', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'];
public static $russian_months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
public static $db_table_fields = ['id', 'room_id', 'y2018', 'y2019', 'y2020'];
public static $new_cal_fields = ['room_id'];
private static $db_table_years = ['y2018', 'y2019', 'y2020']; //ovo y jer ime varijable mora biti u bazi, a varijabla ne moze biti int
protected static $getters = ['room_id', 'y2018', 'y2019', 'y2020'];







public function __construct(Room $room = null){
    if (!$room) return; //ovo je jer treba inicijizovati objekat iz baze, bez argumenta...
    $room_id = $room->get('id');
    $this->set_calendar_object($room_id);
    // var_dump($this);
}




// ==========POTPUN OBJEKAT KALENDARA sa $all_unava_dates u kojem su svi zauzeti datumi========
public function set_calendar_object(int $room_id){
  $this->room_id = $room_id;

  $room_calendars = self::get_all([ 'room_id' => $this->room_id ]);
  if (!$room_calendars || empty($room_calendars)) die('Ne postoje kalendari za datu sobu. Molimo, obratite se administratoru.');

  $room_calendars = array_shift($room_calendars);
  // var_dump($room_calendars);
  // $output = preg_split( "/ (:|/) /",   $room_calendars);
  // var_dump($output);
  foreach (self::$db_table_years as $year) {
     $this->$year = $room_calendars->get($year);
     if (empty($this->year)) continue;
  } //sada je trenutni objekat primio svojstva iz baze

  foreach (self::$db_table_years as $year){
    $year_unav_dates_array = explode(",", $this->$year);


    foreach ($year_unav_dates_array as $unav_date) {
      $unav_date = new DateTime($unav_date);

      $this->all_unavailable_dates[] = $unav_date;
    }
  }

}


//iteriram kroz niz zauzetih datuma i ako se zauzeti datum nalazi u nizu, vraca false
public function is_reservtion_possible(DateTime $arrival_date , DateTime $departure_date){
   $today = new DateTime();
   $today->setTime(0, 0);
   // $arrival_date->setTime(1, 0);
   // $departure_date->setTime(1, 0);
   // var_dump($arrival_date);
   // var_dump($departure_date);
   // var_dump($today);

   if ($arrival_date < $today || $departure_date < $today) return false;
   if($arrival_date>$departure_date) echo "OOOOO";
   if($arrival_date>$departure_date) return false;

   //treba provjeriti da li u svojstvu sa zauzetim danima postoji neki koji je..
   //..iza datuma dolaska, a prije datuma odlaska
   foreach ($this->all_unavailable_dates as $unav_date){
      if ($unav_date >= $arrival_date && $unav_date <= $departure_date) return false;
   }

   return true;

}











//       ====class end====
              }










?>
