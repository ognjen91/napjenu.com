<?php
namespace App\Images;

use Traits\Image\image_functions as image_functions;
use App\Db_ops\Db_object as Db_object;

// metode :

////add_new_image : ubac nove slike
////delete_img  : brisanje slike

/////getter metode:
// get_name - vraca ime slike



class Image extends  Db_object  {
   use image_functions;

       protected $id;
       protected $name;



       protected $type;
       protected $tmp_name;
       protected $error;
       protected $size;


      protected static $return_info;




      function __construct(){
self::$return_info = ['error'=>1, 'error_msg'=>null, 'message'=>'Greška prilikom uploada slike'];
      }

// ============Pikaz slika=============
   public static function show_new_images(){
     $images = self::get_all('food_images');
     return $images;

   }


// ===================================================
// =================INSERT=========================
// ===================================================


//UBAC NOVE slike
// 1.ubac u folder
// 2. ubac u bazu

  public function add_new_image(array $file_to_upload, string $folder, string $table, array $comparison_array = null){
          global $db;

           //da objekat klase image primi potrebna svojstva iz uploadovane slike (iz $_FILES)
           //ako je refreshovano nakon slanja, vraca se greska
          $get_values = $this->set_values($file_to_upload);
          // var_dump($this);
           if (!$get_values) {
             self::$return_info['message'] .= 'Molimo pokušajte ponovo.';
             return self::$return_info;
           }


           //polja koja ne popunjava korisnik: ime slike, vrijeme, datum
           $this->auto_fields();

           //uslovni ubac u bazu
           $db->pdo->beginTransaction();

           try{
            $in_db = $this->db_input_from_object($table, $comparison_array);
            if ($in_db['error']){
            self::$return_info['message'] .= "Greška pri uploadu slike! Obratite se administratoru.";
            return self::$return_info;
            }

           $db->pdo->commit();
           }catch(Exception $e){

           echo $e->getMessage();
           $db->pdo->rollBack();
           self::$return_info['message'] = 'Greska pri ubacivanju slike u bazu.';
           return self::$return_info;

           }

           //UBAC U folder, ako je ubaceno u bazu.
           $in_folder = $this->add_new_in_folder($file_to_upload,  $folder, $table);
           if ($in_folder['error']) {
             self::$return_info['message'] = $in_folder['message'];
             return self::$return_info;
           }


           self::$return_info['error'] = 0;
           self::$return_info['message'] = "Slika je uspešno uploadovana";

            return self::$return_info;
        }



// ==================================================================
// =============DELETE===================
// ==================================================================

//GlAVNA METODA - BRISANJE SlIKE
// 1. brisanje iz svih foldera unutar foldera $images_folder...
// 2.brisanje iz BAZE
// $image_folder je 'photos'
   public function delete_img(string $table, string $image_folder = '../../../photos'){

    $return_info = ['error'=>1, 'message' => 'Greska pri brisanju slike.'];
    $img_name = $this->name();

    // iz baze
     $delete_db = $this->delete_object_from_db($table, ['id']);
     if ($delete_db['error']) return $return_info;


     //iz foldera
     $delete_from_folder = $this->delete_image_from_folers($img_name, $image_folder);
     if ($delete_from_folder) {
       $return_info['error'] = 0;
       $return_info['message'] = 'Slika uspešno izbrisana.';
       return $return_info;
     }

     return $return_info;

   }


    // ========GETTER FJE=======
    //zbog enkapsulacije...

    public function get_name(){
      return $this->name;
    }












}










 ?>
