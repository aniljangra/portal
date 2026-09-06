<?php
class Donationverify extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Donationweb_model','dowebmod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function index(){
		$this->load->library('paynimo/TransactionRequestBean');
		$transactionRequestBean=new TransactionRequestBean();
		$txndata=$this->dowebmod->getAllPendingTxn();
		
		if(count($txndata)>0){
			foreach($txndata as $txnrow){
					$donation_id=$txnrow->donation_id;
					$donation_payparam=$txnrow->donation_payparam;
					$orderId=$txnrow->donation_orderno;
					$parmsar=unserialize($donation_payparam);
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

  // $log  = "Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->email."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
  
    //Saving string to log by using "FILE_APPEND" to append.
    //file_put_contents('logs/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

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
			 	 	$txndata=$this->dowebmod->getTxnByRefNo($order_id);
			  		$donation_id=$txndata->donation_id;
			  		$donation_name=$txndata->donation_name;
			    	$donation_mobile=$txndata->donation_mobile;
					$txn_msg=strtolower($dataar['txn_msg']);
				if($dataar['txn_status']=="0300" && $txn_msg=="success"){
					
						$enc_donation_id=$this->encryptcode->encrypt($donation_id,ENC_KEY_PASS);
						$dataup=array();
						$txn_msg=$dataar['txn_msg'];
						$txn_status=$dataar['txn_status'];
						$tpsl_txn_time=$dataar['tpsl_txn_time'];
						$txn_amt=$dataar['txn_amt'];
						$tpsl_txn_id=$dataar['tpsl_txn_id'];
						$rqst_token=$dataar['rqst_token'];
					
						$txn_date=date('Y-m-d H:i:s',strtotime($tpsl_txn_time));
						$dataup['donation_transstatus']=$txn_msg;
						$dataup['donation_statuscode']=$txn_status;
						$dataup['donation_transdate	']=$txn_date;
						$dataup['donation_bankrefno']=$tpsl_txn_id;
						$dataup['donation_statusdesc']=$txn_status;
						$dataup['donation_txnrefno']=$rqst_token;
						$dataup['donation_up']=1;
						
						$uptxn=$this->dowebmod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
							
							
									/* SMS */
				$sms_username=SMS_USERNAME;
				$sms_password=SMS_PASSWORD;
				$sms_senderid=SMS_SENDER_ID;
				$sms_channel=SMS_CHANNEL;
				$sms_route=SMS_ROUTE;
				$sms_peid="1701161788461996254";
				$don_amt_final="Rs. ".number_format($txn_amt);
				$sms_content="Dear Mr/Ms ".$donation_name.", Donation received ".$don_amt_final."/-. TxnId ".$order_id.", SMMDSB,PKL";
				$sms_text_final=urlencode($sms_content);
				$donation_mobile="91".$donation_mobile;
				 $url="http://sms.innuvissolutions.com/api/mt/SendSMS?user=".$sms_username."&password=".$sms_password."&senderid=".$sms_senderid."&channel=".$sms_channel."&DCS=0&flashsms=0&number=".$donation_mobile."&text=".$sms_text_final."&route=".$sms_route."&peid=".$sms_peid;
				
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL,$url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$response=curl_exec($ch);
						curl_close($ch);
						//redirect("online-donation/status/$enc_donation_id");
						
						
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
						$dataup['donation_transstatus']=$txn_msg;
						$dataup['donation_statuscode']=$txn_status;
						$dataup['donation_transdate']=$txn_date;
						$dataup['donation_bankrefno']=$tpsl_txn_id;
						$dataup['donation_statusdesc']=$txn_status;
						$dataup['donation_txnrefno']=$rqst_token;
						$dataup['donation_up']=1;
						$uptxn=$this->dowebmod->upTxnByRefNo($dataup,$order_id);
						//if($uptxn){
							//$enc_donation_id=$this->encryptcode->encrypt($donation_id,ENC_KEY_PASS);
							//redirect("online-donation/status/$enc_donation_id");
							
						//}
				}
		   }
		   
	}
			
			}
		}
	}
}
?>