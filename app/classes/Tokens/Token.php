<?php
namespace App\Tokens;

//create new ===== pravljenje novog TOKENA
// 

use App\Db_ops\Db_object as Db_object;
use App\Db_ops\Session as Session;

class Token extends Db_object {

      protected static $dbt_fields; //def za svaku child klasu
      protected static $additional_time; //koliko se produzva sesija, treba definisati za svaku c.c.

      private static $token_fields; //takodje za svaku c.c.

      //ovo su polja koja i svojstva koja, pored id-a imaju svi tokeni..
      //u ma kojoj tabeli... ali mogu imati i dodatna
      protected $id;
      public $token;
      protected $time;
      protected $user_id;


      public function __construct($input_token = null){
        //ideja je da se token automatski provjerava na osnovu samog teksta tokena (=$token)
         if (!$input_token) return;


      }



      // ------------KREIRANJE NOVOG TOKENA
      public function create_new($user_id){
        $this->token = bin2hex(random_bytes(100));
        $this->user_id = $user_id;
        $this->time = time();

        $created = $this->db_input_from_object(static::$db_table, static::$new_token_fields);
        if ($created['error']){
          // static::$return_info = array_merge(static::$return_info, $created); //dev_check
          return static::$return_info();
        }

        static::$return_info['error'] = 0;
        static::$return_info['message'] = "Token uspesno kreiran";



        return static::$return_info;
      }



 // ===============GETTER METODE======================

// vraca tekst tokena
public function token(){
  return $this->token;
}

public static function db_table(){
  return static::$db_table;
}

public function user_id(){
  return $this->user_id;
}


public function time(){
  return $this->time;
}

}





 ?>
