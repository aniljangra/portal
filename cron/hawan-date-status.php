<?php 
		include("class.phpmailer.php");
		$date_current=date("Y-m-d");
		include("crondb.php");
		$sql_ds="SELECT * from tb_hawanbooking where hw_dateup=0 && hw_transstatus!='SUCCESS' && hw_subdatetime < (NOW() - INTERVAL 30 MINUTE)";
		$sql_ds_res=mysqli_query($conn,$sql_ds);
		$count_order=mysqli_num_rows($sql_ds_res);
		
		
		if($count_order>0){	
				while($resrow=mysqli_fetch_array($sql_ds_res)){
					$hw_id=$resrow['hw_id'];
					//echo $resrow['cb_orderno']." ".$resrow['cb_name']." ".$resrow['cb_bookfordate']." Date Submit".$resrow['cb_subdatetime'];
					//echo "<br/>";
					$sqlup="UPDATE tb_hawanbooking SET hw_dateup=1 WHERE hw_id='$hw_id'";
					mysqli_query($conn,$sqlup);
				}
			/* $email_to="inkbidhi@gmail.com";
			$mail=new PHPMailer();
			$mail->IsSMTP();
			$mail->Host="mansadevi.org.in";
			$mail->SMTPAuth=true;
			$mail->Port=587;
			$mail->Username="info@mansadevi.org.in";
			$mail->Password="India#1989";
			$mail->From="info@mansadevi.org.in";
			$mail->FromName = "Hawan Reminder";
			$mail->AddAddress($email_to);
			$mail->IsHTML(true);
			$mail->AddReplyTo('info@mansadevi.org.in');
			$mail->Subject="Hawan Cron Job Test";
			$mail->Body="$count_order";
			$sent=$mail->Send(); */
		}
		
		
?>