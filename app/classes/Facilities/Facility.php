<?php
namespace App\Facilities;

use App\Db_ops\Db_object as Db_object;
use App\Persons\Owner as Owner;

// METODE
// all_places() - vraca niz sa svim mjestima u kojim se nalaze objekti
// get_owner_name() - vraca ime vlasnika


class Facility extends  Db_object  {
  protected $target_file;
  protected static $db_table = "facilities";


  protected $target;
  protected $id;
  protected $owner_id;
  public $name;

  protected $place;
  protected $adress;
  protected $phone_1;
  protected $phone_2;
  protected $description_srb;
  protected $description_eng;
  protected $website;
  protected $facebook;
  protected $instagram;

  protected static $getters = ['name', 'id', 'adress', 'phone_1', 'phone_2', 'adress',
  'place', 'description_srb', 'description_eng', 'owner_id', 'website', 'facebook', 'instagram'];
  public static $new_fac_fields = ['name', 'adress', 'phone_1', 'phone_2', 'adress',
  'place', 'description_srb', 'description_eng', 'owner_id', 'website', 'facebook', 'instagram'];

  public static $edit_info_fields = ['name', 'adress', 'phone_1', 'phone_2', 'adress',
  'place', 'website', 'description_srb', 'description_eng', 'facebook', 'instagram'];


  public $profile_image;
  public $field_to_change;
  public $fac_to_change;
  public $new_value;
  public $active_facility;

  protected static $db_table_fields = ['name', 'type_srb',
  'type_eng', 'owner_id', 'place','adress', 'phone_1', 'phone_2',
  'description_srb', 'description_eng', 'profile_image', 'website', 'facebook', 'instagram'];


  public function __construct(){
       }






public static function db_table(){
  return self::$db_table;
}


//vraca sva mjesta u kojim se nalaze objekti
public static function all_places(){
  $places = [];
  $all_fac = self::get_all();
  if (empty($all_fac)) return $places;
  foreach ($all_fac as $fac) {
    var_dump($fac);
    if(!in_array($fac->get('place'), $places)) $places[] = $fac->get('place');
  }
  return $places;
}

public function get_owner_name(){
  $pot_owners = Owner::get_all(['id'=>$this->owner_id]);
  return (!empty($pot_owners ))? $pot_owners[0]->username : false;
}



//class end
}










?>
