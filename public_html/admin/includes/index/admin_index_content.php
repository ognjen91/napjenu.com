<?php
require_once __DIR__  .  "/../../../../vendor/autoload.php";

use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Helpers\Check as Check;
use \App\Facilities\Facility as Facility;
 ?>

  <?php
// // ===========ULOGOVANI KORISNIK====================
// $poss_users = Owner::get_all(['id'=>$_SESSION['owner_logged']]);
// if (empty($poss_users)) die ('Greška, molimo da se obratite administratoru');
//
// $owner = $poss_users[0];
?>
<!-- <?php
// var_dump($owner->all_owners_facilities());
foreach ($owner->all_owners_facilities() as $fac_id=>$fac_name) {
  ?>
<li><a href="../facility_ops/edit_facility.php?facility=<?php echo $fac_id; ?>>
<?php echo $fac_name; ?>
</a></li>
  <?php
} ?> -->



    <div class="ai_options">
      <div class="ai_add">
        <div class="image_holder">
          <a href="/admin/facility_ops/create_new.php">
        <img src="<?php echo SITE_ADRESS;?>/images/add.png" alt="add new image">
    </a>
        </div>
    </div>
    <div>
      Dodajte novi objekat
    </div>
    </div>


<h3 class="title1">Vаši objekti</h3>

    <div class="show_facilities">

      <?php
      $facilities = Facility::get_all(['owner_id'=>$owner->get('id')]);
      if (!empty($facilities)){


foreach ($facilities as $facility) {
// ================NOVA SOBA/APARTMAN/...==========================

?>
        <div class="ai_facility">
          <div class="ai_image">
            <div class='image_holder'>

              <img src="<?php echo SITE_ADRESS . "/photos/facilities/". $facility->profile_image; ?>">
            </div>
          </div>
          <div class="ai_basic_info">
            <p class="ai_fac_name">
              <?php echo $facility->name; ?>
            </p>
            <p class="ai_fac_place">
              <?php echo $facility->get('place'); ?>
            </p>
          </div>



          <div class="ai_go">
              <div class='image_holder'>
                <a href="<?php echo SITE_ADRESS . "/admin/view_facility.php?facility=".$facility->get('id');?>">
                <img src="<?php echo SITE_ADRESS . "/images/arrow.png ";?>" alt="">
                </a>
              </div>

          </div>


        </div>
        <?php
// ==========KRAJ SOBE/APARTMANA/.. ========================
}
  }

?>







    </div>
