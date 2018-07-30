<?php
use \App\Calendars\Calendar as Calendar;
 ?>

<!-- =============DOLAZNI KALENDAR========================= -->

<?php
$arrival_calendar = new Calendar();
 ?>

<div class="calendar_holder arrival_calendar">
  <div class="arrival_date_show date_show"><p>
    <?php echo $lang->dol_datum;?>: <span class='day_show' id='arrival_date_show'><?php echo $lang->nije_odabran; ?></span>
  </p>
  <div class="null_calendar">
    <div class="image_holder"><img src="/images/close.png" alt="show arrival calendar"></div>
  </div>
<div class="show_calendar">
  <div class="image_holder"><img src="/images/arrow2.png" alt="show arrival calendar"></div>
</div>
</div>

  <div class="month_calendar">
    <div class='calendar_title'>
      <?php echo $lang->izaberite_dolazak; ?>
    </div>
    <div class='close_calendar close_arr_calendar' >
      x
    </div>
    <div class="calendar_info">
      <div class="month">
        <select name="month" id="arrival_month">
      <?php

      for($i=1;$i<=12;$i++){
        $month = $i;
        if ($month<10) $month = "0".$month;
        ?>
         <option value="<?php echo $month;?>"><?php echo Calendar::serbian_month($i); ?></option>
        <?php } ?>
        </select>
      </div>

      <div class="year">
        <select class="" name="year" id="arrival_year">
          <?php  for($i=2018;$i<=2019;$i++){  ?>
             <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
      </div>
    </div>

    <div class="calendar" id="arrival_month_calendar">


    </div>
  </div>
</div>








<!-- =============Odlazni KALENDAR========================= -->



<?php

$departure_calendar = new Calendar();
 ?>

<div class="calendar_holder departure_calendar">
  <div class="depa_date_show date_show"><p>
    <?php echo $lang->odl_datum;?>: <span class='day_show' id='departure_date_show' data-isset="0"><?php echo $lang->nije_odabran; ?></span>
  </p>
  <div class="null_calendar">
    <div class="image_holder"><img src="/images/close.png" alt="show arrival calendar"></div>
  </div>
<div class="show_calendar">
  <div class="image_holder"><img src="/images/arrow2.png" alt="show arrival calendar"></div>
</div>
</div>

  <div class="month_calendar">
    <div class='calendar_title'>
        <?php echo $lang->izaberite_odlazak; ?>
    </div>
    <div class='close_calendar'>
      x
    </div>
    <div class="calendar_info">
      <div class="month">
        <select name="month" id="departure_month">
      <?php

      for($i=1;$i<=12;$i++){
        $month = $i;
        if ($month<10) $month = "0".$month;
        ?>
         <option value="<?php echo $month;?>"><?php echo Calendar::serbian_month($i); ?></option>
        <?php } ?>
        </select></div>
      <div class="year">
        <select class="" name="year" id="departure_year">
          <?php  for($i=2018;$i<=2019;$i++){  ?>
             <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
      </div>
    </div>

    <div class="calendar" id="departure_month_calendar">


    </div>
  </div>
</div>
