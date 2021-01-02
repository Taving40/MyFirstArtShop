<html>

<?php

if(dirname(__DIR__, 2) == "/app/web")
	require dirname(__DIR__, 3) . "/vendor/autoload.php";	
else
	require dirname(__DIR__, 2) . "/vendor/autoload.php";



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

	// try {
	// 	$mail->Send();
	// }
	// catch (exception $e) {
	// 	echo $e.ErrorInfo;
	// }

	if(!$mail->Send()) {
		echo $mail->ErrorInfo;
	} else {
		//echo 'Message sent!';
	}
}

?>

</html>