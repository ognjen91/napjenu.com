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

<div class="er_holder">


  <div class="er_field"><p>Naziv sobe</p><input id="name" type="text" value="<?php echo $room->name; ?>"></div>
  <div class="er_field"><p>Broj kreveta</p>

  <select name="beds" id="beds">
  <?php for ($i=1; $i<=8; $i++){
    ?>
    <option value="<?php echo $i;?>" <?php
if ($i==$room->no_of_beds) echo "selected='selected'";
    ?>> <?php echo $i;?> </option>
   <?php
    }
    ?>
  </select> </div>

<div class="er_field"><p>Kupatilo</p> <select name="bathroom" id="bathroom">
<option value="<?php echo $room->bathroom; ?>"><?php echo Process::da_ne($room->bathroom);?></option>
<option value="<?php echo Process::opposite($room->bathroom); ?>"><?php echo Process::da_ne(!$room->bathroom);?></option>
</select> </div>


<div class="er_field"><p>Kuhinja</p> <select name="kitchen" id="kitchen">
<option value="<?php echo $room->kitchen; ?>"><?php echo Process::da_ne($room->kitchen);?></option>
<option value="<?php echo Process::opposite($room->kitchen); ?>"><?php echo Process::da_ne(!$room->kitchen);?></option>
</select> </div>

<div class="er_field"><p>Terasa</p> <select name="terrace" id="terrace">
<option value="<?php echo $room->terrace; ?>"><?php echo Process::da_ne($room->terrace);?></option>
<option value="<?php echo Process::opposite($room->terrace); ?>"><?php echo Process::da_ne(!$room->terrace);?></option>
</select> </div>

<div class="er_field"><p>Klima uređaj</p> <select name="air_conditioner" id="air_conditioner">
<option value="<?php echo $room->air_conditioner; ?>"><?php echo Process::da_ne($room->air_conditioner);?></option>
<option value="<?php echo Process::opposite($room->air_conditioner); ?>"><?php echo Process::da_ne(!$room->air_conditioner);?></option>
</select> </div>

<div class="er_field"><p>TV</p> <select name="tv" id="tv">
<option value="<?php echo $room->tv; ?>"><?php echo Process::da_ne($room->tv);?></option>
<option value="<?php echo Process::opposite($room->tv); ?>"><?php echo Process::da_ne(!$room->tv);?></option>
</select> </div>





<div class="er_descriptions">
<div class="er_field">
  <p>Ostale pogodnosti srpski (klik na tekst za izmjenu)</p>
  <textarea id='other_amenities_srb' class="er_other" ><?php echo $room->other_amenities_srb; ?></textarea>
</div>
<div class="er_field">
  <p>Ostale pogodnosti engleski (klik na tekst za izmjenu)</p>
  <textarea type="text" id='other_amenities_eng' class="er_other"><?php echo $room->other_amenities_eng; ?></textarea>
</div>

<div class="er_field">
  <p>Opis sobe na srpskom (klik na tekst za izmjenu):</p>
  <textarea type="text" id='description_srb' class="er_descriptions"><?php echo $room->description_srb; ?></textarea>
</div>

<div class="er_field">
  <p>Opis sobe na engleskom (klik na tekst za izmjenu):</p>
  <textarea type="text" id='description_eng' class="er_descriptions"><?php echo $room->description_eng; ?></textarea>
</div>

</div>


<div class="er_status status_gumb">
<div class="er_accept_msg accept_msg" id="ec_accept_msg">
 </div>
<div class="er_accept accept_btn">
Sačuvajte promjene!
</div>
</div>


</div>











 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
