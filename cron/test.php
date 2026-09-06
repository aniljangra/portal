<?php 
		include("class.phpmailer.php");

			$email_to="bidhi.saklani@gmail.com";
			$mail=new PHPMailer();
			$mail->IsSMTP();
			$mail->Host="mansadevi.org.in";
			$mail->SMTPAuth=true;
			$mail->Port=587;
			$mail->Username="info@mansadevi.org.in";
			$mail->Password="India#1989";
			$mail->From="info@mansadevi.org.in";
			$mail->FromName = "Chola Reminder";
			$mail->AddAddress($email_to);
			$mail->IsHTML(true);
			$mail->AddReplyTo('info@mansadevi.org.in');
			$mail->Subject="Chola Cron Job Test";
			$mail->Body="dfgfdg";
			$sent=$mail->Send();
		
		
?>