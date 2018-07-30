<?php
require_once __DIR__ . "/../includes/admin_header.php";
use \App\Db_ops\Sql as Sql;
use \App\Persons\Owner as Owner;
use \App\Db_ops\Connection as Connection;
use \App\Helpers\Check as Check;
use \App\Helpers\Process as Process;
use \App\Tokens\Owner_session_token as Session_token;


$db = new Connection();
// var_dump($_SESSION);
// $active_token = Session_token::get_all(['token'=>$_SESSION['session_token']])[0];
// // var_dump($active_token);
// $active_token->set_values(['expired'=>1]);
// $active_token->db_update_from_object(['expired'], ['token']);


Owner::logout();



 ?>

<h1>Uspješno ste se odjavili</h1>
<?php





?>














 <!-- ============= FOOTER  ==================== -->
 <?php require_once __DIR__ . "/../includes/admin_footer.php"; ?>
