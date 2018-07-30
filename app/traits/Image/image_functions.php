<?php
namespace Traits\Image;

use dateTime as dateTime;
use DirectoryIterator as DirectoryIterator;
//u ovom traitu se nalaze POMICNE metode za klasu Image:

// add_new_in_folder - ubac slike u foldera
// auto_fields() - popunjavanje polja koja ne unosi korisnik
// delete_image_from_folers - brisanje iz foldera
// ...i niz drugih metoda

trait image_functions{





  // ================================================================================
  // ======================POMOCNE METODE ZA INSERT============================
  // ================================================================================


  // UBAC SLIKE U folder
  // $file_to_upload je clan $_FILES-a
  //folder je folder unutar direktorijuma photos

  protected function add_new_in_folder(array $file_to_upload, string $folder){
    // da li je slika
    if (!$this->tmp_name){
     static::$return_info["message"] = "Molimo ubacite novu sliku." ;
     return static::$return_info;
   }

   // var_dump($this->tmp_name);
   if (!self::is_img($this->tmp_name)) {
    static::$return_info["message"] .= "Uploadovani fajl nije slika. Molimo Vas da pokušate ponovo." ;
     return static::$return_info;
   }


   //da li vec postoji
   if (self::img_exists($folder, $this->name)){
     static::$return_info['message'] .= 'Fajl istog imena već postoji';
     return static::$return_info;
   }

   //da li je prevelik fajl
   if (self::is_larger($this->size, 2)){
     static::$return_info['message'] .= 'Maksimalna veličina fajla za upload iznosi 3MB. Molimo, pokušajte ponovo';
     return static::$return_info;
   }

   // --------------UBAC fajla u naznaceni folder
   $target_file = $folder . "/".basename($this->name);
   if (!move_uploaded_file($this->tmp_name, $target_file)){
     static::$return_info['message'] = "Greska! Obratite se administratoru.";
     return static::$return_info;
   }

   static::$return_info['error'] = 0;
   static::$return_info['message'] = "Slika je uspesno uploadovana";

    return static::$return_info;



  }






  // ----POLJA SLIKE KOJA NE POPUNJAVA KORISNIK-
  //ono sto ne popunjava korisnik, vec po defaultu ide uz sliku
  //svaka slika mora da sadrzi ove podatke
  protected function auto_fields(){
    $dateTime = new dateTime;
    $this->created = ($dateTime)->format("Y-m-d H:i");


    //trenutno ime mijenjam slucajnim brojem
    $path = $this->name;
    // echo "<br /><br /><br />";
    // var_dump($path);
    // echo "<br /><br /><br />";
    $ext = pathinfo($path, PATHINFO_EXTENSION); //ekstenizija fajla
    $this->name = rand(1,99999999) .".". $ext;
    // echo "Ime je " . $this->name;

  }





  // ================================================================================
  // ======================POMOCNE METODE ZA DELETE============================
  // ================================================================================
  /////BRISANJE IZ FOLDERA:
  // $image_folder ce biti photos jer vrsi iteraciju kroz sve foldere i brise sliku
  private function delete_image_from_folers($image_name, $image_folder){
      $dir = new DirectoryIterator($image_folder); //iteriracemo kroz foldere pomocu ove klase
      $image_name_no_ext = self::name_no_extension($image_name);

      //iteracija kroz foldere
      foreach ($dir as $fileinfo) {

          //isDot provjerava da li je . ili 'normalan' string
      if (!$fileinfo->isDot())
      {

       //dobijam imena foldera u folderu $image_folder
      $folder_name = $fileinfo->getFilename();
      $files = $image_folder . "/". $folder_name . "/" . "*";
      // var_dump($files);
  //        iteracija kroz fileove
     foreach(glob($files) as $file) {
        $file_info = pathinfo($file);
        // var_dump($file_info['filename']);
        // var_dump($image_name_no_ext);
           if ($image_name_no_ext ===  $file_info['filename']){

             $this->unlink = unlink($file);
             return true;
         }

    }
    }
    }
    return false;
     }




















  //----------PROVJERA da li je fajl slika
   private static function is_img (string $tmp_file_name){
     if ($tmp_file_name) return getimagesize($tmp_file_name);
   }


  // ----------PROVJERA da li fajl vec postoji
  // $folder je ime foldera, pun path u odnosu na home dir (=public_html)
  //npr $folder = "food" ili "users"
  // $filename je ime slike,
    private static function img_exists(string $folder, string $filename){
      $ok = 0;
      $file = "/". $folder . "/" . $filename;
  }

  // ----------PROVJERA da li je fajl prevelik (da li je veci od neke vrijednosti)
    private static function is_larger($size, $max_size_mb){
      return ($size > $max_size_mb*1024*1024);
    }


    //    --------vraca IME BEZ EKSTENZIJE---------
         private static function name_no_extension($file){
         $name_no_extension = explode('.', $file);
          unset($name_no_extension[count($name_no_extension) - 1]);
          $name_no_extension = implode('.', $name_no_extension);

           return $name_no_extension;
    }


}




 ?>
