<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Images\Facility_image as Facility_image;

?>


<div class="ep_holder">
  <div class="ep_fields">
    <div class="fileds">
      <p>Username</p>
      <input type="text" data-id="<?php echo $owner->get('id');?>" id="username" value="<?php echo $owner->username;?>">
    </div>
    <div class="fileds">
      <p>E-mail</p>
      <input type="text" id='email' value="<?php echo $owner->get('email');?>">
    </div>
    <div class="fileds">
      <p>Ime i prezime</p>
      <input type="text" id="real_name" value="<?php echo $owner->get('real_name');?>">
    </div>
    <div class="fileds">
      <p>Lozinka</p>
      <input type="text" id='password' value="<?php echo $owner->get('password');?>">
    </div>
  </div>


  <div class="ep_status status_gumb">
  <div class="ep_accept_msg accept_msg" id="ep_accept_msg">
   </div>
  <div class="ep_accept accept_btn">
  Sačuvajte promjene!
  </div>
  </div>

</div>


















 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
