<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Images\Room_image as Room_image;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;


?>


<?php
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "check_room_owner.php";
 ?>



<?php


$room_id = $_GET['room'];

$room1 = Room::get_all(['id'=>$room_id = $_GET['room']])[0];
$calednar_of_room1 = new Calendar($room1);
$date1 = new DateTime('2018-8-1');
$date2 = new DateTime('2018-11-5');



// ==============IDEJA JE DA SVE BUDE AJAX+PHP=============
// svaki kalendar se mora ucitavati dinamicki:
// na inicijalizaciji jquery salje ajaxom zahtjev za kalendare...
// ...neke sobe i u js od iz zahtjeva uzimaju potrebna polja
// treba dati samo osnovnu strukturu kaledara,..
// .. ostalo se prilagodjava i reciklira


$prices = new Prices($calednar_of_room1);
// $is = $prices->arrangement_info($date1, $date2);
$edit_calendars_years = $prices->room_calendar_with_prices();
ksort($edit_calendars_years);
// var_dump($edit_calendars_years);

 ?>

 <div class="ec-holder">

<div class="ec_select">
  <div class="ec_select_month" >

<!-- ========selektor godine=========== -->
    <select name=""  id="ec_select_month">
    <?php
    for($i=1; $i<=12; $i++){
      if($i<10) $i = "0".$i;
        ?> <option value="<?php echo $i; ?>">
          <?php echo Calendar::serbian_month($i);?>
        </option><?php
      }
?>
    </select>
</div>

<!-- ============selektor mjeseca============= -->
    <div class="ec_select_year" ><select name="" id="ec_select_year">
      <?php foreach (Prices::$db_table_years  as $year): ?>
       <option value="<?php echo $year; ?>">
         <?php echo $year; ?>
       </option>

      <?php endforeach; ?>
    </select></div>
  </div>




   <div class="ec_main">



<?php

  // =====godine=====
foreach ($edit_calendars_years as $year=>$edit_calendar_year) {
?>
<div class='ec_year'>



<?php
  // ======mjeseci
  foreach ($edit_calendar_year as $month => $month_info) {
    ?>
    <div class='ec_month_holder' id="<?php echo $month."-".$year;?>">
      <h2><?php
      echo Calendar::serbian_month($month) ." ". $year;
      ?></h2>

    <div class="month ec_month"><?php
   // =====dani===========
    for ($i=1; $i<=$month_info['empty_days']; $i++){
      ?>    <div class="empty date ec_empty">no
          </div>
          <?php
        }
        foreach ($month_info['days'] as $day => $info) {


          ?>
  <div class="ec_date date" id="<?php echo "$year-$month-$day"; ?>" data-availability="<?php echo $info['availability']; ?>">
<div >
  <?php
  echo $day;
   ?>
   </div>
   <div class='ec_date_info'>
     <div><h5 class="ec_what">Slobodno</h5><input class='ava_check' type="checkbox" <?php if ($info['availability'] == true) echo "checked";?>></div>
     <div><h5 class="ec_what">Cijena  &euro;</h5><input type="text" class="ec_price" value='<?php echo $info['price']; ?>'></div>
     <div><h5 class="ec_what">Popust %</h5><input type="text" class="ec_discount" value='<?php echo $info['discount']; ?>'></div>
   </div>

<!-- //date end -->
    </div>

      <?php
    }



    ?>
<!-- /month-->
  </div>
  <!-- /month  holder end  -->
  </div><?php


  }
//kraj godine
  ?></div><?php




 }



 ?>

 <div class="ec_status status_gumb">
 <div class="ec_accept_msg accept_msg" id="ec_accept_msg">
  </div>
 <div class="ec_accept accept_btn">
 Sačuvajte promjene!
 </div>
 </div>


 </div>
 </div>











 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
