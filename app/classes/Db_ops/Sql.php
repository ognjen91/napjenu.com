<?php
namespace App\Db_ops;

use App\Db_ops\Connection as Connection;
use App\Helpers\Process as Process;
// ---klasa sa db metodama
// ---metode : insert, update, delete

   class Sql{



        // =============================
        // INSERT metoda
        // ========================
        // $rows_n_values je niz $row_za_ubac=>$vrijednost_row-a
        // vraca array $return_info sa greskom i porukom
        protected function insert(string $table, array $rows_n_values){
           global $db;
           $i=0;
           $return_info = ['message'=>"Greška prilikom unosa u bazu! Molimo vas, obratite se
           administratoru. ", 'error'=>1, 'error_msg'=>null]; //promjenicu error_msg

        //prvo treba formirati query
        $query = "INSERT INTO ". $table ." (";
        $rows_to_ins = count($rows_n_values);

        foreach ($rows_n_values as $key => $value) {
         $query .= $key;
          $query .= ($i != $rows_to_ins-1)? ", " : ") ";
          $i++;
        }

        $query .= "VALUES(";
        $i=0;
        foreach ($rows_n_values as $key => $value) {

          $query .= "?";
          $query .= ($i != $rows_to_ins-1)? ", " : ") ";
          $i++;
        }
        //sada je query potpun
       // echo $query;
        //od assoc array-a pravim obican za pdo execute
        $rows_n_values = array_values($rows_n_values);


        //izvrsenje query-a
        try {

          $stmt = $db->pdo->prepare($query);
          $stmt->execute($rows_n_values);
        }catch (Exception $e) {
          $return_info['error_msg'] = $e->getMessage();
          // var_dump($e->getMessage());
          return $return_info;
        }


        // ako je query uspjesan
        if ($stmt->rowCount() != 0){
          $return_info['error'] = 0;
          $return_info['message'] = 'Uspesan unos u bazu';
        }



// var_dump($return_info);
        return $return_info;
        }









        // ====================================
        // UPDATE metoda
        // ====================================
        // $rows_n_values je niz $row_za_izmjenu=>$nova_vrijednost_row-a
        // $condition je obican array sa imenima svojstava objekta koje ce se uzeti za identifikaciju
        //vraca array $return_info sa greskom i porukom
        public function update(string $table, array $rows_n_values, array $conditions){
          global $db;
          $i=0;
          $return_info = ['message'=>"Nije napravljena ni jedna izmena.",
           'error'=>1, 'error_msg'=>null]; //ako je query uspjesan, ovo mijenjam

          $conditions = $this->return_props_array($conditions);

            //formiranje stringa za query
       $query = "UPDATE ". $table ." SET ";
       $rows_to_ins = count($rows_n_values);
       foreach ($rows_n_values as $key => $value) {

         $query .= $key . "= ?";
         if ($i != $rows_to_ins-1) $query .= ', ';
         $i++;
       }

        $query .= " WHERE ";
        $query .= Process::finish_pdo_query($conditions);
        //imam cijeli query
        // echo $query;

        //spajam array-eve da bi usli u pdo execute
        $values_for_exe = array_merge($rows_n_values, $conditions);
        $values_for_exe = array_values($values_for_exe);
        // var_dump($values_for_exe);

        try {
          $stmt = $db->pdo->prepare($query);
          $stmt->execute($values_for_exe);
        }catch (Exception $e) {
          $return_info['error_msg'] = $e->getMessage();
          return $return_info;
        }

        //ako je query uspjesan
        if ($stmt->rowCount() != 0){
         $return_info['error'] = 0;
         $return_info['message'] = 'Izmjene su prihvaćene';
        }

        // echo $query;
        // var_dump($stmt->rowCount());
        return $return_info;
        }








        // ====================================
        // DELETE metoda
        // ====================================

         //$table je db tabela
         // $conditions je assoc array uslova (sve iza WHERE...)

        //vraca array $return_info sa greskom i porukom
       protected function delete(string $table, array $conditions){
          global $db;
          $i=0;
          $return_info = ['message'=>"Greška prilikom brisanja podataka iz tabele! Molimo, obratite se
          administratoru. ", 'error'=>1, 'error_msg'=>null]; // promjenicu error_msg


           //formiranje pdo query-a
          $query = "DELETE FROM " . $table . " WHERE ";
          $query .= Process::finish_pdo_query($conditions);



          //priprema za pdo:
          $conditions = array_values($conditions);

          try {
            $stmt = $db->pdo->prepare($query);
            $stmt->execute($conditions);
          } catch (Exception $e) {
            $return_info['error_msg'] = $e->getMessage();
            return $return_info;

          }

          //ako je query uspjesan
          if ($stmt->rowCount() != 0){
           $return_info['error'] = 0;
           $return_info['message'] = 'Uspesno izbrisano iz tabele!';
          }


          return $return_info;


   }


}


// $sql = new Sql();














 ?>
