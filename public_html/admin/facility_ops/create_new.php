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



<div class="cn_holder">

<h3>Kreiranje novog objekta</h3>

<form name="upload" method="post" action="create_new_proceed.php" enctype= "multipart/form-data">
<div class="cn_init_data">
  <div><p>Naziv objekta (obavezno)</p><input name='name' type="text"></div>

  <div>
    <p>Profilna slika (obavezno)</p>
    <input type="file" name="file_to_upload">
  </div>

<div>
  <p>Mjesto (obavezno)</p>
  <input type="text" name='place'>
</div>
<div>
  <p>Adresa</p>
  <input type="text" name='adress'>
</div>
<div>
  <p>Telefon 1</p>
  <input type="text" name='phone_1'>
</div>
<div>
  <p>Telefon 2</p>
  <input type="text" name='phone_2'>
</div>
<div>
  <p>Web sajt (ostaviti prazno ukoliko ne postoji)</p>
  <input type="text" name='website'>
</div>
<div>
  <p>Facebook (ostaviti prazno ukoliko ne postoji)</p>
  <input type="text" name='facebook'>
</div>
<div>
  <p>Instagram (ostaviti prazno ukoliko ne postoji)</p>
  <input type="text" name='instagram'>
</div>

</div>

<div class="cn_descriptions">
  <div class="cr_desc">
    <p>Opis objekta na srpskom</p>
    <textarea name="description_srb" id="" ></textarea>
  </div>
  <div class="cr_desc">
    <p>Opis objekta na engleskom</p>
    <textarea name="description_eng" id=""></textarea>
  </div>

  <input class="create_new_fac" type="submit" value='Kreiraj!' name='facility_create'>
</div>







</form>
</div>


 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
