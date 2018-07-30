$( document ).ready(function() {
    // alert('ako Bog da');
    //
    //

// ====ADMIN MENU==================
   $("#hamburger").click(function(){
     $(this).css("display", "none");
     $(".logo").css('display', "none");
     $(".main_nav").css("display", 'flex');
     $(".admin_wrap>div:not(.navigation)").css("display", 'none');

   });


  $('.close_nav').click(function(){
    $(".main_nav").css("display", 'none');
    $(".logo, #hamburger").css("display", "flex");
    $(".admin_wrap>div:not(.navigation)").css("display", 'inherit');
  })

// ==========NAVIGACIJA - opcije profila
$('.show_nav_profile_options').click(function(){
  $(".nav_profile_options").fadeToggle(1000);
})


// =========OPCIJE KOD OBJEKTA==========
// admin : view_facility.php

$( "#ef_options" ).click(function() {
  $( ".vf_go:not(#ef_options)" ).fadeToggle( "slow", "linear" );
});

// =========OPCIJE KOD SOBA==========
// admin: view_room.php

$( "#vr_options" ).click(function() {
  $( ".vr_go:not(#vr_options)" ).fadeToggle( "slow", "linear" );
});





// =========================================
// ======================EDIT KALENDARA============
// ======================================

//da se vidi prvi mjesec
$(".ec_month_holder").eq(0).css("visibility", 'visible');

//navigacija kalendara
$( "#ec_select_year, #ec_select_month" ).change(function() {
     $month = $("#ec_select_month").val();
     $year = $("#ec_select_year").val();


     $active_calendar = $("#" + $month + "-" + $year);

     $(".ec_month_holder").css('visibility', "hidden");
     $active_calendar.css("visibility", "visible");

});


//kada se klikne na checkbox, mijenja atribut odgovarajuceg roditelja
$(".ava_check").click(function(){
  if ($(this).is(':checked')){
    $(this).parent().parent().parent().attr("data-availability", "1");
  } else {
    $(this).parent().parent().parent().attr("data-availability", "");
  }
})


// ==========KLIK: POTVRDITE IZMJENE===================
$('body').on('click', 'div.ec_accept', function() {

//id sobe
 $url = window.location.href;
 $room_id = $url.substring($url.indexOf("=") + 1);


 $data = {
    'room_id' : $room_id,
    'unavailable' : {
      '2018' : [],
      '2019' : [],
      '2020' : []
    },
    'prices_n_disc' : {
      '2018' : {},
      '2019' : {},
      '2020' : {}
    }
} //ova struktura jer ce biti laksi i brzi bekend


//uzimanje odgovarajucih podataka i smjestanje
  $('.ec_date').each(function(){
     $date=$(this).attr('id');
     $availability = $(this).attr('data-availability');
     $price = $(this).find('.ec_price').val();
     $discount = $(this).find('.ec_discount').val();

     $year = $date.split("-")[0];
     $month = $date.split("-")[1];
     $day = $date.split("-")[2];
     // console.log($month);



     if (!$availability) $data['unavailable'][$year] += $date + ",";
     if (typeof $data['prices_n_disc'][$year][$month] == 'undefined') {
         $data['prices_n_disc'][$year][$month] = "";
}

//ubac u odgovarajuci dio posta
  $data['prices_n_disc'][$year][$month] += $day + ":" + $price + "-" + $discount + ",";
  })

    // slanje php skripti i stampanje odgovora
     $.ajax({
          url: '../../admin/room_ops/edit_calendars_proceed.php',
          type: 'POST',
          data: {
              calendar_data : $data
          },
          success: function (back) {
            console.log(back);
                $back= JSON.parse(back);
                $("#ec_accept_msg").html($back.message).show().fadeOut(2500);

           }


})


});



// ==========EDIT ROOM================


$('body').on('click', 'div.er_accept', function() {
  //id sobe
   $url = window.location.href;
   $room_id = $url.substring($url.indexOf("=") + 1);


  $beds = $("#beds").val();
  $name = $("#name").val();
  $kitchen = $("#kitchen").val();
  $bathroom = $("#bathroom").val();
  $terrace = $("#terrace").val();
  $air_conditioner= $("#air_conditioner").val();
  $tv = $("#tv").val();
  $other_amenities_srb = $("#other_amenities_srb").val();
  $other_amenities_eng = $("#other_amenities_eng").val();
  $description_srb = $("#description_srb").val();
  $description_eng = $("#description_eng").val();

  $.ajax({
       url: '../../admin/room_ops/edit_room_info_proceed.php',
       type: 'POST',
       data: {
           'room_id' : $room_id,
           'name' : $name,
           'no_of_beds' : $beds,
           'kitchen' : $kitchen,
           'bathroom' : $bathroom,
           'terrace' : $terrace,
           'air_conditioner' : $air_conditioner,
           'tv' : $tv,
           'other_amenities_srb' : $other_amenities_srb,
           'other_amenities_eng' : $other_amenities_eng,
           'description_srb' : $description_srb,
           'description_eng' : $description_eng

       },
       success: function (back) {
         // console.log(back);
             $back= JSON.parse(back);
             $("#ec_accept_msg").html($back.message).show().fadeOut(2500);

        }


});


});


// =============DODAVANJE NOVE SLIKE SOBE=========
// add_new_img.php

// novo polje za ubac slike
//
$("#ap_add_new").click(function(){
  $field = $(this).parent().parent().prev().find(".ap_new").eq(0).html();
  $(".ap_news").append("<div class='ap_new'>" + $field + "<div>");
  // console.log($field);
})



// ===========POSTAVLJANJE PROFILNE SLIKE SOBE============
// room_photos.php
//

$(".rp_profile>p").click(function(){
  //id sobe
   $url = window.location.href;
   $room_id = $url.substring($url.indexOf("=") + 1);
   //id slike
  $img_id = $(this).parent().parent().find('img').attr('data-img-id');

  // slanje php skripti i stampanje odgovora
   $.ajax({
        url: '../../admin/room_ops/edit_room_profile_img.php',
        type: 'POST',
        data: {
            img_id : $img_id,
            room_id : $room_id
        },
        success: function (back) {
              $back= JSON.parse(back);
              $("#rp_accept_msg").html($back.message).show().fadeOut(2500);
              // console.log(back);
         }


})
})

// ===========BRISANJE SLIKE SOBE============
// room_photos.php
//

$(".rp_delete>p").click(function(){
  //id sobe
   $url = window.location.href;
   $room_id = $url.substring($url.indexOf("=") + 1);
   //id slike
  $img_id = $(this).parent().parent().find('img').attr('data-img-id');

  // slanje php skripti i stampanje odgovora
   $.ajax({
        url: '../../admin/room_ops/delete_room_img.php',
        type: 'POST',
        data: {
            img_id : $img_id,
            room_id : $room_id
        },
        success: function (back) {
              $back= JSON.parse(back);
              $("#rp_accept_msg").html($back.message).show().fadeOut(2500);
              $("[data-img-id="+$img_id+"]").parent().parent().parent().fadeOut(1700);
         }


})
})


// ==========EDIT FACILITY================


$('body').on('click', 'div.ef_accept', function() {
  //id facility-a
   $url = window.location.href;
   $facility_id = $url.substring($url.indexOf("=") + 1);



  $name = $("#name").val();
  $adress = $("#adress").val();
  $place = $("#place").val();
  $phone_1 = $("#phone_1").val();
  $phone_2= $("#phone_2").val();
  $website= $("#website").val();
  $facebook= $("#facebook").val();
  $instagram= $("#instagram").val();

  $description_srb = $("#description_srb").val();
  $description_eng = $("#description_eng").val();

  $.ajax({
       url: '../../admin/facility_ops/edit_facility_proceed.php',
       type: 'POST',
       data: {
           'facility_id' : $facility_id,
           'name' : $name,
           'adress' : $adress,
           'place' : $place,
           'phone_1' : $phone_1,
           'phone_2' : $phone_2,
           'description_srb' : $description_srb,
           'description_eng' : $description_eng,
           'website' : $website,
           'facebook' : $facebook,
           'instagram' : $instagram

       },
       success: function (back) {
         // console.log(back);
             $back= JSON.parse(back);
             $("#ef_accept_msg").html($back.message).show().fadeOut(2500);

        }


});


});


// / ===========BRISANJE SLIKE OBJEKTA============
// facility_photos.php
//

$(".fp_delete>p").click(function(){
  //id objekta
   $url = window.location.href;
   $facility_id = $url.substring($url.indexOf("=") + 1);
   //id slike
  $img_id = $(this).parent().parent().find('img').attr('data-img-id');

  // slanje php skripti i stampanje odgovora
   $.ajax({
        url: '../../admin/facility_ops/delete_facility_img.php',
        type: 'POST',
        data: {
            img_id : $img_id,
            facility_id : $facility_id
        },
        success: function (back) {
              // console.log(back);
              $back= JSON.parse(back);
              $("#rp_accept_msg").html($back.message).show().fadeOut(2500);
              $("[data-img-id="+$img_id+"]").parent().parent().parent().fadeOut(1700);
         }


})
})

// ===========POSTAVLJANJE PROFILNE SLIKE OBJEKTA============
// facility_photos.php
//

$(".fp_profile>p").click(function(){
  //id objekta
   $url = window.location.href;
   $facility_id = $url.substring($url.indexOf("=") + 1);
   //id slike
  $img_id = $(this).parent().parent().find('img').attr('data-img-id');

  // slanje php skripti i stampanje odgovora
   $.ajax({
        url: '../../admin/facility_ops/edit_facility_profile_img.php',
        type: 'POST',
        data: {
            img_id : $img_id,
            facility_id : $facility_id
        },
        success: function (back) {
              $back= JSON.parse(back);
              $("#rp_accept_msg").html($back.message).show().fadeOut(2500);
              // console.log(back);
         }


})
})


// ==========EDIT OWNER PROFILE================


$('body').on('click', 'div.ep_accept', function() {
  //id facility-a
   $url = window.location.href;
   $facility_id = $url.substring($url.indexOf("=") + 1);



  $username = $("#username").val();
  $id = $("#username").attr("data-id");
  $email = $("#email").val();
  $real_name = $("#real_name").val();
  $password= $("#password").val();



  $.ajax({
       url: '../../admin/owner_profile_ops/edit_proceed.php',
       type: 'POST',
       data: {

           'username' : $username,
           'email' : $email,
           'real_name' : $real_name,
           'pass' : $password,
           'id' : $id

       },
       success: function (back) {
         // console.log(back);
             $back= JSON.parse(back);
             $("#ep_accept_msg").html($back.message).show().fadeOut(2500);

        }


});


});








///js end
});
