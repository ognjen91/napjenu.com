$(document).ready(function(){

  $dark_blue = "#25274D";
  $date_background = "#acdfe4";
  $ava_day_col = "rgb(56, 187, 49)";
  $selected_date_background = "rgb(15, 30, 42)";
  $unava_day_col : "rgb(195, 60, 30)";
  $day_with_discount : "rgb(56, 187, 49)";

  $date_color = "rgb(27, 27, 24)";
  $selected_date_color = '#fff';

  $url = window.location.href;
  $lang = $url.substring($url.indexOf("=") + 1);

  var today = new Date();
  var current_month = today.getMonth() + 1;
  var current_year = today.getFullYear();

  $site_adress = "http://apartmani.hn";
  var check_filters = ['kitchen', 'bathroom', 'terrace', 'tv', 'air_conditioner']; //filteri koji se cekiraju


  function add_leading_zero(m)
{
  return (m < 10 ? '0' : '') + m;
}
  /////////STAMPANJE SOBA- INICIJALNO
  //poslati zahtjev ajax-om
  //popunjavati polja sa potrebnim id-evima
  //append

  //na pocetku cuvam strukturu sobe u varijabli i kloniram je za dalje potrebe
  $init_room_structure = $(".rooms_section").eq(0);
  $init_room = $init_room_structure.clone();

  $selected_room_structure = $(".room_selected").eq(0);
  $selected_room = $selected_room_structure.clone();

  $.ajax({

       url: '../../ajax_actions/search_rooms.php',
       type: 'POST',
       data: {
        // 'language' : $lang
       },
       success: function (room_info) {
             // console.log(room_info);
             rooms = JSON.parse(room_info);
             for (var x in rooms) {
             // $room = $init_room.clone();
             $room = $init_room.clone();
             // console.log($room.html());
             // console.log("=============");
             $room.find(".room").attr("id", rooms[x].id);
             $room.find(".suite").text(rooms[x].name);
             $room.find(".facility").text(rooms[x].facility_name);
             $room.find(".owner").text(rooms[x].owner_username);
             $room.find(".owner").attr("href", $site_adress + "/owners?owner=" + rooms[x].owner_id);
             $room.find(".suite_place").text(rooms[x].place);
             $room.find(".no_of_beds").text(rooms[x].beds);
             $room.find(".room_profile_img img").attr("src", "/photos/suites/"+rooms[x].profile_image);
             $room.find(".view_room").attr("data-room_id", rooms[x].id);
             $(".rooms_section").append($room.html());

             $room.remove();
             }


             // laganica :)


        }
  })


// ===========STAMPANJE SOBA - PRETRAGA====================

$(".search_button").click(function(){
  $(".rooms_section").hide().html(" ");


  //provjera koji su filteri aktivirani
  var filters = {};

  for (var x in check_filters) {
      if ($("#"+ check_filters[x]+ ":checked").length > 0) filters[check_filters[x]] = 1;
  }


 if ($("#no_of_beds").val() !== '0') filters['no_of_beds'] = $("#no_of_beds").val();
 if ($("#departure_date_show").attr("data-isset") == "1") {
   filters['arrival_date'] = $("#arrival_date_show").text();
   filters['departure_date'] = $("#departure_date_show").text();
 }

 //ovim imam sve filtere koji su cekirani u objektu

 $.ajax({

      url: '../../ajax_actions/search_rooms.php',
      type: 'POST',
      data: {
       filters
      },
      success: function (room_info) {
            // console.log(room_info);
            rooms = JSON.parse(room_info);
            for (var x in rooms) {
            $room = $init_room.clone();

            // console.log($room.html());
            // console.log("=============");
            $room.find(".room").attr("id", rooms[x].id);
            $room.find(".suite").text(rooms[x].name);
            $room.find(".facility").text(rooms[x].facility_name);
            $room.find(".owner").text(rooms[x].owner_username);
            $room.find(".owner").attr("href", $site_adress + "/owners?owner=" + rooms[x].owner_id);
            $room.find(".suite_place").text(rooms[x].place);
            $room.find(".no_of_beds").text(rooms[x].beds);
            $room.find(".room_profile_img img").attr("src", "/photos/suites/"+rooms[x].profile_image);
            $room.find(".view_room").attr("data-room_id", rooms[x].id);

            // console.log(rooms[x].beds);
            $(".rooms_section").fadeIn(500).append($room.html());
            // console.log(rooms[x])
            $room.remove();
            }


            // laganica :)



 }}
)

})






////PRIKAZ MENIJA
////PRIKAZ
$("#hamburger").click(function(){
  $(".main_nav").fadeIn(1500);
})

$(".close_nav").click(function(){
  $(".main_nav").fadeOut(1500);
})



//KALENDARI
// slanje zahtjeva php skripti
//id sobe
var all_calendars;



$empty_append_string = '';
$days_append_string = '';


//na pocetku saljemo ajaxom zahtjev za aktivne kalendare
//i prikazujemo odgovarajuci kalendar
 $.ajax({

      url: '../../ajax_actions/calendar_data.php',
      type: 'POST',
      data: {
       'language' : $lang
      },
      success: function (calendars) {

            all_calendars = JSON.parse(calendars);
            // console.log(all_calendars[0]);

            for ($i=1; $i<=all_calendars[0].empty_days;$i++){
              // console.log("+1");
              $empty_append_string += "<div class='empty_day date'></div>";
            }
            for ($i=1; $i<=all_calendars[0].no_of_days_in_month;$i++){
              $days_append_string += "<div class='date only_date' id='"+ all_calendars[0].year + "-" + all_calendars[0].month_no + "-" + $i  +"'>"+$i+"</div>";
            }

            // console.log($empty_append_string);
            // console.log($days_append_string);

            $("#arrival_month_calendar, #departure_month_calendar").append($empty_append_string);
            $("#arrival_month_calendar, #departure_month_calendar").append($days_append_string);
            //mjeseci primaju potrebnu vrijednost
            $("#arrival_month, #departure_month").val(all_calendars[0].month_no);

       }


})
//kraj prikaza odgovarajuceg kalendara


//LISTA MJESECI I GODINA... skrivanje nepotrebnih mjeseci
$("#arrival_month>option, #departure_month>option").each(function(){
  if ($(this).attr("value") < current_month){
    $(this).css('display', 'none');
  }
})


$("#arrival_year, #departure_year").change(function(){

  if ($(this).val() <= current_year){

$(this).parent().parent().find(".month>select>option").each(function(){
  if($(this).attr("value") < current_month) $(this).css("display", "none");
})

} else {
  $(this).parent().parent().find(".month>select>option").each(function(){
    $(this).css("display", "block");
  })
}
});
//kraj skrivanja nepotrebnih  mjeseci



//prikaz novog KALENDARA kada se odaberu mjesec i godina iz liste
//
$("#arrival_year, #arrival_month, #departure_year, #departure_month").change(function(){



  $(this).parent().parent().parent().find(".calendar").html("");
  $month = $(this).parent().parent().find(".month>select").val();
  $year = $(this).parent().parent().find(".year>select").val();
  console.log($month);
  console.log($year);

  $empty_append_string = '';
  $days_append_string = '';

  for (var month in all_calendars) {
    // console.log(all_calendars[month]);
    if (all_calendars[month].month_no == $month && all_calendars[month].year == $year){
      for ($i=1; $i<=all_calendars[month].empty_days;$i++){
        // console.log("+1");
        $empty_append_string += "<div class='empty_day date'></div>";
      }
      for ($i=1; $i<=all_calendars[month].no_of_days_in_month;$i++){
        $days_append_string += "<div class='date only_date' id='"+ all_calendars[month].year + "-" + all_calendars[month].month_no + "-" + $i  +"'>"+$i+"</div>";
      }
       // console.log($empty_append_string);
       // console.log($days_append_string);

        $(this).parent().parent().parent().find(".calendar").append($empty_append_string);
        $(this).parent().parent().parent().find(".calendar").append($days_append_string);

   return;
    }

}

});
//kraj kalendara kada se odaberu...


//prvi klik na dolazni kalendar

$first_counter = true;
$('body').on('click', '.arrival_calendar .only_date', function() {
  if (!$first_counter) return;
  $day = $(this).text();
  $month = $(this).parent().parent().find(".month>select").val();
  $year = $(this).parent().parent().find(".year>select").val();

  $("#departure_date_show").html($year+"-"+$month+"-"+$day);
  $("#departure_date_show").attr("data-month", $month);
  $("#departure_date_show").attr("data-year", $year);
  $("#departure_date_show").attr("data-day", $day);

  $("#departure_date_show").attr("data-isset", "1");
$first_counter = false;
});

//prvi klik na odlazni kalendar

$('body').on('click', '.departure_calendar .only_date', function() {
  if (!$first_counter) return;
  $day = $(this).text();
  $month = $(this).parent().parent().find(".month>select").val();
  $year = $(this).parent().parent().find(".year>select").val();

   console.log($("#arrival_date_show").html());

  $("#arrival_date_show").html($year+"-"+$month+"-"+$day);
  $("#arrival_date_show").attr("data-month", $month);
  $("#arrival_date_show").attr("data-year", $year);
  $("#arrival_date_show").attr("data-day", $day);

  $("#departure_date_show").attr("data-isset", "1");
$first_counter = false;
});



///Klik na datum: datum se obiljezi i u mobilnoj verziji se ispisuje
$('body').on('click', '.only_date', function() {
   $(".only_date").css("background", $date_background);
   $(".only_date").css("color", $date_color);
   $(this).css("background", $selected_date_background);
   $(this).css("color", $selected_date_color);

   $day = $(this).text();
   $month = $(this).parent().parent().find(".month>select").val();
   $year = $(this).parent().parent().find(".year>select").val();

   $(this).parent().parent().parent().find(".day_show").html($year +"-"+$month+'-'+$day);
    $(this).parent().parent().parent().find(".day_show").attr("data-day", $day);
    $(this).parent().parent().parent().find(".day_show").attr("data-month", $month);
    $(this).parent().parent().parent().find(".day_show").attr("data-year", $year);
  // console.log($(this).parent().parent().parent());

  $(".month_calendar").fadeOut(1500);
})

//prikaz odgovarajuceg kalendara: dolaznog ili odlaznog
//
$(".show_calendar img").click(function(){
  $(this).parent().parent().parent().parent().find(".month_calendar").fadeIn(1500);
})
//sakrivanje odgovarajuceg kalendara: dolaznog ili odlaznog
//
$(".close_calendar").click(function(){
  $(this).parent().parent().parent().find(".month_calendar").fadeOut(1500);
})
//kraj klika na datum...
//



















// ===============GLAVNI PRIKAZ SOBE NA KLIK================


$rs_id = 1;
// if ($("#departure_date_show").attr("data-isset") == "1") {
// $arrival_date = $('.arrival_date_show').text();
// $arrival_year = $('.arrival_date_show').attr('data-year');
// $arrival_month = $('.arrival_date_show').attr('data-month');
// $departure_date = $('.departure_date_show').text();
// $departure_year = $('.departure_date_show').attr('data-year');
// $departure_year = $('.departure_date_show').attr('data-month');
// }

$arrival_date = "2018-07-5"
$arrival_year = "2018";
$arrival_month = "07";
$arrival_day = "5";
$departure_date = "2018-07-08";
$departure_year = "2018";
$departure_month = "07";
$departure_day = "8";





//popunjavanje dodatnih

$.ajax({

     url: '../../ajax_actions/room_selected.php',
     type: 'POST',
     data: {
      // 'language' : $lang
     },
     success: function (room_info_raw) {
           console.log(room_info_raw);
           room_info = JSON.parse(room_info_raw);
           console.log(room_info);


           $("#rs_name").text(room_info['basic'].name);
           $("#rs_fac_name").text(room_info['basic'].facility_name);
           $("#rs_place").text(room_info['basic'].place);
           $("#rs_big_img").attr("src", $site_adress + "/photos/suites/" + room_info['basic'].profile_image)

           $imgs_string = "";
           for (var image in room_info['images']) {
           $imgs_string += "<div class='rs_other_img'><div class='image_holder'>";
           $imgs_string += "<img src='/photos/suites/"+room_info['images'][image]+"'>";
           $imgs_string += "</div></div>";

          }

           $("#rs_other_imgs").append($imgs_string);


           $("#rs_description").text(room_info['description']);
           $("#rs_bathroom").attr('src', room_info['amenities'].bathroom);
           $("#rs_kitchen").attr('src', room_info['amenities'].kitchen);
           $("#rs_terrace").attr('src', room_info['amenities'].terrace);
           $("#rs_air_conditioner").attr('src', room_info['amenities'].air_conditioner);
           $("#rs_tv").attr('src', room_info['amenities'].tv);
           $("#rs_beds").text(room_info['basic'].beds);

           //LISTA MJESECI I GODINA... skrivanje nepotrebnih mjeseci
           $("#rs_arrival_month>option, #rs_departure_month>option").each(function(){
             if ($(this).attr("value") < current_month){
               $(this).css('display', 'none');
             }
           })


           $("#rs_arrival_year, #rs_departure_year").change(function(){

             if ($(this).val() <= current_year){

           $(this).parent().parent().find(".month>select>option").each(function(){
             if($(this).attr("value") < current_month) $(this).css("display", "none");
           })

           } else {
             $(this).parent().parent().find(".month>select>option").each(function(){
               $(this).css("display", "block");
             })
           }
           });


           $("#rs_arrival_month").val($arrival_month);
           $("#rs_arrival_year").val($arrival_year);
           $("#rs_departure_month").val($departure_month);
           $("#rs_departure_year").val($departure_year);
           //kraj skrivanja nepotrebnih  mjeseci
           //


           //ovo ce kasnije morati u uslov... if ($("#departure_date_show").attr("data-isset") == "1") {...
            // =============INICIJALNO POPUNJAVANJE KALENDARA================
           $starting_arr_calendar = room_info['calendars'][$arrival_year][$arrival_month];
           $starting_dep_calendar = room_info['calendars'][$departure_year][$departure_month];

           // console.log($starting_arr_calendar['days']);
           // console.log(room_info['calendars'][$arrival_year][$arrival_month]['empty_days']);

           // ========INICIJALNO: DOLAZNI kalendar
           $empty_days_string = "";
           $rs_days_string = "";


           for($i=0;$i<$starting_arr_calendar['empty_days']; $i++){
             $empty_days_string += "<div class='empty_day'></div>";
           }
           for (var day in $starting_arr_calendar['days']) {
             //cijena za dan
            $day_price = $starting_arr_calendar['days'][day]['price'];
            $day_price_with_disc = $starting_arr_calendar['days'][day]['price'] *(1 - $starting_arr_calendar['days'][day]['discount'] /100);
            $day_price_with_disc = parseFloat($day_price_with_disc.toFixed(1));
            var ava_class;
            var focused;

            ava_class = $starting_arr_calendar['days'][day]['availability'] ? "ava_day" : 'unava_day';
            selected = (day == $arrival_day);

            $rs_days_string += "<div id='"+$arrival_year+"-"+$arrival_month+"-"+day+"' class='rs_day "+ ava_class+"' data-price='"+$starting_arr_calendar['days'][day]['price']+"' data-discount='"+
            $starting_arr_calendar['days'][day]['discount']+"' data-selected='"+selected+"'>"
            +"<div class='discount_sign'><div class='image_holder'><img src='/images/discount.png'></div></div>"
            +"<div class='day_no'>"+ day + "</div>"
            +"<div class='rs_price'><span class='price_no_discount'>"+$day_price +"  </span><span class='price_with_discount'>"+ $day_price_with_disc +"</span><span  class='rs_e'>&euro;</span></div>"

            + "</div>";
            // console.log(day);
        }

        $("#rs_arrival_month_calendar").append($empty_days_string).append($rs_days_string);

        // ========INICIJALNO: Odlazni kalendar
        $empty_days_string = "";
        $rs_days_string = "";


        for($i=0;$i<$starting_dep_calendar['empty_days']; $i++){
          $empty_days_string += "<div class='empty_day'></div>";
        }
        for (var day in $starting_dep_calendar['days']) {
          //cijena za dan
         $day_price = $starting_dep_calendar['days'][day]['price'] *(1 - $starting_dep_calendar['days'][day]['discount'] /100);
         $day_price = parseFloat($day_price.toFixed(1));
         var ava_class;
         var focused;

         ava_class = $starting_dep_calendar['days'][day]['availability'] ? "ava_day" : 'unava_day';
         selected = (day == $departure_day);

         $rs_days_string += "<div id='"+$departure_year+"-"+$departure_month+"-"+day+"' class='rs_day "+ ava_class+"' data-price='"+$starting_dep_calendar['days'][day]['price']+"' data-discount='"+
         $starting_dep_calendar['days'][day]['discount']+"' data-selected='"+selected+"'>"
         +"<div class='discount_sign'><div class='image_holder'><img src='/images/discount.png'></div></div>"
         +"<div class='day_no'>"+ day + "</div>"
         +"<div class='rs_price'><span class='price_no_discount'>"+$day_price +"  </span><span class='price_with_discount'>"+ $day_price_with_disc +"</span><span  class='rs_e'>&euro;</span></div>"


         + "</div>";
         // console.log(day);
     }

     $("#rs_departure_month_calendar").append($empty_days_string).append($rs_days_string);


      }
})



// ------------promjena kalendara na prikazu sobe-----------
//
//prikaz novog KALENDARA kada se odaberu mjesec i godina iz liste
//
$("#rs_arrival_year, #rs_arrival_month, #rs_departure_year, #rs_departure_month").change(function(){

  $(this).parent().parent().parent().find(".calendar").html("");
  $month = $(this).parent().parent().find(".month>select").val();
  $year = $(this).parent().parent().find(".year>select").val();


  $empty_days_string = "";
  $rs_days_string = "";

  $selected_calendar = room_info['calendars'][$year][$month];

  for($i=0;$i<$selected_calendar['empty_days']; $i++){
    $empty_days_string += "<div class='empty_day'></div>";
  }
  for (var day in $selected_calendar['days']) {
    //cijena za dan
   $day_price = $selected_calendar['days'][day]['price'] *(1 - $selected_calendar['days'][day]['discount'] /100);
   $day_price = parseFloat($day_price.toFixed(1));
   var ava_class;
   var focused;

   ava_class = $selected_calendar['days'][day]['availability'] ? "ava_day" : 'unava_day';


   $rs_days_string += "<div id='"+$year+"-"+$month+"-"+ day +"' class='rs_day + "+ ava_class+"' data-price='"+$selected_calendar['days'][day]['price']+"' data-discount='"+
   $selected_calendar['days'][day]['discount']+"' data-selected='"+false+"'>"
   +"<div class='discount_sign'><div class='image_holder'><img src='/images/discount.png'></div></div>"
   +"<div class='day_no'>"+ day + "</div>"
   +"<div class='rs_price'><span class='price_no_discount'>"+$day_price +"  </span><span class='price_with_discount'>"+ $day_price_with_disc +"</span><span  class='rs_e'>&euro;</span></div>"


   + "</div>";

   // console.log(day);
}

        $(this).parent().parent().parent().find(".calendar").append($empty_days_string).append($rs_days_string);

   return;
 })


//kraj kalendara kada se odaberu...


///Klik na datum: datum se obiljezi i u mobilnoj verziji se ispisuje
$('body').on('click', '.ava_day', function() {
   $(".ava_day").css("background", $ava_day_col);
   $(".ava_day").css("color", $date_color);
   $(this).css("background", $selected_date_background);
   $(this).css("color", $selected_date_color);

   $day = $(this).find(".day_no").eq(0).text();
   $month = $(this).parent().parent().find(".month>select").val();
   $year = $(this).parent().parent().find(".year>select").val();

   $(this).parent().parent().parent().find(".rs_day_show").html($year +"-"+$month+'-'+$day);
    $(this).parent().parent().parent().find(".rs_day_show").attr("data-day", $day);
    $(this).parent().parent().parent().find(".rs_day_show").attr("data-month", $month);
    $(this).parent().parent().parent().find(".rs_day_show").attr("data-year", $year);
  // console.log($(this).parent().parent().parent());

  $(".rs_month_calendar").fadeOut(1500);
})

// -----zatvaranje kalendara----------
$('.rs_close_calendar').click(function(){
    $(".rs_month_calendar").fadeOut(1500);
})

$(".rs_show_calendar img").click(function(){
  $(this).parent().parent().parent().parent().find(".rs_month_calendar").fadeIn(1500);
})

});
