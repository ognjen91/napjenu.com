<?php
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Helpers\Check as Check;


// session_destroy();
//
if (!Check::is_on_page('admin/login')){


if (isset($_SESSION['owner_logged'])){
if ($_SESSION['owner_logged']){
$session = new Session();
$session_info = $session->set_session(); //ako je ok, ostaje na stranici a ako ne ide na login
// var_dump($session_info);
// // ---------logovanje usera----------
$owner = new Owner;
$owner->log_from_session($session_info);
//
// // -------provjera tokena sesije----------
$token = new Session_token();
$token_check = $token->check($_SESSION['session_token']);
if($token_check['error']){
  echo $token_check['message'];
}

}
}
else {
  !Check::is_on_page('/admin/login')? header('Location: '. getenv( 'APP_URL'). '/admin/login.php') : null;
}


}
 ?>
