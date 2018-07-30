
<?php
 require_once __DIR__ . "/includes/admin_header.php";
 use \App\Persons\Owner as Owner;
 use \App\Db_ops\Connection as Connection;
 use \App\Tokens\Owner_session_token as Session_token;
 use \App\Sessions\Session as Session;

 $connection = new Connection;
 // var_dump($_SESSION);


//provjera da li je vec ulogovan i redirekcija
if (isset($_SESSION['owner_logged'])){
  if ($_SESSION['owner_logged']) {
echo "Vec ste ulogovani. Bicete preusmjereni na admin index stranicu.";

echo "<script>setTimeout(\"location.href = '".getenv( 'APP_URL')."/admin/index.php';\",1500);</script>";
die();
  }
}
// var_dump($_SESSION);

?>


<div class="login_window">
<form method="POST" action="" >
  Username:<br>
  <input type="text" name="username">
  <br>
  Password:<br>
  <input type="password" name="password">
  <br><br>
  <input type="submit" value="Submit" name="login_submit">
</form>
</div>
<?php


if(isset($_POST['login_submit'])){
  $poss_owners = Owner::get_all(['username'=>$_POST['username'],
  'password'=>$_POST['password']]);
  if (!empty($poss_owners)){
    // var_dump($possible_owners[0]);
    $_SESSION['owner_logged'] = true;
    $_SESSION['owner_id'] = $poss_owners[0]->id();

    // -------kreiranje tokena-----------
    $session_token = new Session_token();
    $token_creation = $session_token->create_new($poss_owners[0]->id());
    if (!$token_creation['error']){
      $_SESSION['session_token'] = $session_token->token();
    } else {
      die('Greska pri kreiranju sesije...');
    }

    header('Location: '.getenv('APP_URL').'/admin/index.php');

  } else {

     echo "<h3>Greška!</h3>";
     echo "<h5>Molimo, provjerite unesene podatke.</h5>";

  }


}


 ?>




<!-- ============= FOOTER  ==================== -->
<?php require_once __DIR__ . "/includes/admin_footer.php"; ?>
