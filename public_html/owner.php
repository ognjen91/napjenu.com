<?php
require_once "includes/header.php";
use App\Db_ops\Connection as Connection;
use App\Facilities\Facility as Facility;
use App\Persons\Owner as Owner;
use App\Spaces\Room as Room;

$db = new Connection();


if (empty($_GET)) die('greska');
$owner_id = $_GET['id'];

$pot_owners= Owner::get_all(['id'=>$owner_id]);
if (empty($pot_owners)) die('greska..');

$owner = $pot_owners[0];

$rooms = Room::get_all(['owner_id'=>$owner_id]);
$facilities = Facility::get_all(['owner_id'=>$owner_id]);


?>



<div class="owner_wrap">

  <div class="room_selected">
    <?php require_once "includes/room_selected.php"; ?>
  </div>

<div class="owner_infos">
  <div class="owner_info">
    <p ><?php echo $lang->Korisnik; ?> <span id="username"><?php echo $owner->username; ?></span></p>
  </div>
<div class="owner_info">
  <p id="real_name"><?php echo $lang->ime_prezime; ?> : <?php echo $owner->get("real_name"); ?></p>
</div>

<div class="owner_info">
  <p>email: <?php echo $owner->get("email"); ?></p>
</div>
<div class="owner_message">
  <p>
    <?php echo $lang->poruka_korisnik; ?>
  </p>
  <div>
  <div class="image_holder"><img src="/images/message.png" alt="send message to owner" id='send_owner_msg'></div>
</div>
</div>

</div>


<div class="owner_facilities_n_rooms">

<div class="ow_select">
  <div>
    <p id="view_facilities"><?php echo $lang->vlasnik_objekti_naslov; ?></p>
  </div>
  <div>
    <p id='view_rooms'><?php echo $lang->vlasnik_sobe_naslov; ?></p>
  </div>
</div>


<div class="owner_facilities owner_option">
  <?php require_once "includes/owner_facilities.php"; ?>
</div>
<div class="owner_rooms owner_option">
    <?php require_once "includes/owner_rooms.php"; ?>
</div>
</div>




</div>
















<!-- =========FOOTER============ -->
<?php require_once "includes/footer.php"; ?>
