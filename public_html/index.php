<?php require_once "includes/header.php"; ?>

<div class="index_wrap">



<!-- PRIKAZ ODABRANE SOBE -->
<div class="room_selected">
  <?php require_once "includes/room_selected.php"; ?>
</div>

<!-- KALENDARI I FILTERI -->
<div class="filters_section">
<?php require_once "includes/filters_section.php"; ?>
</div>


<!-- PRIKAZ SOBA- -->
<div class="all_rooms">
  <p class="rooms_title" ><?php echo $lang->rooms_title1; ?></p>
  <p class="rooms_title" id="rooms_title" ><?php echo $lang->rooms_title2; ?></p>


<div class="rooms_section">
<?php require_once "includes/rooms_section.php"; ?>
</div>

</div>





</div>



<!-- =========FOOTER============ -->
<?php require_once "includes/footer.php"; ?>
