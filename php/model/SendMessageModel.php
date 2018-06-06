<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMessageModel
{
	
	private function getMessage()
	{
		$message = trim($_POST['message-body']);
		$messageLength = strlen($message);
		
		if($messageLength > 0 && $messageLength < 1001)
		{
		   return $message;
		}
		else
		{
		   die("Nie udało się wysłać wiadomości ponieważ nie podano żadnej treści");	
		}
	}
	
	private function getSubject()
	{
		$subject = trim($_POST['contact-reason']);

		switch($subject)
		{
			case "--wybierz--" :
			  return "nie podano tematu";
			break;
			
			case "Uwagi na temat serwisu" :
			  return "Uwagi na temat serwisu"; 
			break;
			
			case "Współpraca" :
			  return "Współpraca"; 
			break;
			
			case "Problem techniczny" :
			  return "Problem techniczny"; 
			break;
			
			case "Inne" :
			  return "Inne"; 
			break;
			
			default:
			   die("Nie wysłano wiadomości ze względu na nieprawidłowo wybrany temat wiadomości");
			break;
		}
	}
	
	private function getUserAdress()
	{
		$userEmail = trim($_POST['user-email']);
		
		if(filter_var($userEmail,FILTER_VALIDATE_EMAIL))
		{
		  return $userEmail;	
		}
		else
		{
			return "nie podano adresu e-mail";
		}
	}
	
	function sendEmail()
	{
		require "php/PHPMailer/src/Exception.php";
		require "php/PHPMailer/src/PHPMailer.php";
		require "php/PHPMailer/src/SMTP.php";
		
		
		
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
	$mail->CharSet = 'UTF-8';

    //Recipients
	$userEmail = $this->getUserAdress();
    $mail->setFrom($userEmail, 'Wiadomość od użytkownika imperium');
    $mail->addAddress('cybertron2030@gmail.com', 'Imperator');     // Add a recipient
    $mail->addReplyTo($userEmail, 'użytkownik imperium');

    $message = $this->getMessage();
	
    $mail->isHTML(true);                                  
    $mail->Subject = $this->getSubject();
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    echo "Wiadomość wysłana pomyślnie";
} catch (Exception $e) {
    echo "Nie udało się wysłać wiadomości ".$e->getMessage();
}
		
	}
}

?>
