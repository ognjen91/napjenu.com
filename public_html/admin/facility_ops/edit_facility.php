<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Facilities\Facility as Facility;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;


?>
<?php
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "../room_ops/check_fac_owner.php";
 ?>

<div class="er_holder">


  <div class="er_field"><p>Naziv objekta</p><input id="name" type="text" value="<?php echo $active_facility->name; ?>"></div>

  <div class="er_field">
    <p>Mjesto</p>
    <input type="text" value='<?php echo $active_facility->get('place'); ?>' id='place'>
  </div>
  <div class="er_field">
    <p>Adresa</p>
    <input type="text" value='<?php echo $active_facility->get('adress'); ?>' id='adress'>
  </div>
  <div class="er_field">
    <p>Telefon 1</p>
    <input type="text" value='<?php echo $active_facility->get('phone_1'); ?>' id='phone_1'>
  </div>
  <div class="er_field">
    <p>Telefon 2</p>
    <input type="text" value='<?php echo $active_facility->get('phone_2'); ?>' id='phone_2'>
  </div>
  <div class="er_field">
    <p>Web sajt (prazno ako ne postoji)</p>
    <input type="text" value='<?php echo $active_facility->get('website'); ?>' id='website'>
  </div>
  <div class="er_field">
    <p>Facebook (prazno ako ne postoji)</p>
    <input type="text" value='<?php echo $active_facility->get('facebook'); ?>' id='facebook'>
  </div>
  <div class="er_field">
    <p>Instagram (prazno ako ne postoji)</p>
    <input type="text" value='<?php echo $active_facility->get('instagram'); ?>' id='instagram'>
  </div>

<div class="er_descriptions ef_descriptions">

<div class="er_field">
  <p>Opis sobe na srpskom (klik na tekst za izmjenu):</p>
  <textarea type="text" id='description_srb' class="er_descriptions"><?php echo $active_facility->get('description_srb'); ?></textarea>
</div>

<div class="er_field">
  <p>Opis sobe na engleskom (klik na tekst za izmjenu):</p>
  <textarea type="text" id='description_eng' class="er_descriptions"><?php echo $active_facility->get('description_eng'); ?></textarea>
</div>

</div>


<div class="ef_status status_gumb">
<div class="ef_accept_msg accept_msg" id="ef_accept_msg">
 </div>
<div class="ef_accept accept_btn">
Sačuvajte promjene!
</div>
</div>


</div>











 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
