<?php
namespace App\Helpers;


//klasa sa korisnim metodama...
// finish_pdo_query - stampa uslove za pdo mysql query... sve sto ide poslije WHERE
// clean_array - metoda za ciscenje array-a koji cu ubaciti u bazu od nepotrebnih clanova
 // amenity_bool_image - vraca link slike true\false
 // da_ne - vraca da ili ne
 // opposite - vraca suprotno
// add_lang_to_link - za uneseni jezik dodaje jezik, ako je potrebno
// current_adress - trenutna adresa

class Process {

//za ubaceni assoc. array zavrsava query , tj ispisuje USlOVE - sve ono sto ide iza WHERE...
public static function finish_pdo_query(array $to_finish){
  $i = 0;
  $query = " ";
  foreach ($to_finish as $key => $value) {

    $query .= $key . "=? ";
    if ($i != count($to_finish)-1) $query .= "AND ";
    $i++;

  }

  return $query;
}


//metoda za ciscenje array-a koji cu ubaciti u bazu od nepotrebnih clanova
// $comparison_array je array cije su vrijednosti key-evi output array-a
public static function clean_array(array $input_array, array $comparison_array){
  $output_array = [];

foreach ($input_array as $key => $value) {
     if (in_array($key, $comparison_array)) $output_array[$key] = $value;
  }

return $output_array;

}


//vraca url slike u zavisnosti da li je unjet true ili false

public static function amenity_bool_image(int $bool){
  $checked_img = SITE_ADRESS . "/images/checked.png";
  $unchecked_img = SITE_ADRESS . "/images/unchecked.png";
  return $bool? $checked_img : $unchecked_img;
}



//za true/false vraca da/ne

public static function da_ne($val){
  return $val? "Da" : "Ne";
}

public static function opposite($val){
  return $val? 0 : 1;
}

//provjeravam da li get sadrzi jos nesto sem jezika i u zavisnosti od toga vracam potreban nastavak linka

public static function add_lang_to_link($link = null){

    if (!isset($_GET['lang'])) return $link;
      if ($_GET['lang'] == 'eng') $language='eng';
      if ($_GET['lang'] == 'rus') $language='rus';

      return (strpos($link, '?'))? $link."&lang=".$language : $link."?lang=".$language;

  }

//trenutna adresa
public static function current_adress(){
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  return $actual_link;
}





}




 ?>
