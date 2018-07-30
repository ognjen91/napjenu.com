<?php
require_once "../../app/config/_env.php";

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

var_dump($_POST);


//inicijalizacija
$mail = new PHPMailer();


//debugging
//ukuljuciti po potrebi
// $mail->SMTPDebug = 3;



//parametri mail-a
$mail->Host = 'mail.qzman.net';

//treba omoguciti smtp
$mail->isSMTP();


//autentifikacija
$mail->SMTPAuth = true;
$mail->Username = 'admin@qzman.net';
$mail->Password = 'fooodworld121.1';

//zastita
$mail->SMTPSecure = 'tls'; //moze i ssl
$mail->Port = 587;        // 587 ako je tls ... ssl 465



//za slanje sa lokala!!!
//izbrisati kada se salje sa sajta!!!
// $mail->smtpConnect(
//     array(
//         "ssl" => array(
//             "verify_peer" => false,
//             "verify_peer_name" => false,
//             "allow_self_signed" => true
//         )
//     )
// );



//from, to, cc
$mail->setFrom('admin@qzman.net', 'Qzman.net');
$mail->addAddress("qzman16@gmail.com", $_POST['sender']);


//Sadrzaj maila
$mail->isHTML(true);
$mail->Subject = $_POST['message_title'];


$mail->Body  = <<<EOT
<h3>Poštovani, dobili ste poruku sa sajta SUNNY BEACH</h3>
<h5>Tekst poruke:</h5>
EOT;
$mail->Body .= $_POST['message'];

//slanje mail-a.... mail->send() vraca bool

try{
$sent = $mail->send();
$return_info = ['message'=>'Poruka uspjesno poslata'];
echo json_encode($return_info);
} catch (Exception $e) {
$return_info = ['message'=>"Greška pri slanju poruke"];
echo json_encode($retrun_info);
}



 ?>
