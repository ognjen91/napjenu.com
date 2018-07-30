<div class="rs_holder">

<div class="rs_close">x</div>


<!-- //naslov sobe i opcije gore -->
<div class="rs_titles">
  <div class="titles">
    <div class="rs_title">
      <p><span id='rs_name'></span></p>
    </div>
    <div class="rs_title">
      <p><span id='rs_fac_name'></span></p>
    </div>
    <div class="rs_title">
      <p><span id='rs_place'></span></p>
    </div>
  </div>



<div class="rs_options">

<div class="rs_option1">
  <div>
<div class="image_holder"><img class="send_room_msg" src="/images/message.png" alt="send a message about this room"></div>
 </div>

</div>

<div class="rs_option2">
  <div>
<div class="image_holder"><a id="view_owner" href=""><img  src="/images/user.png" alt="send a message about this room"></a></div>

</div>
</div>

<div class="rs_option3">
  <div>
<div class="image_holder"><a id="view_facility" href=""><img  src="/images/building.png" alt="send a message about this room"></a></div>

</div>
</div>


<div class="rs_option4">
  <div>
<div class="image_holder"><a id="rs_fb" href=""><img  src="/images/fb.png" alt="send a message about this room"></a></div>
</div>
</div>

<div class="rs_option5">
  <div>
<div class="image_holder"><a id="rs_insta" href=""><img  src="/images/instagram.png" alt="send a message about this room"></a></div>
</div>
</div>

</div>

</div>

<!-- ===slike sobe==== -->
<div class="rs_images">
  <?php require_once "rs_images.php"; ?>
</div>

<!-- kalendari i status aranzmana -->

<div class="rs_calendars">
  <?php require_once "rs_calendars.php"; ?>
</div>

<!-- <div class="rs_arrangement_info">
  <p class="is_possible">Aranzman je moguć. Cijena:
    <span id="rs_arr_price"></span>&euro;<span class="has_discount">(sa uračunatim popustom</span>
    <span id="rs_arr_discount"></span></span><span class="has_discount">&euro;)</span>
  </p>
  <p class="isnt_possible">Aranzman nije moguć. Pokušajte sa drugim datumima. </p>
  <p class="select_date">Molimo, izaberite datume aranžmana.</p>
</div> -->

<!-- =====sadrzaji===== -->
<div class="rs_am_desc">
<div class="rs_descriptions">
<div class="rs_amenities">
  <?php require_once "rs_amenities.php"; ?>
</div>

<!-- tekstuali opisi -->

  <p id="rs_description"></p>
</div>
</div>

<div class="rs_contact">
<?php require_once "rs_contact.php" ?>
</div>



</div>
