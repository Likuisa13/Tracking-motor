<?php 

class Mailer
{
	public function sendEmail($subject, $mailContent, $to)
	{
        ini_set( 'display_errors', 1 );   
        error_reporting( E_ALL );  
        $from = 'admin@tracking.bottani.co';
        $message = $mailContent;   
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $headers .= 'From: '.$from. "\r\n";
        if(mail($to,$subject,$message, $headers)){
            return true;
        }
        else{
            return false;
        }
	}
}

?>