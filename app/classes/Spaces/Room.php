<?php
namespace App\Spaces;

use App\Db_ops\Db_object as Db_object;
use App\Persons\Owner as Owner;
use App\Facilities\Facility as Facility;



// =====KLASA ROOM JE OSNOVNA KLASA ZA PROSTORIJE...=======
// get_owner_info() : vraca podatke o vlasniku
// get_facility_info() : vraca podatke o objektu
//
class Room extends  Db_object  {
  protected static $db_table = "rooms";

  protected $id;
  public $name;
  protected $facility_id;
  protected $owner_id;
  public $profile_image;
  public $description_srb;
  public $description_eng;
  public $air_conditioner;
  public $kitchen;
  public $bathroom;
  public $tv;
  public $terrace;
  public $other_amenities_srb;
  public $other_amenities_eng;
  public $no_of_beds;

  public $place; //nema potrebe za protected
  public static $db_table_fields = ['id', 'name', 'owner', 'facility_name',
 'profile_image', 'description_srb', 'description_eng',
 'air_conditioner', 'kitchen', 'bathroom', 'tv', 'terrace',
 'other_amenities_srb', 'other_amenities_eng', 'no_of_beds'];

 public static $edit_info_fields = ['name','description_srb', 'description_eng',
'air_conditioner', 'kitchen', 'bathroom', 'tv', 'terrace',
'other_amenities_srb', 'other_amenities_eng', 'no_of_beds'];

public static $new_room_fields = ['name', 'owner_id', 'facility_id', 'profile_image', 'description_srb', 'description_eng',
'air_conditioner', 'kitchen', 'bathroom', 'tv', 'terrace',
'other_amenities_srb', 'other_amenities_eng', 'no_of_beds'];

 protected static $getters = ['id','facility_id', 'owner_id'];


public static function db_table(){
  return self::$db_table;
}


public function get_owner_info(){
  $owner_info = [];

  $owner = Owner::get_all(['id'=>$this->owner_id])[0];


  $owner_info['username'] = $owner->username;
  $owner_info['id'] = $owner->get('id');
  $owner_info['real_name'] = $owner->get('real_name');
  $owner_info['email'] = $owner->get('email');

return $owner_info;
}

public function get_facility_info(){
  $facility_info = [];

  $facility = Facility::get_all(['id'=>$this->facility_id])[0];


  $facility_info['name'] = $facility->name;
  $facility_info['id'] = $facility->get('id');
  $facility_info['place'] = $facility->get('place');
  $facility_info['facebook'] = $facility->get('facebook');
  $facility_info['instagram'] = $facility->get('instagram');



return $facility_info;
}


//class end
}



?>
