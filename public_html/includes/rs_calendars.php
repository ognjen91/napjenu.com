<?php
use \App\Calendars\Calendar as Calendar;
use \App\Helpers\Process as Process;
use \App\Languages\English as English;
use \App\Languages\Serbian as Serbian;


?>


<h4><?php echo $lang->aranzman_naslov; ?></h4>
<p><?php echo $lang->aranzman_podnaslov; ?></p>

<div class="rs_arr_calendar">

  <div class="rs_calendar_holder rs_arrival_calendar">
    <div class="rs_arrival_date_show rs_date_show"><p>
      <?php
      echo $lang->dol_datum;?>:
      <span class='rs_day_show' id='rs_arrival_date_show'><?php echo $lang->nije_odabran; ?></span>
    </p>

  <div class="rs_null_calendar">
      <div class="image_holder"><img src="/images/close.png" alt="show arrival calendar"></div>
  </div>
  <div class="rs_show_calendar">
    <div class="image_holder"><img src="/images/arrow2.png" alt="show arrival calendar"></div>
  </div>
  </div>


    <div class="rs_month_calendar">
      <div class='rs_calendar_title'>
        <?php echo $lang->izaberite_dolazak; ?>
      </div>
      <div class='rs_close_calendar'>
        x
      </div>
      <div class="calendar_info">
        <div class="month">
          <select name="month" id="rs_arrival_month">
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
          <select class="" name="year" id="rs_arrival_year">
            <?php  for($i=2018;$i<=2019;$i++){  ?>
               <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php } ?>
          </select>
        </div>
      </div>

      <div class="calendar" id="rs_arrival_month_calendar">


      </div>
    </div>
  </div>

</div>




<!-- ============odlazni kalendar============ -->

<div class="rs_dep_calendar">

    <div class="rs_calendar_holder rs_departure_calendar">
      <div class="rs_arrival_date_show rs_date_show"><p>
        <?php echo $lang->odl_datum;?>:
        <span class='rs_day_show' id='rs_departure_date_show'><?php echo $lang->nije_odabran; ?></span>
      </p>
    <div class="rs_null_calendar">
          <div class="image_holder"><img src="/images/close.png" alt="show arrival calendar"></div>
    </div>
    <div class="rs_show_calendar">
      <div class="image_holder"><img src="/images/arrow2.png" alt="show arrival calendar"></div>
    </div>
    </div>


      <div class="rs_month_calendar">
        <div class='rs_calendar_title'>
          <?php echo $lang->izaberite_odlazak; ?>
        </div>
        <div class='rs_close_calendar'>
          x
        </div>
        <div class="calendar_info">
          <div class="month">
            <select name="month" id="rs_departure_month">
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
            <select class="" name="year" id="rs_departure_year">
              <?php  for($i=2018;$i<=2019;$i++){  ?>
                 <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
          </div>
        </div>

        <div class="calendar" id="rs_departure_month_calendar">


        </div>
      </div>
    </div>

</div>


<div class="rs_arrangement_info">
  <p class="is_possible"><?php echo $lang->aranzman_moguc; ?>
    <span id="rs_arr_price"></span>&euro;<span class="has_discount"><?php echo $lang->sa_popustom; ?></span>
    <span id="rs_arr_discount"></span></span><span class="has_discount">&euro;)</span>
  </p>
  <p class="isnt_possible"><?php echo $lang->aranzman_nemoguc; ?> </p>
  <p class="select_date"><?php echo $lang->izaberite_datume; ?></p>
</div>
