<?php
namespace App\Helpers;


// klasa sa korisnim metodama za provjeravanje
// current_adress --- vraca trenutnu adresu
// is_on_page -  provjera da li je pregledac na stranici

class Check{

 //vraca trenutnu adresu
  public static function current_adress(){
    return $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

}

//provjera da li je na strani ciji url sadrzi $name_of_page
public static function is_on_page($name_of_page){
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return strpos($url, $name_of_page);
}





}















 ?>
