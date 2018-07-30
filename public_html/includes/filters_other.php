

<div class="all_filters">
  <div><p><?php echo $lang->kuhinja;?></p><input type="checkbox" id="kitchen"></div>
  <div><p><?php echo $lang->kupatilo;?></p><input type="checkbox" id="bathroom"></div>
  <div><p><?php echo $lang->terasa;?></p><input type="checkbox" id="terrace"></div>
  <div><p><?php echo $lang->klima;?></p><input type="checkbox" id="air_conditioner"></div>
  <div><p><?php echo $lang->tv;?></p><input type="checkbox" id="tv"></div>
  <div class='beds'><p><?php echo $lang->broj_kreveta; ?></p>
    <select name="no_of_beds" id="no_of_beds">
      <option value="0" selected>-</option>
      <?php
for ($i=1; $i<=8; $i++){
  ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
  <?php
}
       ?>

    </select></div>




</div>
