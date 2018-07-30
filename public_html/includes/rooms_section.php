<?php
use \App\Spaces\Room as Room;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;
?>

<div class="room" id='room_structure'>
  <div class="room_holder">

  <div class="room_owner">
      <p><?php echo $lang->vlasnik; ?>: <a href="#" class="owner"></a></p>
  </div>


<div class="room_profile_img">
  <div class="image_holder"><img src="#" alt="Room profile image"></div>
</div>

<div class="room_infos">
  <div>
    <p><span class="suite"></span></p>
  </div>
  <div>
    <p><?php echo $lang->objekat;?>: <span class="facility"></span></p>
  </div>
  <div class="the_place">
    <p><span class="suite_place"></span></p>
  </div>
  <div>
    <p><?php echo $lang->broj_kreveta; ?>: <span class='no_of_beds'></span></p>
  </div>
</div>

<div class="view_room">
  <div class="image_holder"><img class="the_room" src="/images/arrow.png" alt="" data-room_id=""></div>
</div>



  </div>
  <div class="room_social">
    <div>
      <div class="image_holder"><a class="fb_link"href=""><img src="/images/fb.png" alt=""></a></div>
    </div>
    <div>
      <div class="image_holder"><a class="insta_link"href=""><img src="/images/instagram.png" alt=""></a></div>
    </div>
  </div>
</div>
