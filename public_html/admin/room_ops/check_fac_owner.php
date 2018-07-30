<?php
use \App\Facilities\Facility as Facility;

$facility_id = $_GET['facility'];
$active_facility = Facility::get_all( ['id'=>$facility_id]);
if (empty($active_facility)) die('Greska');
$active_facility = $active_facility[0];

$user_id = $_SESSION['owner_id'];

if ($user_id !== $active_facility->get('owner_id')) die("Niste vlasnik ovog objekta.");

 ?>
