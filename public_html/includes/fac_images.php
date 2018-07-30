<?php
use \App\Images\Facility_image as Facility_image;


 ?>

<?php

$all_images = Facility_image::get_all(['facility_id'=>$facility_id]);


 ?>

 <div class="fac_big_img">
 <div class="fac_nav">
   <div class="image_holder" id="left"><img  src="/images/left.png" alt=""></div>
 </div>

<div class="fac_profile_img">
<div class="image_holder"><img id='fac_big_img' src="/photos/facilities/<?php echo $facility->profile_image ?>" alt=""></div>
</div>

   <div class="fac_nav">
    <div class="image_holder" id="right"><img src="/images/left.png" alt=""></div>
   </div>
</div>


 <div class="fac_all_images">

<?php

foreach ($all_images as $image) {
         ?>
<div class="fac_image">
  <div class="image_holder"><img src="/photos/facilities/<?php echo $image->get('name'); ?>" alt=""></div>
</div>
         <?php
}

?>


 </div>
