<?php
namespace App\Images;

use App\Images\Image as Image;

class Facility_image extends  Image  {
  public static $new_img_fields = ['name', 'facility_id', 'created', 'size'];

  protected static $db_table = "facility_images";
  protected static $dbt_fields =  ['id', 'name', 'facility_id', 'created', 'size']; //sva db polja...


  protected static $getters = ['id', 'name', 'facility_id'];
  public $created;
  public $size;
  public $facility_id;







public static function db_table(){
  return self::$db_table;
}












//class end
}
 ?>
