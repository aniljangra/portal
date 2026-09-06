<?php
class Cholaverify extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Cholaweb_model','cholamod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function index(){
		echo "Yes its working"; 
		$this->load->library('email');
		$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
		$this->email->to("bidhi.saklani@gmail.com");
		$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
		$this->email->set_mailtype("html");
		$this->email->subject("Room Booking Details");
		$message="Cron Job Working";
		$this->email->message($message);
		$this->email->send();	
			
		$this->load->library('paynimo/TransactionRequestBean');
		$transactionRequestBean=new TransactionRequestBean();
		$txndata=$this->cholamod->getAllPendingTxn();
		
	
		if(count($txndata)>0){
			foreach($txndata as $txnrow){
				
					$cb_id=$txnrow->cb_id;
					$payparam=$txnrow->cb_payparam;
					$orderId=$txnrow->cb_orderno;
					$parmsar=unserialize($payparam);
					$merchantCode=$parmsar['merchantCode'];
					$ITC=$parmsar['ITC'];
					$customerName=$parmsar['customerName'];
					$merchantTxnRefNumber=$parmsar['merchantTxnRefNumber'];
					$currencyCode=$parmsar['currencyCode'];
					$amount=$parmsar['amount'];
					//$returnURL=$parmsar['returnURL'];
					$shoppingCartDetails=$parmsar['shoppingCartDetails'];
					$TPSLTxnID=$parmsar['TPSLTxnID'];
					$mobileNumber=$parmsar['mobileNumber'];
					$txnDate=$parmsar['txnDate'];
					$bankCode=$parmsar['bankCode'];
					$custId=$parmsar['custId'];
					$key=$parmsar['key'];
					$iv=$parmsar['iv'];
					$accountNo=$parmsar['accountNo'];
					$webServiceLocator=$parmsar['webServiceLocator'];
					$timeOut=$parmsar['timeOut'];
					
	$transactionRequestBean->merchantCode=$merchantCode;
  	$transactionRequestBean->requestType=WL_REQTYPE2;
    $transactionRequestBean->amount=$amount;
    $transactionRequestBean->returnURL="";
    $transactionRequestBean->txnDate=$txnDate;
    $transactionRequestBean->merchantTxnRefNumber=$merchantTxnRefNumber;
    $transactionRequestBean->ITC=$ITC;
    $transactionRequestBean->mobileNumber=$mobileNumber;
    $transactionRequestBean->bankCode=$bankCode;
    $transactionRequestBean->email="";
    $transactionRequestBean->shoppingCartDetails=$shoppingCartDetails;
   	$transactionRequestBean->currencyCode=$currencyCode;
    $transactionRequestBean->customerName=$customerName;
  	$transactionRequestBean->key=$key;
    $transactionRequestBean->iv=$iv;
    $transactionRequestBean->webServiceLocator=$webServiceLocator;
    $transactionRequestBean->timeOut=$timeOut;

   $log  = "Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->email."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
  
    //Saving string to log by using "FILE_APPEND" to append.
    file_put_contents('logs/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

    $responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response=$responseDetails[0];

	if($response){
			$response_arl=explode("|",$response);
			$dataar=array();
			foreach($response_arl as $val) {
			    $response1=explode("=", $val);
				/*echo "<pre>";
				print_r($response1);
				echo "<pre>";*/
				$key=$response1[0];
				$dataar[$key]=$response1[1];
				
				  //$data=$this->getdetails($response1[0], $parameters);
				 	//print_r($data);
		   }
			 if($dataar['clnt_txn_ref']){
			  	$order_id=$dataar['clnt_txn_ref'];
				$txndata=$this->cholamod->getCholaBookingByOrder($order_id);
				$id=$txndata->cb_id;
			  	$name=$txndata->cb_name;
			    $mobile=$txndata->cb_mobile;
				$amount=$txndata->cb_amount;
				$book_fordate=date('d-m-Y',strtotime($txndata->cb_bookfordate));
				$txn_msg=$dataar['txn_msg'];
				$txn_msg=strtolower($txn_msg);
				if($dataar['txn_status']=="0300" && $txn_msg=="success"){
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
					
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['cb_transstatus']=$txn_msg;
						$dataup['cb_statuscode']=$txn_status;
						$dataup['cb_transdate']=$txn_date;
						$dataup['cb_bankrefno']=$tpsl_txn_id;
						$dataup['cb_statusdesc']=$txn_status;
						$dataup['cb_txnrefno']=$rqst_token;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=1;
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
						$don_amt_final="Rs. ".number_format($amount);
						$sms_username=SMSIN_USERNAME;
						$sms_password=SMSIN_PASSWORD;
						$sms_senderid=SMSIN_SENDER_ID;
						$sms_channel=SMSIN_CHANNEL;
						$sms_route=SMSIN_ROUTE;
						$sms_peid="1701161788461996254";
						$cb_mobile="91".$cb_mobile;
					$sms_content="Dear Mr/Ms ".$name.", Chola booked for date ".$book_fordate.". Txn Id ".$order_id.", SMMDSB,PKL";	
					//$sms_content="Dear Mr/Ms ".$cb_name.", Chola booked for date ".$cb_bookfordate.". Txn Id ".$cb_orderno.", SMMDSB,PKL";	
					$sms_text_final=urlencode($sms_content);
			    	$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;   
		
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$response=curl_exec($ch);
						curl_close($ch);
						
				
				
					}
					}else{
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
					
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['cb_transstatus']=$txn_msg;
						$dataup['cb_statuscode']=$txn_status;
						$dataup['cb_transdate']=$txn_date;
						$dataup['cb_bankrefno']=$tpsl_txn_id;
						$dataup['cb_statusdesc']=$txn_status;
						$dataup['cb_txnrefno']=$rqst_token;
						$dataup['cb_up']=1;
						$dataup['cb_dateup']=0;
						$uptxn=$this->cholamod->upTxnByRefNo($dataup,$order_id);
						
					
					}
		 		  }
		 
		   
	}
			
			}
		}
	}
}
?>