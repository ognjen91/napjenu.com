<?php foreach ($rooms as $room): ?>

  <?php
 $rooms_facility = $room->get_facility_info()['name'];
   ?>


  <div class="owner_room">
    <div class="ow_room_img">
      <div class="image_holder"><img class="the_room" src="/photos/facilities/<?php echo $facility->profile_image; ?>" alt="" data-room_id="<?php echo $room->get('id'); ?>"></div>
    </div>

   <div class="ow_room_info">
     <div>
       <p><?php echo $room->name; ?></p>
     </div>
     <div>
       <p><?php echo $lang->Objekat; ?>: <?php echo $rooms_facility; ?></p>
     </div>
   </div>

  <div class="ow_room_go">
    <div class="image_holder"><img src="/images/arrow.png" alt="" class="the_room" data-room_id="<?php echo $room->get('id'); ?>"></div>
  </div>


  </div>


<?php endforeach; ?>
