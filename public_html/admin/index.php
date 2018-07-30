<?php
require_once __DIR__ . "/includes/admin_header.php";
use \App\Persons\Owner as Owner;
use \App\Sessions\Session as Session;
use \App\Tokens\Owner_session_token as Session_token;
use \App\Helpers\Check as Check;

?>



<div class='admin_holder'>






<div class='admin_index_content'>

<?php require_once "includes/index/admin_index_content.php"; ?>

</div>









</div>










<!-- ============= FOOTER  ==================== -->
<?php require_once __DIR__ . "/includes/admin_footer.php"; ?>
