<?php
//ovdje bi mogli ici i osnovne provjere datuma

use App\Calendars\Calendar as Calendar;

foreach ($all_rooms as $key=>$room){
  $the_room_calendar = new Calendar($room);
  if (!$the_room_calendar->is_reservtion_possible($arrival_date , $departure_date)){
    unset($all_rooms[$key]);
  }
}

?>
