<html>

<?php

require /*__DIR__ .*/ '/app/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function mailer($to, $from, $from_name, $subject, $body) { 
	$mail = new PHPMailer();  
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true;  
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = 'myfirstartshop@gmail.com';  
	$mail->Password = 'pandacactusturtle3';           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		echo "Error!";
	} else {
		//echo 'Message sent!';
	}
}

?>

</html>