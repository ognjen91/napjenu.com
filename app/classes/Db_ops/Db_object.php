<?php
namespace App\Db_ops;

use App\Db_ops\Sql as Sql;
use App\Helpers\Process as Process;


// ======klasa za manipulaciju objektima iz baze...
// metode:
// --get_all - vraca niz svih objekata unosa iz tabele, koji, po potrebi, zadovoljavaju uslove
// --pomocne metode za get_all: instantiate, return_all_objects_array, return_aspecific_objects_array...
// db_update_from_object : update baze od objekta
// delete_object_from_db : brisanje iz baze
// ...object_has_prop

// ------------DRUGE metode-----------------------
// return_props_array -metoda koja za uneseni $comparison_array vraca ARRAY $input_value_ako_je_svojstvo=>vrijednost_svojstva_iz_objekta
//set_values - matoda koja za input array cini da objekat primi vrijednosti iz arraya

// -----------GETTER METODE---------
// citav niz metoda...
// get - glavna getter metoda...
 // show_object za dev...


class Db_object extends Sql
{


  protected $for_input;


// ===============GLAVNA METODA za objekte=================================
   //vraca niz svih objekata (child klase iz koje je pozvana) unosa iz tabele...
   //poziva se child klasa
   // $conditions su uslovi, npr [date = '2020-10-08', city = 'belgrade']
   //TREBA DOPUNITI!!!... da se omoguci ORDER BY ... ASS/DESC
   public static function get_all($conditions = [], $order_by=null){
      $table = static::$db_table;
      $results_array = self::return_all_objects_array($table, $conditions, $order_by);
      return !empty($results_array)? $results_array : false;
   }





   // =====================POMOCNE METODE za get_all=========================


   //---------------- pomocna metoda niz objekata za dati query
   // $conditions su uslovi $row=>$vrijednost
       private static function return_all_objects_array(string $table, $conditions=[], $order_by=null) {
          global $db;
          $query = "SELECT * FROM " . $table ." ";

          if (!empty($conditions) || $order_by) $query .= "WHERE ";

          if(!empty($conditions)) {

            $query .= Process::finish_pdo_query($conditions);
          }

          // echo $query;
          $conditions = array_values($conditions);
          $result_set = $db->pdo->prepare($query);
          $result_set->execute($conditions);
          $results = array();

          while ($row = $result_set->fetch()){
            $results[] = static::instantiate($row);
          }
          // var_dump($results);
          return $results;

       }

     // POMOCNA metoda za get_all za instancijaciju objekta
   private static function instantiate($db_record){
     $calling_class = get_called_class();
     $the_object = new $calling_class; //'late binding'


     foreach ($db_record as $key => $value) {
        if (static::object_has_prop($the_object, $key)){
          $the_object->$key = $value;
        }
     }

     return $the_object;
   }


   //pmocna metoda za get_all - provjera da li objekat ima navedeno svojstvo
  public static function object_has_prop($object, $prop){
     $current_object_props = get_object_vars($object);
     return array_key_exists($prop, $current_object_props);
  }







// =============================CRUD METODE===============================================

  // ==================UNOS OBJEKTA U DB===============

  // $comparison_array - obican array cije vrijednosti su rowovi koje treba ubaciti - koje zelimo ubaciti
  // $comparisonn_array je najbolje cuvati u staticnoj varijabli koju dobijamo preko getter metode
  // vraca $return_info iz insert metode

  public function db_input_from_object(string $table, array $comparison_array){
    global $db;

    $this->for_input = $this->return_props_array($comparison_array);
    // echo "<br /><br />";
    // var_dump($this->for_input);
    // echo "<br /><br />";
    //ciscenje od null vrijednosti
    foreach ($this->for_input as $key => $value) {
      if ($value === "0") continue; //jbg
      if (!$value) unset($this->for_input[$key]);
    }

    if (!$this->for_input || empty($this->for_input)) return false;

    // var_dump($this->for_input);
    $inserted = $this->insert($table, $this->for_input);
    $inserted['lastId'] = $db->pdo->lastInsertId();
    return $inserted; //to je $return_info

  }



// ===========UPDATE OBJEKTA====================
// $props_to_upd su svojstva cije vrijendosti updatujemo u bazi
// $codnitions su uslovi, dakle iza where
public function db_update_from_object(array $props_to_upd, array $conditions){
    $array_to_upd = [];
    foreach ($props_to_upd as $prop) {
       if (self::object_has_prop($this, $prop)) $array_to_upd[$prop] = $this->$prop;
    }
// var_dump($array_to_upd);
  $updated = $this->update(static::$db_table, $array_to_upd, $conditions);
  return $updated;
}



// ==================BRISANJE OBJEKTA IZ DB===============

public function delete_object_from_db(string $table, array $comparison_array){
  //formiranje arraya sa uslovima
  $conditions = [];
  foreach ($comparison_array as $value) {
     if (static::object_has_prop($this, $value)) $conditions[$value] = $this->$value;
  }

 $delete = $this->delete($table, $conditions);
 return $delete;

}





// =============================================
     // ========DRUGE METODE==============
// ==============================================


//metoda koja za input array i objekat setuje vrijednosti objekta - primaju vrijednosti iz arraya
 //ako je unesen i $comparison_array, prima samo one vrijednosti koje su naznacene u tom arrayu
 //vraca bool da li je primio bar jednu novu vrijednost svojstva
 public  function set_values(array $input_array, array $comparison_array = null){


    $i = 0;
    // var_dump($input_array);
    // var_dump(get_object_vars($object));
   foreach ($input_array as $key => $value) {
      if ($comparison_array){

        if (!in_array($key, $comparison_array)) continue;
      }

     if (!array_key_exists($key, get_object_vars($this))) continue;

     $this->$key = $value;
     $i++;
   }


   //da li je i jedan prop primio vrijednost
   return $i>0;
 }




  //metoda koja za uneseni $comparison_array vraca niz ciji su keyevi vrijednosti tog $comparison_array-a,..
  // ..a vrijednosti vrijednosti svojstava objekta sa istim imenom
//ako je output array prazan, vraca false, a ako nije vraca output_array
  protected function return_props_array($comparison_array){
    $output = array();

    foreach (get_object_vars($this) as $key => $value) {
       if (in_array($key, $comparison_array)) $output[$key] = $value;
    }

     return (!empty($output))? $output : false;
  }




// --------SVE GETTER METODE--------------------



public function id(){
  return $this->id;
}

public static function db_table(){
  return static::$db_table;
}


 public function name(){
   return $this->name;
 }

 public function username(){
   return $this->name;
 }

public function password(){
  return $this->password;
}

public function email(){
  return $this->email;
}

public function expires(){
  return $this->expires;
}

//korisnikovi podaci tipa godine, city
public function other_user_infos(){
  $user_infos = array();
  $user_infos['age'] = $this->age;
  $user_infos['city'] = $this->city;
  $user_infos['date_registered'] = $this->date_registered;

  return $user_infos;
}


// ==============GLAVNA GETTER METODA===============
public function get($property){
  return in_array($property, static::$getters)? $this->$property : false;
  }


  //pomocna metoda za provjeravanje... *IZBRISATI KASNIJE
    public function show_object(){
      var_dump(get_object_vars($this)) ;
    }



}


 ?>
