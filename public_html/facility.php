<?php
require_once "includes/header.php";
use App\Db_ops\Connection as Connection;
use App\Facilities\Facility as Facility;
use App\Persons\Owner as Owner;
use App\Spaces\Room as Room;
use App\Helpers\Process as Process;


$db = new Connection();
?>

<?php

if (empty($_GET)) die('greska');
$facility_id = $_GET['id'];

$pot_facilities = Facility::get_all(['id'=>$facility_id]);
if (empty($pot_facilities)) die('greska');

$facility = $pot_facilities[0];

$owner = Owner::get_all(['id'=> $facility->get('owner_id')])[0];
$rooms = Room::get_all(['facility_id'=>$facility->get('id')]);

?>


<div class="facility_wrap">

  <!-- PRIKAZ ODABRANE SOBE -->
  <div class="room_selected">
    <?php require_once "includes/room_selected.php"; ?>
  </div>

   <!-- NASLOVNE INFORMACIJE -->
  <div class="basic_info">
    <div>
      <p class="fac_name"><?php echo $facility->name;?></p>

      <p class="fac_place"><?php echo $facility->get('place'); ?></p>

        <?php
       $owner_link = "/owner.php?id=" .  $facility->get('owner_id');

         ?>
      <p class="fac_owner"><?php echo $lang->Vlasnik;?>: <a href="<?php echo Process::add_lang_to_link($owner_link); ?>" id="fac_owner"> <?php echo $owner->username; ?></a></p>
      <?php

      if ($facility->get('website')){
        ?>

          <p class="fac_website"><a href="http://<?php echo $facility->get('website');?>">web site</a></p>

        <?php
      }

      ?>
    </div>

    <div class="send_fac_message">
      <div class="fac_message">  <p><?php echo $lang->poruka_objekat;?></p>
        <div>
          <div class="image_holder"><img id='send_fac_msg' src="/images/message.png" alt="send message to owner"></div>
       </div>
     </div>

      <div class="fac_social">
        <div>
          <div class="image_holder"><a class="ow_fb" href="http://<?php echo $facility->get('facebook');?>"><img src="/images/fb.png" alt=""></a></div>
        </div>
        <div>
          <div class="image_holder"><a class="ow_insta" href="http://<?php echo $facility->get('instagram');?>"><img src="/images/instagram.png" alt=""></a></div>
        </div>
      </div>

    </div>

  </div>

  <!-- SLIKE -->
  <div class="fac_images">
    <?php require_once 'includes/fac_images.php'; ?>
  </div>

  <!-- OPISI I INFO -->
  <div class="fac_infos">
      <?php require_once 'includes/fac_infos.php'; ?>
  </div>



<!-- SOBE -->
<p class="fac_rooms_title"><?php echo $lang->objekat_sobe_naslov; ?> <?php echo $facility->name; ?></p>

 <div class="fac_rooms">

       <?php require_once 'includes/fac_rooms.php'; ?>

 </div>




<div class="medias">
<?php
if ($facility->get('website')){
  ?>
  <div class="fac_website">
    <p><a href="<?php echo $facility->get('website');?>">WEB SAJT OBJEKTA</a></p>
  </div>
  <?php
}

?>

  <div>
    <div class="image_holder"><a class="fac_fb" href="<?php echo $facility->get('facebook');?>"><img src="" alt=""></a></div>
  </div>
  <div>
    <div class="image_holder"><a class='fac_insta' href="<?php echo $facility->get('instagram');?>"><img src="/images/instagram.png" alt=""></a></div>
  </div>
</div>




</div>











<!-- =========FOOTER============ -->
<?php require_once "includes/footer.php"; ?>
