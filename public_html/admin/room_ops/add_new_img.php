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
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "check_room_owner.php";
 ?>





<div class="ap_holder">


<form action="add_new_img_proceed.php?room=<?php echo $room->get('id'); ?>" method="POST" enctype="multipart/form-data">
<div class="ap_news">
  <div class="ap_new"><input type="file" name='file_to_upload[]'></div>
  <div class="ap_new"><input type="file" name='file_to_upload[]'></div>
  <div class="ap_new"><input type="file" name='file_to_upload[]'></div>
  <div class="ap_new"><input type="file" name='file_to_upload[]'></div>
</div>

  <div class="ap_new_field">
    <div class="ap_add">
    <div class="image_holder" id="ap_add_new"><img src="<?php echo SITE_ADRESS;?>/images/add.png" alt="add new image">
    </div>
    <div>Dodajte još slika sobe</div>
  </div>
</div>

  <div class="ap_proceed"><input type="submit" name="submit" value="Ubaci slike!"></div>
</form>



</div>












 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
