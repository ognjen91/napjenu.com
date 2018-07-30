<?php
require_once __DIR__ . "/includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Facilities\Facility as Facility;

use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Images\Room_image as Room_image;
?>

<div class="vp_holder">


<div class="vp_user_infos">
  <div class="vp_info">
    <p class='vp_what'>Korisničko ime</p>
    <p class='vp_output'><?php echo $owner->username; ?></p>
  </div>
  <div class="vp_info">
    <p class='vp_what'>e-mail</p>
    <p class='vp_output'><?php echo $owner->get('email') ?></p>
  </div>
  <div class="vp_info">
    <p class='vp_what'>Ime i prezime</p>
    <p class='vp_output'><?php echo $owner->get('real_name'); ?></p>
  </div>
</div>

<div class="vp_options">
  <div class="vp_add">
    <div class="image_holder">
      <a href="owner_profile_ops/edit.php">
    <img src="<?php echo SITE_ADRESS;?>/images/edit.png" alt="add new image">
</a>
    </div>
</div>
<div>
  Promjenite podatke profila
</div>
</div>






</div>

<!-- ============= FOOTER  ==================== -->
<?php require_once __DIR__ . "/includes/admin_footer.php"; ?>
