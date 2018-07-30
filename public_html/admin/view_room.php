<?php
require_once __DIR__ . "/includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Facilities\Facility as Facility;
use \App\Spaces\Room as Room;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Images\Room_image as Room_image;
?>


<?php
// =======PROVJERA DA LI JE VLASNIK SOBE=======
 require_once "room_ops/check_room_owner.php";
 ?>


<div class="vr_holder">
<a class="go_back" href="/admin/view_facility.php?facility=<?php echo $room->get('facility_id');?>">Povratak na stranicu objekta</a>
<!-- =============OPCIJE==================== -->
  <div class="vr_options">

     <div id="vr_options" class="vr_go">KLIKNITE ZA OPCIJE SOBE</div>

    <div class='vr_go'>
      <a href="room_ops/edit_calendars.php?room=<?php echo $room->get('id');?>">
      Mijenjajte kalendare
      </a>
    </div>

    <div class='vr_go'>
      <a href="room_ops/edit_room_info.php?room=<?php echo $room->get('id');?>">
      Mijenjajte podatke o sobi
      </a>
    </div>

    <div class='vr_go'>
      <a href="room_ops/room_photos.php?room=<?php echo $room->get('id');?>">
      Mijenjajte i dodajte slike
      </a>
    </div>



  </div>



<!-- ==============SLIKE======================= -->
<div class='vr_images'>


  <div class="view_room_profile_img">
    <div class="image_holder">
      <img src="<?php echo SITE_ADRESS ."/photos/suites/".$room->profile_image; ?>"
      alt="room profile image">
    </div>
  </div>


  <div class='vr_other_images'>
  <?php foreach (Room_image::get_all(['room_id'=>$room->get('id')]) as $room_img) {
    ?>
    <div class="vr_other_img">
      <div class="image_holder">
      <img src="<?php echo SITE_ADRESS. '/photos/suites/' . $room_img->get('name'); ?>" alt="room img">
      </div>
    </div>
    <?php
  }
    ?>
  </div>

</div>

<?php  ?>




<!-- =============POGODNOSTI=============== -->
<div class="vr_amenities">
  <div class="vr_listed_amenities listed_amenities">
    <div class="vr_amenity amenity">
      <p>Kuhinja: </p>
      <div class="image_holder"><img src="<?php echo Process::amenity_bool_image($room->kitchen);?>" alt=""></div>
    </div>
    <div class="vr_amenity amenity">
      <p>Kupatilo: </p>
      <div class="image_holder"><img src="<?php echo Process::amenity_bool_image($room->bathroom);?>" alt=""></div>
    </div>
    <div class="vr_amenity amenity">
      <p>Klima uređaj: </p>
      <div class="image_holder"><img src="<?php echo Process::amenity_bool_image($room->air_conditioner);?>" alt=""></div>
    </div>
    <div class="vr_amenity amenity">
      <p>Terasa: </p>
      <div class="image_holder"><img src="<?php echo Process::amenity_bool_image($room->terrace);?>" alt=""></div>
    </div>
    <div class="vr_amenity amenity">
      <p>TV: </p>
      <div class="image_holder"><img src="<?php echo Process::amenity_bool_image($room->tv);?>" alt=""></div>
    </div>
  </div>
</div>


<div class="vr_descriptions">
  <div class="vr_descr">
    <p class="vr_what">Ostale pogodnosti srpski</p>
    <p><?php echo $room->other_amenities_srb; ?></p>
  </div>
  <div class="vr_descr">
    <p class="vr_what">Ostale pogodnosti engleski</p>
    <p><?php echo $room->other_amenities_eng; ?></p>
  </div>
  <div class="vr_descr">
    <p class="vr_what">Opis sobe srpski</p>
    <p><?php echo $room->description_srb; ?></p>
  </div>
  <div class="vr_descr">
    <p class="vr_what">Opis sobe engleski</p>
    <p><?php echo $room->description_eng; ?></p>
  </div>
</div>





</div>


<!-- ============= FOOTER  ==================== -->
<?php require_once __DIR__ . "/includes/admin_footer.php"; ?>
