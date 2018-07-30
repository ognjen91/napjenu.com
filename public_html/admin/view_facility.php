<?php
require_once __DIR__ . "/includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Images\Facility_image as Facility_image;
use \App\Helpers\Check as Check;
?>

<?php
$fac_id = intval($_GET['facility']);
if (!is_int($fac_id)) die('Greska!');

$facility = Facility::get_all(['id'=>$_GET['facility']]);
if (empty($facility)) die ('Greska');
$facility = array_shift($facility);

// ===provjera da li je vlasnik objekta=============
if ($facility->get('owner_id') !== $owner->get('id')) {
  die('Niste vlasnik ovog objekta');
}
 ?>


<div class="vf_holder">
  <a class="go_back" href="/admin">Povratak na izbor objekta</a>

  <!-- =======VF OPCIJE========== -->
  <div class="ef_options">
  <div id="ef_options" class="vf_go">KLIKNITE ZA OPCIJE OBJEKTA</div>

  <div class='vf_go'>
    <a href="facility_ops/facility_photos.php?facility=<?php echo $facility->get('id'); ?>">
    Mijenjajte i dodavajte slike
    </a>
  </div>

  <div class='vf_go'>
    <a href="facility_ops/edit_facility.php?facility=<?php echo $facility->get('id'); ?>">
    Promjenite podatke
    </a>
  </div>

  <div class='vf_go'>
    <a href="delete_facility.php?facility=<?php echo $facility->get('id'); ?>">
    Obrišite objekat
    </a>
  </div>


  </div>




    <div class="rp_options vf_options">
      <div class="rp_add">
        <div class="image_holder">
          <a href="room_ops/create_new_room.php?facility=<?php echo $facility->get('id'); ?>">
        <img src="<?php echo SITE_ADRESS;?>/images/add.png" alt="add new image">
    </a>
        </div>
    </div>
    <div>
      Dodajte novu sobu
    </div>
    </div>



<!-- ======OSNOVNI PODACI O OBJEKTU================== -->
<div class="vf_infos">

  <div class='vf_image'>

      <div class="vf_profile_img">
        <div class="image_holder">
          <img src="<?php echo SITE_ADRESS ."/photos/facilities/".$facility->profile_image; ?>"
          alt="facility profile image">
        </div>
      </div>


      <div class='vr_other_images'>
      <?php foreach (Facility_image::get_all(['facility_id'=>$facility->get('id')]) as $fac_img) {
        ?>
        <div class="vr_other_img">
          <div class="image_holder">
          <img src="<?php echo SITE_ADRESS. '/photos/facilities/' . $fac_img->get('name'); ?>" alt="facility img">
          </div>
        </div>
        <?php
      }
        ?>
      </div>

  </div>

<div class='vf_info'>
  <div>
    <p>Naziv objekta: <?php echo $facility->name; ?></p>
  </div>
  <div>
    <p>Adresa:  <?php echo $facility->get('adress'); ?></p>
  </div>
  <div>
    <p>Mjesto:  <?php echo $facility->get('place'); ?></p>
  </div>
  <div>
    <p>Telefon 1:  <?php echo $facility->get('phone_1'); ?></p>
  </div>
  <div>
    <p>Telefon 2:  <?php echo $facility->get('phone_2'); ?></p>
  </div>
  <div>
    <p>Web sajt:  <?php
     echo $facility->get('website');
     ?></p>
  </div>
  <div>
    <p>Facebook:  <?php
     echo $facility->get('facebook');
     ?></p>
  </div>
  <div>
    <p>Instagram:  <?php
     echo $facility->get('instagram');
     ?></p>
  </div>
</div>

</div>



<!-- ==============PRIKAZ SOBA============================ -->

<div class="vf_rooms">
<h3>Sobe u objektu</h3>
<div class='vf_rooms_holder'>

<?php
$all_rooms = Room::get_all(['facility_id'=>$fac_id]);
if (!empty($all_rooms)){
foreach ($all_rooms  as $room): ?>

<div class="vf_room">

<div class="vf_room_img">
  <div class="image_holder">
    <img src="<?php echo SITE_ADRESS ."/photos/suites/".$room->profile_image; ?>"
    alt="room profile image">
  </div>
  </div>

<div class='vf_room_info'>
  <p>
  <?php echo $room->name; ?>
  </p>
</div>

<div class="vf_go_room">
  <div class="image_holder"><a href="<?php echo SITE_ADRESS . "/admin/view_room.php?room=" . $room->get('id');?>">
    <img src="<?php echo SITE_ADRESS;?>/images/arrow.png" alt="">
  </a></div>
</div>

</div>


<?php endforeach;
} else {
  echo "Niste još dodali ni jednu sobu za ovaj objekat.";
}
?>




</div>


</div>




</div>
<!-- ============= FOOTER  ==================== -->
<?php require_once __DIR__ . "/includes/admin_footer.php"; ?>
