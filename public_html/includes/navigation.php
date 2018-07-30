<?php
// require_once "../../../vendor/autoload.php";
// require_once "../../app/config/_env.php";
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;

 ?>



<div class="hamburger" id="hamburger">
<div class="image_holder">
    <img src="<?php echo SITE_ADRESS; ?>/images/hamburger.svg" alt="hamburger menu">
 </div>



</div>





<div class="main_nav">
<div class="close_nav">x</div>

<ul>
  <div class="menu_logo">
    <div class="image_holder"><img src="/images/logo.png" alt="">
</div>
  </div>
  <li><a href='<?php echo Process::add_lang_to_link(SITE_ADRESS); ?>'><?php echo $lang->menu_sobe; ?></php></a></li>
  <li><a href="<?php echo Process::add_lang_to_link("/facilities.php"); ?>"><?php echo $lang->menu_objekti; ?></a></li>
  <li><a href="<?php echo Process::add_lang_to_link("/contact.php"); ?>"><?php echo $lang->menu_kontakt; ?></a></li>
</ul>
</div>



<div class='logo'>
  <div class="logopng">
     <div class="image_holder">
       <a href="<?php echo Process::add_lang_to_link(SITE_ADRESS); ?>">
      <img src="<?php echo SITE_ADRESS;?>/images/logo.png">
      </a>
   </div>
 </div>


 <div class="flags">
   <div>
     <div class="image_holder" ><a href="<?php echo SITE_ADRESS; ?>"><img src="/images/serbia.png" alt="serbian flag"></a></div>
   </div>
   <div>
     <div class="image_holder" ><a href="<?php echo SITE_ADRESS; ?>?lang=eng"><img src="/images/uk.png" alt="uk flag"></a></div>
   </div>
 </div>
</div>
