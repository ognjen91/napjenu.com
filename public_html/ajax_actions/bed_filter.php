<?php



$filtered_array = [];

foreach ($all_rooms as $key=>$room) {
  // var_dump($room);
  if (
  // !($room->no_of_beds >= $no_of_beds && $room->no_of_beds <= $no_of_beds + 1)
  !($room->no_of_beds == $no_of_beds)
){
  // var_dump($room->no_of_beds);

    unset($all_rooms[$key]);

  } else {

   $room->no_of_beds == $no_of_beds? array_unshift($filtered_array, $room) : array_push($filtered_array, $room);

  }
}

unset($all_rooms);
$all_rooms = $filtered_array;





 ?>
