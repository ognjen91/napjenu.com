<?php
use \App\Spaces\Room as Room;
use \App\Facilities\Facility as Facility;
use \App\Calendars\Calendar as Calendar;
use \App\Calendars\Prices as Prices;
?>

<div class="new_facility" id='facility_structure'>
  <div class="facility_holder">

<div class="facility_profile_img">
  <div class="image_holder"><a href=""><img src="#" alt="facility profile image"></a></div>
</div>



<div class="facility_infos">
  <div>
    <p><span class="facility_name"></span></p>
  </div>
  <div>
    <p><?php echo $lang->Mjesto; ?>: <span class="facility_place"></span></p>
  </div>
  <div>
    <p><?php echo $lang->Vlasnik; ?>: <span class='facility_owner'></span></p>
  </div>
</div>




<div class="the_facility">
  <div class="image_holder"><a href=""><img class="view_fac" src="/images/arrow.png" alt="go to facility page" data-facilityid=""></a></div>
</div>


  </div>
  <div class="fac_social">
    <div>
      <div class="image_holder"><a class='fac_facebook' href=""><img src="/images/fb.png" alt=""></a></div>
    </div>
    <div>
      <div class="image_holder"><a class='fac_instagram' href=""><img src="/images/instagram.png" alt=""></a></div>
    </div>
  </div>
</div>
