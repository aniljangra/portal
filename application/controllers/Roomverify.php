<?php
class Roomverify extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Roomres_model','roommod');
		$this->load->database();
	}
	public function index(){
		echo "Yes its working"; 
		$this->load->library('email');
		$this->email->from('info@mansadevi.org.in', 'SMMDSB Panchkula');
		$this->email->to("bidhi.saklani@gmail.com");
		$this->email->reply_to('info@mansadevi.org.in', 'Shri Mata Mansa Devi Shrine Board');
		$this->email->set_mailtype("html");
		$this->email->subject("Room Cron Details");
		$message="Room Job Working";
		$this->email->message($message);
		$this->email->send();
			
		$this->load->library('paynimo/TransactionRequestBean');
		$transactionRequestBean=new TransactionRequestBean();
		$txndata=$this->roommod->getAllPendingTxn();
	   
		if(count($txndata)>0){
			foreach($txndata as $txnrow){
				
				
					
					
					$payparam=$txnrow->rb_payparam;
					
					
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


    $responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response=$responseDetails[0];

	if($response){
			$response_arl=explode("|",$response);
			$dataar=array();
			foreach($response_arl as $val) {
			    $response1=explode("=", $val);
				$key=$response1[0];
				$dataar[$key]=$response1[1];
				
		   }
			 if($dataar['clnt_txn_ref']){
			  	$order_id=$dataar['clnt_txn_ref'];
				$txndata=$this->roommod->getTxnByRefNo($order_id);
				$id=$txndata->rb_id;
			  	$name=$txndata->rb_name;
			    $mobile=$txndata->rb_mobile;
				$no_rooms=$txndata->rb_norooms;
				$amount=$txndata->rb_amount;
				$book_fordate=date('d-m-Y',strtotime($txndata->rb_bookfordate));
				    	$txn_msg=strtolower($dataar['txn_msg']);

						if($dataar['txn_status']=="0300" && $txn_msg=="success"){
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['rb_transstatus']=$txn_msg;
						$dataup['rb_statuscode']=$txn_status;
						$dataup['rb_transdate']=$txn_date;
						$dataup['rb_bankrefno']=$tpsl_txn_id;
						$dataup['rb_paymessage']=$txn_status;
						$dataup['rb_payrefno']=$rqst_token;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$id);
						if($uptxn){
				$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$sms_channel=SMS_CHANNEL;
				$sms_route=SMS_ROUTE;
				$sms_peid="1701161788461996254";
				$rb_mobile="91".$mobile;
				
					$sms_content="Dear Mr/Ms ".$name." Room booked for date ".$book_fordate.". Txn Id ".$order_id." Total Rooms: ".$no_rooms.", SMMDSB,PKL";
				
				$sms_text_final=urlencode($sms_content);
				$url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$rb_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;
				
				
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
						$dataup['rb_transstatus']=$txn_msg;
						$dataup['rb_statuscode']=$txn_status;
						$dataup['rb_transdate']=$txn_date;
						$dataup['rb_bankrefno']=$tpsl_txn_id;
						$dataup['rb_paymessage']=$txn_status;
						$dataup['rb_payrefno']=$rqst_token;
						$dataup['rb_updbstatus']=1;
						$uptxn=$this->roommod->upRoomBookingStatus($dataup,$id);
						
					
					}
				
		   
			}
			
			}
		}
		}
	}
}
?>