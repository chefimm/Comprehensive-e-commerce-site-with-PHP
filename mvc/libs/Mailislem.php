<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailislem  {

		function __construct() {
require_once(dirname(__DIR__).'/helpers/mail/src/Exception.php');	
require_once(dirname(__DIR__).'/helpers/mail/src/PHPMailer.php');	
require_once(dirname(__DIR__).'/helpers/mail/src/SMTP.php');

			$this->mailbilgileri= new HariciFonksiyonlar;
		
		}



    public function mailgonder(array $mailadresleri,$mailkonu,$mailicerik,$return=false) {

        $mail = new PHPMailer(true);

try {
   
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                           
    $mail->Host       = $this->mailbilgileri->mailhost;                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = $this->mailbilgileri->mailadres;                     
    $mail->Password   = $this->mailbilgileri->mailsifre;                            
    $mail->SMTPSecure = 'tls';      
    $mail->Port       = $this->mailbilgileri->mailport;                                   
	$mail->setLanguage('tr','/language/');
	$mail->CharSet="UTF-8";
    //Recipients
    $mail->setFrom($this->mailbilgileri->mailadres, $mailkonu);
	
  //  $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
   /* $mail->addAddress($mailadresi);    
	$mail->addAddress($mailadresi2);  */
	
	foreach ($mailadresleri as $deger):
	 $mail->addAddress($deger);   
	endforeach;
	
	// Name is optional
    $mail->addReplyTo($this->mailbilgileri->mailadres, $mailkonu);
  
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mailkonu;
    $mail->Body    = $mailicerik;
   
    $mail->send();
	
	if (!$return):
	 echo 'ok';
	endif;
   
} catch (Exception $e) {
	if (!$return):
	echo 'hata';
	endif;
    
}

        
    }
	
	
	
}




?>