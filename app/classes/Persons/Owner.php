<?php
namespace App\Persons;

use App\Db_ops\Db_object as Db_object;
use App\Facilities\Facility as Facility;
use \App\Tokens\Owner_session_token as Session_token;
// METODE
// register - registracija novog korisnika
// show_all = vraca array sa objektima korisnika
// log_from_session = LOGOVANJE IZ SESIJE
// all_owners_facilities() : vraca sve objekte korisnika
// logout()
// +GETTER METODE...

class Owner extends  Db_object  {
   protected static $db_table = 'owners';
   public static $registration_fields = ['username', 'password', 'email','real_name'];
   protected static $getters = ['id', 'password', 'date_registered', 'real_name', 'email'];


   protected $id;
   public $username;
   protected $password;
   protected $email;
   protected $date_registered;
   protected $real_name;
   public $verified;

   //vazan je red elemenata u ovom nizu jer se tim redom i unose u bazu... obavezna polja prvo
   protected static $db_fields = ['id', 'username', 'password', 'email',
   '$date_registered', 'real_name', 'verified'];


   public function __construct(array $log_info = null){
       if (!$log_info) return;
   }



  // =============REGISTRACIJA NOVOG KORISNIKA==========================

  public function register(array $rows_n_values){
    $rows_n_values['date_registered'] = date('Y-m-d');
    $creation = $this->db_input_from_object('users', self::$db_fields);

    return !$creation['error']; //ok je ako nema greske
  }


//vraca sve korisnike
   public static function show_all(){
     $images = self::get_all();
     return $images;
   }


// ----------LOGOVANJE IZ SESIJE-------------
// $log_info je array sa kljucevima owner_logged(bool) i owner_id
// vraca bool - da li je logovanje iz sesije uspjesno
   public function log_from_session(array $log_info){

     if (!$log_info['owner_logged']) return false;
     $user = self::get_all(['id'=>$log_info['owner_id'], 'confirmed'=>1])[0];
     $props = $user->return_props_array(self::$db_fields);
     $success = $this->set_values($props);
     return $success;
   }


// -------------SVI OBJEKTI KORISNIKA----------
// vraca niz id_objekta=>ime_objekta
public function all_owners_facilities(){
  $facilities = [];

  $users_facilities = Facility::get_all(['owner_id'=>$this->id]);
  // var_dump($users_facilities);
  if (empty($users_facilities)) return $facilities;

  foreach ($users_facilities as $facility) {
     $facilities[$facility->get('id')] = $facility->name;
  }
  return $facilities;
}



// -----------LOGOUT--------------
public static function logout(){
  global $db;



  $active_token = Session_token::get_all(['token'=>$_SESSION['session_token']])[0];
  // var_dump($active_token);
  $active_token->set_values(['expired'=>1]);
  $active_token->db_update_from_object(['expired'], ['token']);



  session_destroy();
  echo "<script>setTimeout(\"location.href = '../index.php';\",1500);</script>";
}



   // public function username

  // getter metoda za username, mail, Password


public function email(){
  return $this->email;
}

public function password(){
  return $this->password;
}

public static function db_table(){
  return self::$db_table;
}

public function id(){
  return $this->id;
}

public function real_name(){
  return $this->real_name;
}




}



 ?>
