<?php
namespace App\Images;

use App\Images\Image as Image;

class Room_image extends  Image  {

  protected static $db_table = "room_images";

  protected static $dbt_fields =  ['id', 'name', 'room_id', 'created', 'size']; //sva db polja...
  public static $new_img_fields = ['name', 'room_id', 'created', 'size'];
  protected static $getters = ['id', 'room_id','name', 'facility_id'];


  // public $price;
  public $created;
  public $size;
  public $room_id;

  protected static $return_info = ['error' => 1, 'error_msg' => 0, 'message' => 'Greška! '];

  public function __construct(){

}


public static function db_table(){
  return self::$db_table;
}



}















 ?>
