<?php 
		include("class.phpmailer.php");
		$date_current=date("Y-m-d");
		include("crondb.php");
		$sql_ds="SELECT * from tb_roomreservation where rb_updbstatus=0 && rb_transstatus!='NOTREC' && rb_subdatetime < (NOW() - INTERVAL 30 MINUTE)";
		$sql_ds_res=mysqli_query($conn,$sql_ds);
		$count_order=mysqli_num_rows($sql_ds_res);
		if($count_order>0){	
				while($resrow=mysqli_fetch_array($sql_ds_res)){
					$rb_id=$resrow['rb_id'];
					$sqlup="UPDATE tb_roomreservation SET rb_updbstatus=1 WHERE rb_id='$rb_id'";
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
			$mail->FromName = "Room Cron Reminder";
			$mail->AddAddress($email_to);
			$mail->IsHTML(true);
			$mail->AddReplyTo('info@mansadevi.org.in');
			$mail->Subject="Room Cron Job Test";
			$mail->Body="Total Rooms Released $count_order";
			$sent=$mail->Send();
		
?>