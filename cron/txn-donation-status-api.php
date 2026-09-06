<?php 
		include("class.phpmailer.php");
		$date_current=date("Y-m-d");
		include("crondb.php");
		//include("AWLMEAPI.php");
		require_once 'TransactionRequestBean.php';
		
		//$obj = new AWLMEAPI();
		echo $sql_ds="SELECT * from tb_donation where donation_up=0 &&  donation_paymethod=3 && donation_transstatus!='SUCCESS' && donation_date < (NOW() - INTERVAL 20 MINUTE)";
		$sql_ds_res=mysqli_query($conn,$sql_ds);
		echo $count_order=mysqli_num_rows($sql_ds_res);
		if($count_order>0){	
				$up=1;
				while($resrow=mysqli_fetch_array($sql_ds_res)){
					$donation_id=$resrow['donation_id'];
					$donation_payparam=$resrow['donation_payparam'];
					$orderId=$resrow['donation_orderno'];
					$parmsar=unserialize($donation_payparam);
					
					print_r($parmsar);
					exit;
					
	/*				
	$itc=$donation_id;	
	$amount_final=number_format($amount,1);
	$scheme_code="FIRST_".$amount_final."_0.0";	 


	$transactionRequestBean=new TransactionRequestBean();
    //Setting all values here
	  $transactionRequestBean->merchantCode=WL_MERCHANTCODE;
  	$transactionRequestBean->requestType=WL_REQTYPE1;
    $transactionRequestBean->amount=$val['amount'];
    $transactionRequestBean->returnURL = '';
    $transactionRequestBean->txnDate= $val['txnDate'];
    $transactionRequestBean->merchantTxnRefNumber=$val['mrctTxtID'];
    $transactionRequestBean->ITC=$itc;
    $transactionRequestBean->mobileNumber=$val['mobile'];
    $transactionRequestBean->bankCode=WL_BANKCODE;
    $transactionRequestBean->email=$val['email'];
    $transactionRequestBean->shoppingCartDetails=$val['reqDetail'];
   	$transactionRequestBean->currencyCode=WL_CURRENCYCODE;
    $transactionRequestBean->customerName = $val['custname'];
  	$transactionRequestBean->key=;
    $transactionRequestBean->iv=WL_IV;
    $transactionRequestBean->webServiceLocator=WL_LOCATORURL;
    $transactionRequestBean->timeOut=30;

    $log  = "Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->email."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
    
    file_put_contents('logs/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

    $responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];
	print_r($response);*/
					
			/*		echo $mId="WL0000000010016";
					echo "<br/>";
					echo $enc_key="5e1dc5604b2f2887f7fc5534ce669baa";
						echo "<br/>";
					$donation_id=$resrow['donation_id'];
					echo $orderId=$resrow['donation_orderno'];
						echo "<br/>";
					$pgMeTrnRefNo="";
					$resMsgDTO=$obj->getTransactionStatus($mId,$orderId,$pgMeTrnRefNo,$enc_key);*/
				
					/*if($resMsgDTO){
						echo $txn_refno=$resMsgDTO->getPgMeTrnRefNo();
						echo $order_id=$resMsgDTO->getOrderId();
						echo $txn_status_desc=$resMsgDTO->getStatusDesc();
						echo $txn_reqdate=$resMsgDTO->getTrnReqDate();
						echo $txn_status=$resMsgDTO->getResponseCode();
						exit;
						if($txn_status=="S"){
						    $txn_status="SUCCESS";
						}else{
						     $txn_status="FAILED";
						}
						$txn_bankrefno=$resMsgDTO->getRrn();
						
						
						$donup_status=1;
						$sql_don1="SELECT * from tb_donation where donation_orderno='".$order_id."'";
						$don_result=mysqli_query($conn,$sql_don1);
						$resdon=mysqli_fetch_array($don_result);
						if($resdon->donation_up==0){
							$updon="UPDATE tb_donation SET donation_transstatus='".$txn_status."',donation_transdate='".$txn_reqdate."',donation_bankrefno='".$txn_bankrefno."',donation_txnrefno='".$txn_refno."',donation_statusdesc='".$txn_status_desc."',donation_up='".$donup_status."' WHERE donation_orderno='".$orderId."'";						
							    $up++;
						}
					}*/
				}
		/*	$email_to="bidhi.saklani@gmail.com";
			$mail=new PHPMailer();
			$mail->IsSMTP();
			$mail->Host="mansadevi.org.in";
			$mail->SMTPAuth=true;
			$mail->Port=587;
			$mail->Username="info@mansadevi.org.in";
			$mail->Password="India#1989";
			$mail->From="info@mansadevi.org.in";
			$mail->FromName = "Donation Reminder";
			$mail->AddAddress($email_to);
			$mail->IsHTML(true);
			$mail->AddReplyTo('info@mansadevi.org.in');
			$mail->Subject="Donation Cron Job Test";
			$mail->Body="No. of Update: $up<br/>Total Record Fecthed: $count_order";
			$sent=$mail->Send();*/
		}
?>