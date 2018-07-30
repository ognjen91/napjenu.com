

<?php

foreach ($rooms as $room) {
  ?>

  <div class="fac_room">
    <div class="room_holder">


  <div class="room_profile_img">
    <div class="image_holder"><img src="photos/suites/<?php echo $room->profile_image; ?>" alt="Room profile image" class="the_room" data-room_id="<?php echo $room->get('id'); ?>"></a></div>
  </div>

  <div class="room_infos">
    <div>
      <p><span class="suite"><?php echo $room->name; ?></span></p>
    </div>
    <div>
      <p><?php echo $lang->broj_kreveta; ?>: <span class='no_of_beds'><?php echo $room->no_of_beds;?></span></p>
    </div>
  </div>





    </div>
  </div>



  <?php
}
 ?>
