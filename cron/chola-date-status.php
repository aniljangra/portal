<?php 
		include("class.phpmailer.php");
		$date_current=date("Y-m-d");
		include("crondb.php");
	//	$sql_ds="SELECT * from tb_cholabooking where cb_dateup=0 && cb_transstatus!='SUCCESS' && cb_subdatetime < (NOW() - INTERVAL 30 MINUTE)";
		
	$sql_ds="SELECT * from tb_cholabooking where cb_dateup=0 && cb_transstatus!='SUCCESS'";
		
		
		$sql_ds_res=mysqli_query($conn,$sql_ds);
    echo 	$count_order=mysqli_num_rows($sql_ds_res);
		if($count_order>0){	
				while($resrow=mysqli_fetch_array($sql_ds_res)){
					$cb_id=$resrow['cb_id'];
					$sqlup="UPDATE tb_cholabooking SET cb_dateup=1 WHERE cb_id='$cb_id'";
					mysqli_query($conn,$sqlup);
				}
		
		}
		
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
			$mail->Body="dsadd";
			$sent=$mail->Send();
		
		
?>