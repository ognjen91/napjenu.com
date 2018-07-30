<?php
namespace App\Tokens;

use App\Tokens\Token as Token;
//check - provjera tokena

class Owner_session_token extends Token {
      public $expired;
      private $expiration_time = 60 * 12000; //trajanje sesije, mijenjam po potrebi
      protected static $db_table = "session_tokens";
      protected static $dbt_fields = ['id', 'token', 'time', 'user_id', 'expired'];
      protected static $new_token_fields = ['token', 'time', 'user_id', 'expired'];

      protected static $return_info = ['message' => 'Greška pri generaciji tokena!',
                                    'error' => 1];


        public function __construct($input_token = null){
          //ideja je da se token automatski provjerava na osnovu samog teksta tokena (=$token)
        if (!$input_token) return;


        }


       //provjera aktivnosti tokena
      public function check($token){
        $poss_tokens = self::get_all(['token'=>$token, 'expired'=>'0']);
        if (empty($poss_tokens)) die('Sesija je istekla. Molimo da se ponovo ulogujete.');

        $active_token = $poss_tokens[0];
        $time_now = time();
        if ($time_now < $active_token->time() + $this->expiration_time){
          $return_info['error'] = 0;
          $return_info['Message'] = 'Token je aktivan';
        } else {
          //treba izbrisati token
            die('Sesija je istekla... Molimo, ulogujete se ponovo');
        }

      }









// ===GETER METODE===============




}




 ?>
