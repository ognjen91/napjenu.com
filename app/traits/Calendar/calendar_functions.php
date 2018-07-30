<?php
namespace Traits\Calendar;
use DateTime as DateTime;

// next_month_calendars  : vraca podatke o buducim mjesecima
// no_of_days_in_month : broj dana u mjesecu
// empty_days : prazni dani na pocetku mjeseca
// month_str_to_int, month_int_to_str, serbian_month : konverzija mjeseci

trait calendar_functions {


  public static $serbian_months = ['Januar', 'Februar', 'Mart', 'April', 'May', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'];

  public static $russian_months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];




         //vraca niz sa prvim danima u mjesecu, pocev od ovog mjeseca do mjeseca datuma koji je argument
         //bice zgodno da se iskoristi za pravljenje KALENDARA
         //ovo posaljem kao json i laganica izvrsenje kalendara u js

        public function next_month_calendars(int $last_month, int $last_year){
           $months_info = [];
           $date1 = new DateTime('first day of this month');
           $date1->setTime(0, 0);
           $last_months_first_day = new DateTime("$last_year-$last_month-1");

           while($date1 <= $last_months_first_day){

           $month_of_date1 = strtolower($date1->format('F'));
           $no_of_month = $date1->format('m');

           $year_of_date1 = $date1->format('Y');

           $empty_days = self::empty_days($date1->format('m'), $year_of_date1);
           $no_od_days_in_month = self::no_of_days_in_month($month_of_date1, $year_of_date1);

           $months_info[] = ["month"=>$month_of_date1, "month_no"=>$no_of_month, "year"=>$year_of_date1,
           "first_day_of_month" => $date1->format("Y-m-d"), "no_of_days_in_month"=>$no_od_days_in_month,
           'empty_days'=>$empty_days];

           $date1->modify('+1 month');

         }


          // var_dump($first_days_of_months);
          return $months_info;
        }
  //



         // ======broj dana u mjesecu========
         public static function no_of_days_in_month(string $month, $year){
             $month = static::month_str_to_int($month);
             $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
             return $number;
         }



           // ===prazni dani na pocetku mjeseca==============
         public static function empty_days(int $month, int $year){

             $first_date_of_month = new DateTime("$year-$month-1");
             $first_day_of_month = $first_date_of_month->format('D');
             switch ($first_day_of_month) {
              case "Mon":
              $empty_days = 0;
              break;
              case "Tue":
              $empty_days = 1;
              break;
              case "Wed":
              $empty_days = 2;
              break;
              case "Thu":
              $empty_days = 3;
              break;
              case "Fri":
              $empty_days = 4;
              break
               ;case "Sat":
              $empty_days = 5;
              break;
              case "Sun":
              $empty_days = 6;
              break;
              default: die("wrong m/y format");
         }
               return $empty_days;

         }


         // /         =====================fje za pretvranje imena mjeseci string/int=========
             public static function month_str_to_int(string $month){
                 $month = strtolower($month);
         switch ($month) {
             case "january":
                 $month_int = 1;
                 break;
             case "february":
                 $month_int = 2;
                 break;
             case "march":
                 $month_int = 3;
                 break;
             case "april":
                 $month_int = 4;
                 break;
             case "may":
                 $month_int = 5;
                 break;
             case "june":
                 $month_int = 6;
                 break;
             case "july":
                 $month_int = 7;
                 break;
             case "august":
                 $month_int = 8;
                 break;
             case "september":
                 $month_int = 9;
                 break;
             case "october":
                 $month_int = 10;
                 break;
             case "november":
                 $month_int = 11;
                 break;
             case "december":
                 $month_int = 12;
                 break;
             default: die("wrong month name");



                       }
                    return $month_int;
                   }

// =========obrnuto, iz broja u string===================
public static function month_int_to_str(int $month){

switch ($month) {
case 1:
    $month_str = "january";
    break;
case 2:
    $month_str = "february";
    break;
case 3:
    $month_str = "march";
    break;
case 4:
    $month_str = "april";
    break;
case 5:
    $month_str = "may";
    break;
case 6:
    $month_str = "june";
    break;
case 7:
    $month_str = "july";
    break;
case 8:
    $month_str = "august";
    break;
case 9:
    $month_str = "september";
    break;
case 10:
    $month_str = "october";
    break;
case 11:
    $month_str = "november";
    break;
case 12:
    $month_str = "december";
    break;
default: die("wrong month value");
         }
       return $month_str;
      }



// ==pretvaranje u srpski mjesec-------UPDATE: za sva imena mjeseci========
//nek ostane ime za sada, mada je metoda za sve jezike
public static function serbian_month(int $month){
  if (isset($_GET['lang'])){
    if ($_GET['lang'] == 'en') return ucfirst(self::$english_months[$month-1]);
    if ($_GET['lang'] == 'ru') return ucfirst(self::$russian_months[$month-1]);
  }

  return self::$serbian_months[$month-1];
}


}



?>
