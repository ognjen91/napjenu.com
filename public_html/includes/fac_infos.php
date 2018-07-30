<div class="fac_contact_info">
<div>
  <p><?php echo $lang->Adresa; ?>: <span><?php echo $facility->get('adress'); ?></span></p>
</div>
<div>
  <p><?php echo $lang->telefon1; ?>: <span><?php echo $facility->get('phone_1'); ?></span></p>
</div>
<div>
  <p><?php echo $lang->telefon2; ?>: <span><?php echo $facility->get('phone_2'); ?></span></p>
</div>
</div>



  <p class="fac_description"><?php
   echo $facility->get('description_' . $language);
   ?></p>
