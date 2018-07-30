<?php require_once "includes/header.php";
use \App\Db_ops\Connection as Connection;
use \App\Facilities\Facility as Facility;

$db=new Connection;

?>

<div class='fac_wrap'>




<!-- izbor mjesta -->

<div class="fac_chose_place">

<!-- PRIKAZ ODABRANE SOBE -->
<p>
  <?php echo $lang->Mjesto; ?>:
</p>
<select name="" id="fac_place">
  <option value="0" selected>
    <?php echo $lang->sva_mjesta; ?>
  </option>
  <?php
   $all_places = Facility::all_places();
   if (!empty($all_places)) {
     sort($all_places);
     foreach ($all_places as $place) {
     ?>
   <option value="<?php echo $place; ?>"><?php echo $place; ?></option>
     <?php
   }
   }
   ?>
</select>
</div>


<!-- PRIKAZ SOBA- -->
<div class="fac_title">
  <p><?php echo $lang->objekti_naslov; ?></p>
</div>
<div class="facilities_section">
<?php require_once "includes/facilities_section.php"; ?>
</div>
















</div>




<!-- =========FOOTER============ -->
<?php require_once "includes/footer.php"; ?>
