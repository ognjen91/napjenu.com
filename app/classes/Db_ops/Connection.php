<?php
namespace App\Db_ops;
use PDO as PDO;

use App\Helpers\Check as Check;

//default klasa za konekciju
//za inicijaciju $db = new Connection();


class Connection {
  //ovo treba staviti u varijable van servera
    private $dsn;
    public  $pdo;
    private $user;
    private $pass;


    function __construct() {

// 'mysql:host=localhost;dbname=fooodworld';

      $this->dsn = "mysql:host=". getenv('DB_HOST') .";dbname=".getenv('DB_NAME');
      $this->user = getenv('DB_USERNAME');
      $this->pass = getenv('DB_PASSWORD');
      // var_dump($this->dsn);
      // var_dump($this->user);
      // var_dump($this->pass);

      $this->connect();

    }



     // fja za konektovanje na bazu
    private function connect(){





      try {
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      } catch (PDOException $e) {
        echo "Connection error! " . $e->getMessage();
      }

    }

}




























?>
