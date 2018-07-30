<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;

use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;


?>

<?php
require_once "check_fac_owner.php";

?>


<div class="cn_holder">

<h3 class="create_room_title">Kreiranje nove sobe</h3>

<form name="upload" method="post" action="create_new_room_proceed.php?facility=<?php echo $active_facility->get('id'); ?>" enctype= "multipart/form-data">
<div class="cn_init_data">
  <div><p>Naziv sobe (obavezno)</p><input name='name' type="text"></div>

  <div>
    <p>Profilna slika (obavezno)</p>
    <input type="file" name="file_to_upload">
  </div>

  <div><p>Broj kreveta (obavezno)</p><select name="no_of_beds" id="">
 <?php for ($i=1; $i<=8; $i++){
 ?>
<option value='<?php echo $i;?>'> <?php echo $i; ?> </option>

 <?php
 }
  ?>
  </select></div>

  <div><p>Kupatilo</p><select name="bathroom" id="">
    <option value="1">Da</option>
    <option value="0">Ne</option>
  </select></div>

  <div><p>Kuhinja</p><select name="kitchen" id="">
    <option value="1">Da</option>
    <option value="0">Ne</option>
  </select></div>

  <div><p>Terasa</p><select name="terrace" id="">
    <option value="1">Da</option>
    <option value="0">Ne</option>
  </select></div>

  <div><p>Klima uređaj</p><select name="air_conditioner" id="">
    <option value="1">Da</option>
    <option value="0">Ne</option>
  </select></div>

  <div><p>TV</p><select name="tv" id="">
    <option value="1">Da</option>
    <option value="0">Ne</option>
  </select></div>


</div>

<div class="cn_descriptions">
  <div class="cr_others">
    <p>Ostale pogodnosti srpski</p>
    <textarea name="other_amenities_srb" id="" ></textarea>
  </div>
  <div class="cr_others">
    <p>Ostale pogodnosti engleski</p>
    <textarea name="other_amenities_eng" id=""></textarea>
  </div>
  <div class="cr_desc">
    <p>Opis sobe na srpskom</p>
    <textarea name="description_srb" id="" ></textarea>
  </div>
  <div class="cr_desc">
    <p>Opis sobe na engleskom</p>
    <textarea name="description_eng" id="" ></textarea>
  </div>

  <input type="submit" value='Kreiraj!' name='room_create' class='create_new_fac'>
</div>







</form>
</div>


 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
