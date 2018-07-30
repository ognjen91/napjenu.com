<?php
// require_once "../../../vendor/autoload.php";
// require_once "../../app/config/_env.php";
use \App\Helpers\Check as Check;

 ?>

<div class="hamburger_menu" id="hamburger">
  <div class="image_holder">
    <img src="<?php echo SITE_ADRESS; ?>/images/hamburger.svg" alt="hamburger menu">
 </div>
</div>





<div class="main_nav">
<div class="close_nav">x</div>

<ul>
  <li><a href="<?php echo SITE_ADRESS; ?>">Posjetite sajt</a></li>
  <li><a href="<?php echo SITE_ADRESS; ?>/admin">Admin home</a></li>
  <li id='nav_log_out'><a href="/admin/owner_profile_ops/logout.php">Log_out</a></li>
</ul>
</div>



<div class='logo'>
  <div class="image_holder">
    <img src="<?php echo SITE_ADRESS;?>/images/logo.png">
 </div>
</div>


<?php if(!Check::is_on_page('login')){
  ?>


<div class="logged_owner_info">
  <div class="nav_profile_img">
    <div class="image_holder"><img src="/images/user.png" alt=""></div>
  </div>

  <div class="nav_username">
    <?php echo $owner->username; ?> </a>
  </div>

  <div class="show_nav_profile_options">
    <div class="image_holder"><img src="/images/arrow2.png" alt=""></div>
  </div>
</div>

<?php
}
  ?>

<div class="nav_profile_options">
  <div class="profile_option"><a href="/admin/view_profile.php">
      <p>Vaš profil</p>
    </a></div>
  <div class="profile_option"><a href="../admin/owner_profile_ops/edit.php">
      <p>Izmjena profila</p>
    </a></div>
  <div class="profile_option"><a href="/admin/owner_profile_ops/logout.php">
      <p>Log out</p>
    </a></div>
</div>
