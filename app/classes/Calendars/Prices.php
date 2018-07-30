<?php
namespace App\Calendars;


use App\Db_ops\Db_object as Db_object;
use App\Calendars\Calendar as Calendar;
use App\Spaces\Room as Room;
use Traits\Calendar\calendar_functions as calendar_functions;
Use DateTime as DateTime;

/*

u constructru prima kalendar i iz njega setuje potrebno
set_prices_and_discounts : setovanje objekta
arrangement_info : provjerava da li je aranzman moguc i ako jeste, vraca niz za cijenom bez popusta i popustom
arrangement_price : cijena aranzmana izmedju 2 datuma
room_calendar_with_prices : cjelokupan kalendar za sobu(prazni dani, cijene, popusti)...
create_db_prices_for_room() : pravljenje kalendara za novonaprvljenu sobu
arrangement_price: cijena aranzmana izmedju 2 datuma

*/

class Prices extends Db_object{
use calendar_functions;

protected static $db_table = "prices";
protected static $db_table_fields = ['id', 'room_id', 'year', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];

private $arrival_date;
private $departure_date;

protected $room_id;
public $year;
//sljedeca svosjtva uvodim zbog prenosa rowo-va iz baze
protected $january;
protected $february;
protected $march;
protected $april;
protected $may;
protected $june;
protected $july;
protected $august;
protected $september;
protected $october;
protected $november;
protected $december;
public static $db_table_years = ["2018", "2019", '2020'];
public static $english_months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
public static $new_prices_fileds = ['room_id', 'year', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
private $all_prices_and_discounts = [];

protected $room_calendar;

private static $default_price = 10;
private static $default_discount = 0;

private $return_info = ['error'=>1, 'message' => 'Greška! '];


public function __construct(Calendar $calendar = null){
  if (!$calendar) return;
  $this->room_calendar =  $calendar;
  $this->room_id = $calendar->room_id;

  $this->set_prices_and_discounts($this->room_id);
  // var_dump($this);
}







//pravljenje kalendara za novonaprvljenu sobu
public function create_db_prices_for_room(){
  foreach (self::$db_table_years as $year) {
      $this->year = $year;
    foreach (self::$english_months as $month) {
       $days_in_month = self::no_of_days_in_month($month, $year);
       $calendar_string = "";
       for  ($i=1;$i<=$days_in_month; $i++){
         $calendar_string .= $i . ":" . self::$default_price . "-" . self::$default_discount . ",";
       }
         $this->$month = $calendar_string;
      }
         $this->db_input_from_object(self::$db_table, self::$new_prices_fileds);
  }
}



//provjerava da li je aranzman moguc i ako jeste vraca cijenu bez popusta i popust
public function arrangement_info(DateTime $arrival_date, DateTime $departure_date){
  if ($arrival_date>$departure_date){
    $this->return_info['message'] += "Dolazni datum mora biti nakon odlaznog";
    return $this->return_info;
  }

  if ($this->room_calendar->is_reservtion_possible($arrival_date, $departure_date)){
      $this->return_info['error'] = 0;
      $prices_n_disc = $this->arrangement_price($arrival_date, $departure_date);
      // var_dump($this);
      return $prices_n_disc;

  } else {
    $this->return_info['message'] .= 'Nije moguca rezervacija u navedenom intervalu<br>
    Molimo, pokusajte sa drugim datumima.';
    return $this->return_info;
  }
}


//cjelokupni kalendari za sobu...
//u sustini, spajam svojstva all_prices_and_discounts i all_prices_and_discounts
//vraca niz u jsonu
public function room_calendar_with_prices($from_this_month = 0){
  $full_info = [];
  foreach ($this->all_prices_and_discounts as $date=>$info){
    $the_date = new DateTime($date);

   if($from_this_month){
     if ($the_date->format('Y').$the_date->format('m') < date('Ym')) continue;
   }

    $info['availability'] = !in_array($the_date, $this->room_calendar->all_unavailable_dates);
    $the_month = $the_date->format('m');
    $the_year = $the_date->format('Y');
    $the_day = $the_date->format('j');
    // $info['day_no'] = $the_date->format('j');


    $full_info[$the_year][$the_month]['days'][$the_day] = $info;


    $full_info[$the_year][$the_month]['empty_days'] = self::empty_days($the_month, $the_year);

    }




   return $full_info;

  }







// ===============CIJENA ARANZMANA========================
private function arrangement_price($arrival_date, $departure_date){
      $price = 0;
      $discount = 0;
      foreach($this->all_prices_and_discounts as $date=>$info){
        // var_dump($info);
        $new_date = new DateTime($date);
        if ($new_date >= $arrival_date && $new_date<=$departure_date){
          $this->return_info['message'] = 'Aranzman je moguc';
          $this->return_info['error'] = 0;

          $price += $info['price'];
          $discount += $info['discount'] * $info['price'] / 100;
          // (procenti)

          $this->return_info['price'] = $price - $discount;
          $this->return_info['discount'] = $discount;

        //TO JE U SUSTINI TO!
        //Treba samo malo preurediti, posebno popust

        }

      }
      return $this->return_info;
}






// =================SETOVANJE OBJEKTA=====================
public function set_prices_and_discounts(int $room_id){

  $room_p_n_d = self::get_all([ 'room_id' => $this->room_id ]);
  //imam niz objekata sa razlicitim godinama

  if (!$room_p_n_d || empty($room_p_n_d )) die('Ne postoje kalendari za datu sobu. Molimo, obratite se administratoru.');

  foreach ($room_p_n_d as $room_year_data) {
    foreach (self::$db_table_years as $year){
      if ($room_year_data->year == $year){
       foreach (self::$english_months as $month) {
         // var_dump($room_year_data->$month);
         $this_month_mixed = preg_split('/(\:|\-|,)/', $room_year_data->$month,-1, PREG_SPLIT_NO_EMPTY);
         // var_dump(self::no_of_days_in_month($month, $year));
         // var_dump($this_month_mixed);
         //$this_month_mixed je niz ciji je svaki treci clan (3n) novi dan u mjesecu 3n+1 je cijena a 3n+2 popust
          for ($i=0; $i<=self::no_of_days_in_month($month, $year)*3-3; $i=$i+3){
            $this->all_prices_and_discounts["$year-". self::month_str_to_int($month)."-". $this_month_mixed[$i]] = ['price'=>$this_month_mixed[$i+1], 'discount'=>$this_month_mixed[$i+2]];
          }

      }
  }
}

    }

      return !empty($this->all_prices_and_discounts);

}











//==========class end=====
}

?>
