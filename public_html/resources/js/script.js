$(document).ready(function(){

// ============OSNOVNE VARIJABLE=============
$url = window.location.href;
$window_height = $(window).height(); // New height
$window_width = $(window).width(); // New width
var today = new Date();
var current_month = today.getMonth() + 1;
var current_month_two_digits = add_leading_zero(current_month);
var current_year = today.getFullYear();
var current_day = today.getDate();
$today_string = current_year + "-" + current_month_two_digits + "-" + current_day;
$site_adress = "http://apartmani.hn";
var check_filters = ['kitchen', 'bathroom', 'terrace', 'tv', 'air_conditioner']; //filteri koji se cekiraju

// ======boje========
$dark_blue = "#25274D";
$ava_day_col = "#37B77A";
$unava_day_col = "#e63d44";
$day_with_discount = "#03A45E";


$cal_only_day = "rgba(230, 216, 216, 0.8)";
$selected_date_background = "rgb(26, 34, 41)";
$date_color = "rgb(32, 32, 29)";
$selected_date_color = '#fff';
$today_color = "rgba(111, 140, 176, 0.99)";

// ================PODESAVANJE JEZIKA=======================

  $lang = 'srb';

  if (window.location.href.indexOf('eng')!=-1) {
      $lang = 'eng';
  }

  if (window.location.href.indexOf('rus')!=-1) {
      $lang = 'rus';
  }
  // dodavanje jezika u linkove
  function add_lang_to_link($link){
    if ($lang == "srb") return $link;
    return ($link.indexOf('?')!=-1)? $link + "&lang=" + $lang : $link + "?lang=" + $lang;

  }
  // ======PREVODI==============================

if ($lang == "srb"){
  $title_question_room = "Pitanje o sobi ";
  $text_question_for_owner = "Теkst Vaše poruke za vlasnika ";
  $title_question_owner = "Naslov vašeg pitanja";
  $title_question_facility = 'Pitanje o objektu ';
  $not_selected_msg = "nije odabrano";
  $please_select_msg = "Molimo izaberite.";
}

if ($lang == 'eng'){
  $title_question_room = "Question about room/suite ";
  $text_question_for_owner = "Your message for facility owner ";
  $title_question_owner = "Question for the owner";
  $title_question_facility = 'Message about facility ';
  $not_selected_msg = "not selected";
  $please_select_msg = "Please select.";
}


// =======RESIZE PROZORA=======================

  $(window).resize(function() {
  $window_height = $(window).height(); // New height
  $window_width = $(window).width(); // New width

  slider_fix();
//ispravka baga na owner.php
  if($window_width > 768){
    $(".ow_select>div").css("border-bottom", 'none');
    $(".owner_facilities, .owner_rooms").css("display", "flex");
  } else{
    $(".ow_select>div ").css("border-bottom", '1px solid gray');
    $(".ow_select>div:first-of-type").css("border-bottom", '2px solid black');
  }
});




// ==========================================
// ==========OSNOVNE FJE================
// // ==========================================

// dodaj 0 ispred cifre ako je broj manji od 10
  function add_leading_zero(m)
{
  return (m < 10 ? '0' : '') + m;
}

//podesava visinu filtera
function filters_heights(){
  $(".filters_calendars").height($(".filters_other").eq(0).height());
}

//skrivanje praznih linkova
//prventstveno za skrivanje praznih fb i insta linkova
function hide_broken_links(){
  $("a[href='http://'], a[href='http://#'], a[href='http://www.facebook.com'], a[href='http://www.instagram.com'], a[href='http://www.facebook.com/#'], a[href='http://www.instagram.com/#']").parent().parent().hide();
}

hide_broken_links();

//=============informacije o aranzmanu===========================
// da li je moguc, cijene, popusti... i na kraju popunjava polja
function arrangement_info(id_of_room, arrival_date, departure_date){

  $.ajax({

       url: '../../ajax_actions/arrangement_price.php',
       type: 'POST',
       data: {
        'room_id' : id_of_room,
        'arrival_date' : arrival_date,
        'departure_date' : departure_date
       },
       success: function (arrangement_info) {
             console.log(arrangement_info);
             $arr_info = JSON.parse(arrangement_info);
             if (!$arr_info['error']) {
               $("#rs_arr_price").text($arr_info['price']);
               $("#rs_arr_discount").text($arr_info['discount']);
               $(".is_possible").show();
               $('.isnt_possible, .select_date').hide();
               $("#rs_arrival_date_show").attr("data-isset", 1);
               $("#rs_departure_date_show").attr("data-isset", 1);
             } else {
                $(".isnt_possible").show();
                $(".is_possible, .select_date").hide();
                $("#rs_arrival_date_show").attr("data-isset", 1);
                $("#rs_departure_date_show").attr("data-isset", 1);
             }

        }
  })
}

// =========reset sob i potrebih brojaca kada se izadje iz sobe================
function restart_selected_room(){
  $(".is_possible, .isnt_possible, .select_date").hide();
  $("#rs_departure_date_show").attr('data-isset', 0);
  $counter = 0;

}

// =======dodaje potrebi index slici koja je profilna a nalazi se medju manjim slikama... koristice za slajder=======
// 1) ZA SOBE
function add_index_to_profile(){
  $(".rs_other_imgs>div").each(function(){
    // console.log($(this).find('img').attr("src"))
    // console.log($('#rs_big_img').attr('src'))
    if ($('#rs_big_img').attr('src').includes($(this).find('img').attr("src"))) {
      $(this).attr('data-active_img', 1);
      return;
    }
  })
  // return false;
}

//2) ZA OBJEKTE
function add_index_to_profile_fac(){
  $(".fac_all_images>div").each(function(){
    // console.log($(this).find('img').attr("src"))
    // console.log($('#fac_big_img').attr('src'))
    if ($('#fac_big_img').attr('src').includes($(this).find('img').attr("src"))) {
      $(this).attr('data-active_img', 1);
      return;
    }
  })
  // return false;
}
//posto se ne otvara u prozoru, moze odmah stampa...
add_index_to_profile_fac();

// ==========================================
// KRAJ OSNOVNIH FJA
// ==========================================



  ////////===========STAMPANJE SOBA- INICIJALNO
  //poslati zahtjev ajax-om
  //na pocetku kloniram objekat i njega minjenjam popunjavajuci polja sa potrebnim id-evima i klasama
  //append

  //na pocetku cuvam strukturu sobe i objekta u varijabli i kloniram ih za dalje potrebe
  $init_room_structure = $(".rooms_section").eq(0);
  $init_room = $init_room_structure.clone();
  $init_fac_structure = $('.facilities_section').eq(0);
  $init_fac = $init_fac_structure.clone();

  $selected_room_structure = $(".room_selected").eq(0);
  $selected_room = $selected_room_structure.clone();

  $.ajax({

       url: '../../ajax_actions/search_rooms.php',
       type: 'POST',
       data: {
        // 'language' : $lang
       },
       success: function (room_info) {
             console.log(room_info);
             if (room_info == "") return;
             rooms = JSON.parse(room_info);
             for (var x in rooms) {
             // KLONIRAM STRUKTURU SOBE
             $room = $init_room.clone();

             //UBACUJEM PODATKE OD AJAXA
             $active_room_name = rooms[x].name;
             $active_room_owner = rooms[x].owner_username;
             $room.find(".room").attr("id", rooms[x].id);
             $room.find(".suite").text(rooms[x].name);
             $room.find(".facility").text(rooms[x].facility_name);
             $room.find(".owner").text(rooms[x].owner_username);
             $owners_page = $site_adress + "/owner.php?id=" + rooms[x].owner_id;
             $room.find(".owner").attr("href", add_lang_to_link($owners_page));
             $room.find(".suite_place").text(rooms[x].place);
             $room.find(".no_of_beds").text(rooms[x].beds);
             $room.find(".room_profile_img img").attr("src", "/photos/suites/"+rooms[x].profile_image);
             $room.find(".the_room").attr("data-room_id", rooms[x].id);
             $room.find(".fb_link").attr("href", "http://"+rooms[x].facebook);
             $room.find(".insta_link").attr("href", "http://"+rooms[x].instagram);

             $(".rooms_section").append($room.html());
             hide_broken_links()
             $room.remove();
             }


             // laganica :)

        }
  })

  ////////===========kraj STAMPANJE SOBA- INICIJALNO


// ===========STAMPANJE SOBA - PRETRAGA====================
//slicno kao inicijalno... plus filteri

$("#search_button").click(function(){
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


            $room.find(".room").attr("id", rooms[x].id);
            $room.find(".suite").text(rooms[x].name);
            $room.find(".facility").text(rooms[x].facility_name);
            $room.find(".owner").text(rooms[x].owner_username);
            $owners_page = $site_adress + "/owner.php?id=" + rooms[x].owner_id;
            $room.find(".owner").attr("href", add_lang_to_link($owners_page));
            $room.find(".suite_place").text(rooms[x].place);
            $room.find(".no_of_beds").text(rooms[x].beds);
            $room.find(".room_profile_img img").attr("src", "/photos/suites/"+rooms[x].profile_image);
            $room.find(".the_room").attr("data-room_id", rooms[x].id);
            $room.find(".fb_link").attr("href", "http://"+rooms[x].facebook);
            $room.find(".insta_link").attr("href", "http://"+rooms[x].instagram);
            $("#rooms_title").html('Rezultati pretrage');
            $(".rooms_section").fadeIn(500).append($room.html());
            hide_broken_links();
            $room.remove();
            }


            // laganica opet:)

 }}
)

})
// ===========kraj STAMPANJE SOBA - PRETRAGA====================


////PRIKAZ MENIJA na klik: hamburger menu
////PRIKAZ
$("#hamburger").click(function(){
  $(".main_nav").fadeIn(900).css("display", "flex");
  $(".wrapper").hide();
})

$(".close_nav").click(function(){
  $(".main_nav").fadeOut(900);
    $(".wrapper").show();
})
////kraj PRIKAZ MENIJA




//===================KALENDARI=====================================================
// slanje zahtjeva php skripti

var all_calendars;
$empty_append_string = '';
$days_append_string = '';

// =======STAMPANJE KALENDARA u filterima NA index.php===========
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
              $today = ($today_string == all_calendars[0].year + "-" + all_calendars[0].month_no + "-" + $i)? "today" : all_calendars[0].year + "-" + all_calendars[0].month_no + "-" + $i;
              $days_append_string += "<div class='date only_date "+$today+"' id='"+ all_calendars[0].year + "-" + all_calendars[0].month_no + "-" + $i  +"'>"+$i+"</div>";
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
// ======= kraj STAMPANJE KALENDARA u filterima NA index.php

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
//kraj skrivanja nepotrebnih  mjeseci i godina




//prikaz novog KALENDARA kada se odaberu mjesec i godina iz liste
//
$("#arrival_year, #arrival_month, #departure_year, #departure_month").change(function(){

  $(this).parent().parent().parent().find(".calendar").html("");
  $month = $(this).parent().parent().find(".month>select").val();
  $year = $(this).parent().parent().find(".year>select").val();
  // console.log($month);
  // console.log($year);

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
        $today = ($today_string == all_calendars[month].year + "-" + all_calendars[month].month_no + "-" + $i)? "today" : all_calendars[0].year + "-" + all_calendars[0].month_no + "-" + $i;

        $days_append_string += "<div class='date only_date "+$today+"' id='"+ all_calendars[month].year + "-" + all_calendars[month].month_no + "-" + $i  +"'>"+$i+"</div>";
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






//============prvi klik na dolazni kalendar

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

   $(this).parent().find(".only_date").not(".today").css("color", $date_color).css("background-color", $cal_only_day);
   $(this).parent().find('.today').css("background", $today_color);
   $(this).css("background-color", $selected_date_background);
   $(this).css("color", $selected_date_color);

   $day = $(this).text();
   $month = $(this).parent().parent().find(".month>select").val();
   $year = $(this).parent().parent().find(".year>select").val();

   $(this).parent().parent().parent().find(".day_show").html($year +"-"+$month+'-'+$day);
    $(this).parent().parent().parent().find(".day_show").attr("data-day", $day);
    $(this).parent().parent().parent().find(".day_show").attr("data-month", $month);
    $(this).parent().parent().parent().find(".day_show").attr("data-year", $year);
  // console.log($(this).parent().parent().parent());

if ($window_width<992){
    console.log($(this).parents().eq(5));

    $(".month_calendar").fadeOut(700);
}
$(this).parents().eq(5).children().not(".room_selected").show();
})


//========prikaz odgovarajuceg kalendara: dolaznog ili odlaznog
$cal_counter = 0;
$(".show_calendar img").click(function(){
  if ($window_width < 768){
    $(this).parent().parent().parent().parent().find(".month_calendar").fadeToggle(600).css("display", 'flex');
    $(this).parents().eq(6).children().not(".filters_section").hide();
  } else {
    $(".month_calendar").fadeIn(1500).css("display", 'flex');
  }
})
//sakrivanje odgovarajuceg kalendara: dolaznog ili odlaznog
//
$(".close_calendar").click(function(){
  $(this).parent().parent().parent().find(".month_calendar").fadeOut(650);
  $(this).parents().eq(4).children().not(".filters_section, .room_selected").show();
})
//kraj klika na datum...
//

//======anuliranje KALENDARA

$(".null_calendar div").click(function(){
  $(this).parent().parent().find(".day_show").html($not_selected_msg);
  $("#departure_date_show").attr("data-isset", 0);
})

//i========sto na stranici SOBE

$(".rs_null_calendar div").click(function(){
  $(this).parent().parent().find(".rs_day_show").html($please_select_msg);
  $(this).parent().parent().find(".rs_day_show").attr("data-isset", 0);
  $(".is_possible, .isnt_possible").hide();
  $('.select_date').show();
})






// =============================================================
// ===============GLAVNI PRIKAZ SOBE NA KLIK================
// =============================================================

$('body').on('click', '.the_room', function() {
  // console.log('ads...');
  $rs_id = $(this).attr("data-room_id");
  $(".wrapper>div:not(.send_email)>div").hide();

  if ($("#departure_date_show").attr("data-isset") == "1") {
  $arrival_date = $('#arrival_date_show').text();
  $arrival_year = $('#arrival_date_show').attr('data-year');
  $arrival_month = $('#arrival_date_show').attr('data-month');
  $arrival_day = $('#arrival_date_show').attr('data-day');
  $departure_date = $('#departure_date_show').text();
  $departure_year = $('#departure_date_show').attr('data-year');
  $departure_month = $('#departure_date_show').attr('data-month');
  $departure_day= $('#departure_date_show').attr('data-day');

  $('#rs_arrival_date_show').text($arrival_date);
  $('#rs_departure_date_show').text($departure_date);
  $('#rs_departure_date_show').attr('data-isset', 1);


  arrangement_info($rs_id, $arrival_date, $departure_date);


} else {
  $arrival_date = $departure_date = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  $arrival_year = $departure_year = today.getFullYear() ;
  $arrival_month = $departure_month = add_leading_zero(today.getMonth() + 1);
  $arrival_day = $departure_day = today.getDate() ;


  $('#rs_arrival_date_show').text($please_select_msg);
  $('#rs_departure_date_show').text($please_select_msg);
  $(".select_date").show();
  $('#rs_departure_date_show').attr('data-isset', 0);
}


$('#rs_arrival_date_show').attr('data-year', $arrival_year);
$('#rs_arrival_date_show').attr('data-month',$arrival_month);
$('#rs_arrival_date_show').attr('data-day',  $arrival_day);
$('#rs_departure_date_show').attr('data-year', $departure_year);
$('#rs_departure_date_show').attr('data-month', $departure_month);
$('#rs_departure_date_show').attr('data-day', $departure_day);



//ispravka da bi se moglo primjeniti i na stanici SOBE
// console.log("id je..." + $rs_id);
  $(".room_selected").fadeIn(800);
  // if ($window_width>=992){
  //   $('.room_selected').css('display', 'flex');
  // }

  $.ajax({
       url: '../../ajax_actions/room_selected.php',
       type: 'POST',
       data: {
        'language' : $lang,
        'room_id' : $rs_id
       },
       success: function (room_info_raw) {
             console.log(room_info_raw);
             room_info = JSON.parse(room_info_raw);
             // console.log(room_info);


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

             $("#rs_other_imgs").html($imgs_string);


             $("#rs_description").text(room_info['description']);
             $("#rs_bathroom").attr('src', room_info['amenities'].bathroom);
             $("#rs_kitchen").attr('src', room_info['amenities'].kitchen);
             $("#rs_terrace").attr('src', room_info['amenities'].terrace);
             $("#rs_air_conditioner").attr('src', room_info['amenities'].air_conditioner);
             $("#rs_tv").attr('src', room_info['amenities'].tv);
             $("#rs_beds").text(room_info['basic'].beds);

             $facility_link = "/facility.php?id=" +room_info['basic'].facility_id;
             $owner_link = "/owner.php?id=" +room_info['basic'].owner_id;
             $("#rs_show_facility").attr("href", add_lang_to_link($facility_link));
             $("#rs_show_owner").attr("href", add_lang_to_link($owner_link));
             $("#view_owner").attr("href", add_lang_to_link($owner_link));
             $("#view_facility").attr("href", add_lang_to_link($facility_link));

             $("#rs_fb").attr("href", "http://" +room_info['basic'].facebook);
             $("#rs_insta").attr("href", "http://" +room_info['basic'].instagram);



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
             //=========kraj skrivanja nepotrebnih  mjeseci


              // =============INICIJALNO POPUNJAVANJE KALENDARA================

             $starting_arr_calendar = room_info['calendars'][$arrival_year][$arrival_month];
             $starting_dep_calendar = room_info['calendars'][$departure_year][$departure_month];


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
              $today = ($today_string == $arrival_year+"-"+$arrival_month+"-"+day)? "today" : "" ;


              $rs_days_string += "<div id='"+$arrival_year+"-"+$arrival_month+"-"+day+"' class='rs_day "+ ava_class + " "+ $today + "' data-price='"+$starting_arr_calendar['days'][day]['price']+"' data-discount='"+
              $starting_arr_calendar['days'][day]['discount']+"' >"
              //data-selected='"+selected+"
             +"<div class='discount_sign'><div class='image_holder'><img src='/images/discount.png'></div></div>"
              +"<div class='day_no'>"+ day + "</div>"
              +"<div class='rs_price'><span class='price_no_discount'>"+$day_price +"  </span><span class='price_with_discount'>"+ $day_price_with_disc +"</span><span  class='rs_e'>&euro;</span></div>"

              + "</div>";
              // console.log(day);
          }

          $("#rs_arrival_month_calendar").html($empty_days_string + $rs_days_string);

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
           $today = ($today_string == $arrival_year+"-"+$arrival_month+"-"+day)? "today" : "ne..." ;


           $rs_days_string += "<div id='"+$departure_year+"-"+$departure_month+"-"+day+"' class='rs_day "+$today+" "+ ava_class+"' data-price='"+$starting_dep_calendar['days'][day]['price']+"' data-discount='"+
           $starting_dep_calendar['days'][day]['discount']+"' data-selected='"+selected+"'>"
           +"<div class='discount_sign'><div class='image_holder'><img src='/images/discount.png'></div></div>"
           +"<div class='day_no'>"+ day + "</div>"
           +"<div class='rs_price'><span class='price_no_discount'>"+$day_price +"  </span><span class='price_with_discount'>"+ $day_price_with_disc +"</span><span  class='rs_e'>&euro;</span></div>"


           + "</div>";
           // console.log(day);
       }

       $("#rs_departure_month_calendar").html($empty_days_string + $rs_days_string);
        hide_broken_links();

        }
  })


//dodavanja atributa profilnoj slici - bice potrebno za slajder
add_index_to_profile();

})

// ===============KRAJ OTVARANJA SOBE NA KLIK----------
//




// ------------promjena kalendara na prikazu sobe-----------
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
   $today = ($today_string == $year+"-"+$month+"-"+ day)? "today" : "" ;

   $rs_days_string += "<div id='"+$year+"-"+$month+"-"+ day +"' class='rs_day "+$today+" "+ ava_class+"' data-price='"+$selected_calendar['days'][day]['price']+"' data-discount='"+
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
   $(".ava_day").attr("data-selected", 'false');
   $(this).attr("data-selected", 'false');
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
    $(this).parent().parent().parent().find(".rs_day_show").attr('data-isset', 1);


    if($('#rs_arrival_date_show').attr('data-isset')=='1' && $('#rs_departure_date_show').attr('data-isset')=='1'){
          $arrival_date = $('#rs_arrival_date_show').text();
          $departure_date = $('#rs_departure_date_show').text();


          arrangement_info($rs_id, $arrival_date, $departure_date);

    }
  // console.log($(this).parent().parent().parent());
  //


  $(".rs_month_calendar").fadeOut(700);
})

// -----zatvaranje kalendara----------
$('.rs_close_calendar').click(function(){

    $(".rs_month_calendar").fadeOut(650);

})

// ----------otvaranje kalendara na sobi----------
$(".rs_show_calendar img").click(function(){
  $(this).parent().parent().parent().parent().find(".rs_month_calendar").fadeToggle(600).css("display", "flex");
})

//zatvaranje sobe//
$(".rs_close").click(function(){
    $(".wrapper>div:not(.send_email)>div").show();
  $(".room_selected").fadeOut(500);
  restart_selected_room()
})


// NAVIGACIJA na stranici vlasnika
// =======owner.php===========

$(".ow_select>div>p").click(function(){
  if ($window_width > 767) return;
  $parent_index = $(this).parent().index();


  $(this).parent().parent().children().css("border-bottom", '1px solid gray');
  $(this).parent().parent().children().eq($parent_index).css("border-bottom", '2px solid black');

  $('.owner_option').css("display", "none");
  $('.owner_option').eq($parent_index).css("display", "flex");
})
//kraj navigacije na stranici...


// STRANICA FACILITIES.php
// inicijalno stmpanje objekata

$(".new_facility").eq(0).hide();
$.ajax({

     url: '../../ajax_actions/search_facilities.php',
     type: 'POST',
     data: {

     },
     success: function (fac_infos) {
           // console.log(fac_infos);
           facilities = JSON.parse(fac_infos);
           for (var x in facilities) {
           // $room = $init_room.clone();
           $facility = $init_fac.clone();
           // console.log($room.html());
           // console.log("=============");
           $(".facility").eq(0).css("display", "none");
           $facility.find(".facility").attr("id", facilities[x].id);
           $facility.find(".facility_profile_img img").attr("src", "/photos/facilities/"+facilities[x].profile_image)
           $facility_link = "/facility.php?id="+facilities[x].id;
           $facility.find(".facility_profile_img a").attr("href", add_lang_to_link($facility_link));
           $facility.find(".the_facility a").attr("href", add_lang_to_link($facility_link))
           $facility.find(".facility_name").text(facilities[x].name);
           $facility.find(".facility_place").text(facilities[x].place);
           $facility.find(".facility_owner").text(facilities[x].owner);
           $facility.find(".fac_facebook").attr('href', "http://"+ facilities[x].facebook);
           $facility.find(".fac_instagram").attr('href', "http://"+ facilities[x].instagram);

           $(".facilities_section").append($facility.html()).fadeIn(200);
           $facility.remove();
           hide_broken_links();
           }
}
})
// ---kraj inicijalnog popunjavanja objekata


// -------stampanje na odabir mjesta objekta--------
$("#fac_place").change(function(){
  $(".fac_title p").eq(0).html("Rezultati pretrage");
$(".facilities_section").hide().html(" ");

$place = $(this).val();
var filters = {};
filters['place']=$place;

$.ajax({

     url: '../../ajax_actions/search_facilities.php',
     type: 'POST',
     data: {
       filters
     },
     success: function (fac_infos) {
           // console.log(fac_infos);
           facilities = JSON.parse(fac_infos);
           for (var x in facilities) {
           // $room = $init_room.clone();
           $facility = $init_fac.clone();
           // console.log($room.html());
           // console.log("=============");
           $(".facility").eq(0).css("display", "none");
           $facility.find(".facility").attr("id", facilities[x].id);
           $facility.find(".facility_profile_img img").attr("src", "/photos/facilities/"+facilities[x].profile_image)
           $facility_link = "/facility.php?id="+facilities[x].id;
           $facility.find(".facility_profile_img a").attr("href", add_lang_to_link($facility_link));
           $facility.find(".the_facility a").attr("href", add_lang_to_link($facility_link))
           $facility.find(".facility_name").text(facilities[x].name);
           $facility.find(".facility_place").text(facilities[x].place);
           $facility.find(".facility_owner").text(facilities[x].owner);

           $(".facilities_section").append($facility.html())
           $facility.remove();
           }

          $(".facilities_section").fadeIn(1000);
}
})




});
//kraj stampanja na odabir mjesta


// ===EMAIL=====================
$email_shown = 0;
function show_email_window(){
  if(!$email_shown){
    $("#send_email").removeClass("hide_email").addClass("show_email");
    $(".wrapper>div:not(.send_email)").fadeOut(1000);
    $email_shown = 1;
  } else {
    $("#send_email").removeClass("show_email").addClass("hide_email");
    $email_shown = 0;
    $(".wrapper>div:not(.send_email)").show();
  }
}


//prikaz polja za mail
$email_shown = 0;
$(".email_toggle").click(function(){
    show_email_window()

})
//kraj prikaza soba za mail////
//
///slanje maila///////

$(".send_the_email").click(function(){
  $sender = $("#your_name").val();
  $sender_email = $("#your_email").val();
  $message_title = $('#subject').val();
  $message = $("#your_message").text();

  if ($sender=="" || $sender_email == "" || $message_title=="" || $message==""){
    $(".email_status").html("Molimo, popunite sva polja");
    // return;
  }

  $.ajax({

       url: '../../ajax_actions/send_email.php',
       type: 'POST',
       data: {
         'sender' : $sender,
         'sender_mail' : $sender_email,
         'message_title' : $message_title,
         'message' : $message
       },
       success: function (email_status) {
             console.log(email_status);
             $email_status = JSON.parse(email_status);
             $(".email_status").html($email_status['message']);
  }
  })

})
//kraj slanja EMAILA
//


//prikaz polja za maila
$(".send_room_msg").click(function(){
    $("#subject").val($title_question_room + $("#rs_name").text());
    $("#your_message").val($text_question_for_owner + $active_room_owner + "...");
    show_email_window();
})

$("#send_fac_msg").click(function(){
    $("#subject").val($title_question_facility + $(".fac_name").eq(0).text());
    $("#your_message").val($text_question_for_owner  + $("#fac_owner").text() + "...");
    show_email_window();
})

$("#send_owner_msg").click(function(){
    $("#subject").val($title_question_owner);
    $("#your_message").val($text_question_for_owner  + $("#username").text() + "...");
    show_email_window();
})
//kraj prikaza polja za mail

$("rs_other_imgs>div").each(function(){
  console.log($(this).find("img").attr('src'));
  // if (("#rs_big_img").attr("src") == $(this).attr("src")) $img_index = $(this).parent().parent().index();
  // console.log($img_index);
})



// =====SLAJDER SOBA=========
// $counter = 0;
$('body').on('click', '.rs_nav>div', function() {

if (typeof($counter) == "undefined" || $counter == null){
  add_index_to_profile();
  $counter = $("[data-active_img='1']").index();
}

   $no_of_images = $(".rs_other_imgs>div").length;

   if($(this).attr('id') == 'left'){
     $counter= ($counter - 1 >= 0)? ($counter - 1) : ($no_of_images - 1);
   } else {
      $counter = ($counter + 1 <= $no_of_images-1)? ($counter + 1) : 0;
   }
   $new_src = $(".rs_other_img").eq($counter).find("img").eq(0).attr("src");
   console.log($new_src)
   $("#rs_big_img").attr("src",  $new_src)


// $counter = $index;

})

//klik na malu sliku
$('body').on('click', '.rs_other_img', function() {
  $counter = $(this).index();
  // console.log($counter);
  $src = $(this).find('img').eq(0).attr("src");
  $("#rs_big_img").attr("src", $src);
});

// ============SLAJDER OBJEKAT===========
//velicine
function slider_fix(){
  $coeficient = 0.7;
  // if ($window_width>=640) $coeficient = 0.8;
  // $(".fac_profile_img").eq(0).height($(".fac_profile_img").eq(0).width() * $coeficient);
  // $(".rs_big_img").eq(0).height($(".rs_big_img").eq(0).width() * $coeficient);
}

slider_fix();  //(mora i na resize)

//
$('body').on('click', '.fac_nav>div', function() {

if (typeof($counter) == "undefined" || $counter == null){
  add_index_to_profile();
  $counter= $("[data-active_img='1']").index();
}
console.log($counter);
   $no_of_images = $(".fac_all_images>div").length;

   if($(this).attr('id') == 'left'){
     $counter = ($counter - 1 >= 0)? ($counter - 1) : ($no_of_images - 1);
   } else {
      $counter = ($counter + 1 <= $no_of_images-1)? ($counter + 1) : 0;
   }
   $new_src = $(".fac_image").eq($counter).find("img").eq(0).attr("src");
   console.log($new_src)
   // console.log($index);
   $("#fac_big_img").attr("src",  $new_src)


console.log("kasnije... " + $counter);

})

$('body').on('click', '.fac_image', function() {
  $counter = $(this).index();
  // console.log($counter);
  $src = $(this).find('img').eq(0).attr("src");
  $("#fac_big_img").attr("src", $src);
});



// =======klik na malu sliku slajdera============




});
