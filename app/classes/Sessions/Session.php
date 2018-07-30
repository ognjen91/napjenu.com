<?php
namespace App\Sessions;

// get_session_status : pomocna metoda za provjeru sesije vlasnika
// set_session : settovanje sesije
// login_page_redir() : redirekcija na login stranicu (+js)


use App\Helpers\Check as Check;
use App\Persons\Owner as Owner;
use Dotenv\Dotenv as Dotenv;


class Session {

private $owner_logged= false;
private $owner_id;
private $logged_owner_Token;
private static $website;


// $who - moze imati vrijednost 'owner' ili 'visitor'
public function __construct(){
  self::$website = getenv( 'APP_URL');

  }

private function get_session_status(){

    if (isset($_SESSION['owner_logged'])) return $_SESSION['owner_logged'];
    return false;
}



//settovanje sesije
public function set_session(){
 if ($this->get_session_status()){
         $this->owner_logged = true;
         $this->owner_id = $_SESSION['owner_id'];
         return ['owner_logged' => $this->owner_logged, 'owner_id' => $this->owner_id];
  } else {
        !Check::is_on_page('/admin/login')? header('Location: '. self::$website . '/admin/login.php') : null;
     }
  }



public static function login_page_redir(){
  if(Check::is_on_page('/admin/login')){
header('Location: '. self::$website . '/admin/index.php');
  }
}




  // ==class end=====
}



?>
