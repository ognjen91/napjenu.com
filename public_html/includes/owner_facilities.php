<?php
use App\Helpers\Process as Process;
 ?>

<?php foreach ($facilities as $facility): ?>

<div class="owner_facility">
  <div class="ow_fac_img">
    <?php
    $facility_link = "/facility.php?id=" .  $facility->get('id');

     ?>
    <div class="image_holder"><a href="<?php echo Process::add_lang_to_link($facility_link); ?>"><img src="/photos/facilities/<?php echo $facility->profile_image; ?>" alt=""></a></div>
  </div>

 <div class="ow_fac_info">
   <div>
     <p><?php echo $lang->Objekat; ?>: <span class="ow_fac"><?php echo $facility->name; ?></span></p>
   </div>
   <div>
     <p><?php echo $facility->get('place')?></p>
   </div>
 </div>

<div class="ow_fac_go">
  <div class="image_holder"><a href="<?php echo Process::add_lang_to_link($facility_link); ?>"><img src="/images/arrow.png" alt=""></a></div>
</div>


</div>


<?php endforeach; ?>
