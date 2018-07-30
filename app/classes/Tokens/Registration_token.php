<?php
namespace App\Tokens;

use App\Tokens\Token as Token;


class Registration_token extends Token {
      protected static $db_table = "registration_tokens";
      protected static $dbt_fields = ['id', 'token', 'time', 'user_id', 'used'];

      protected static $return_info = ['message' => 'Greška pri generaciji tokena!',
                                    'error' => 1];



      protected static $new_token_fields = ['token', 'time', 'user_id', 'used'];








// ===GETER METODE===============




}




 ?>
