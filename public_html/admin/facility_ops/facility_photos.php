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
<?php
// PROVJERA DA LI JE VLASNIK OBJEKTA
 require_once "../room_ops/check_fac_owner.php";
 ?>


<div class="rp_holder">

<div class="rp_options">
  <div class="rp_add">
    <div class="image_holder">
      <a href="add_new_img.php?facility=<?php echo $active_facility->get('id'); ?>">
    <img src="<?php echo SITE_ADRESS;?>/images/add.png" alt="add new image">
</a>
    </div>
</div>
<div>
  Dodajte novu sliku
</div>
</div>







 <!-- ==============SLIKE======================= -->
 <div class='pr_images'>

<div class="pr_profile">
  <div class="prof_title">
    <h4>Profilna slika objekta</h4>
    <p>
      Profilna slika sobe se prikazuje u pretragama i kao prva na stranici objekta.
    </p>
  </div>

   <div class=" pr_profile_img">
     <div class="image_holder">
       <img src="<?php echo SITE_ADRESS ."/photos/facilities/".$active_facility->profile_image; ?>"
       alt="room profile image">
     </div>
   </div>
</div>


   <div class='rp_other_images'>
     <div class="oth_title">
       <h4>Sve slike objekta</h4>
     </div>
   <?php foreach (Facility_image::get_all(['facility_id'=>$active_facility->get('id')]) as $fac_img) {
     ?>

     <div class="rp_other">
     <div class="rp_other_img">
       <div class="image_holder">
       <img src="<?php echo SITE_ADRESS. '/photos/facilities/' . $fac_img->get('name'); ?>" alt="facility img" data-img-id="<?php echo $fac_img->get('id'); ?>">
       </div>
     </div>

     <div class="fp_delete"><p>Obrišite</p></div>
     <div class="fp_profile"><p>Profilna</p></div>
    </div>
     <?php
   }
     ?>
   </div>

 </div>




 <div class="rp_status status_gumb">
 <div class="rp_accept_msg accept_msg" id="rp_accept_msg">
  </div>
 <div class="rp_accept accept_btn fp_accept">
 Sačuvajte promjene!
 </div>
 </div>





</div>








 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
