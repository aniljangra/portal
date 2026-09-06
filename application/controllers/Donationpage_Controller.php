<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Donationpage_Controller extends CI_Controller {
	public function __construct() { 
	    parent::__construct(); 
	    $this->load->helper(array('form', 'url','security','string')); 
	    $this->load->library(array('form_validation','session','user_agent'));
		$this->load->model('Donationweb_model','dowebmod');
		$this->load->model('Webpage_model','webmod');
		$this->load->database();
	}
	public function online_donation(){
		$arr['siteTitle']="Online Donation";	
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} 
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('donation_name','Name', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('donation_amount','Amount', 'trim|required|numeric|xss_clean',array(
		'required'=>'Amount field is required',
		'numeric'=>' Enter the amount in numeric only '
		));
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			$dotemp_id=$this->dowebmod->insertDonationTemp($data);
			if($dotemp_id){
				$enc_dotemp_id=$this->encryptcode->encrypt($dotemp_id,ENC_KEY_PASS);
				redirect("online-donation/overview/$enc_dotemp_id");
			}
		}
		$this->load->view('online-donation',$arr);
	}
	public function payment_status(){
		/*$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} */
		$responseParameter1=$_REQUEST['encData'];
		$key=Key;
		$this->load->library('CryptAES');
		$aes = new CryptAES();
		$aes->set_key(base64_decode($key));
		$aes->require_pkcs5();
		$responseParameter2=$aes->decrypt($responseParameter1);
		
		$final_response=explode("|", $responseParameter2);
		
		
		if(count($final_response)>0){
			
			$donation_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['donation_transstatus']=$trans_status;
			$dataup['donation_paymode']=$pay_mode;
			$dataup['donation_transdate']=$trans_date;
			$dataup['donation_bankrefno']=$bank_ref_no;
			$dataup['donation_statusdesc']=$status_description;
			
			$donationdata=$this->dowebmod->getDonationByOrder($donation_orderno);
			if($donationdata){
				$donation_id=$donationdata->donation_id;
				$uppay=$this->dowebmod->upDonationStatus($dataup,$donation_id);	
				if($uppay){
					$enc_donation_id=$this->encryptcode->encrypt($donation_id,ENC_KEY_PASS);
					redirect("online-donation/success/$enc_donation_id");		
				}
			}
		}
	}
	public function payment_status_preview($enc_donation_id){
		$arr['siteTitle']="Payment Status detail";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} 
		$donation_id=$this->encryptcode->decrypt($enc_donation_id,ENC_KEY_PASS);
		$arr['dodata']=$this->dowebmod->getPerDonation($donation_id);	
		$this->load->view('donation-success-status',$arr);

	}
	
	public function donation_failure(){
		$arr['siteTitle']="Payment Status detail";
		$responseParameter1=$_REQUEST['encData'];
		$key=Key;
		$this->load->library('CryptAES');
		$aes = new CryptAES();
		$aes->set_key(base64_decode($key));
		$aes->require_pkcs5();
		$responseParameter2=$aes->decrypt($responseParameter1);
		echo $responseParameter2;
		exit;
		$final_response=explode("|", $responseParameter2);
		if(count($final_response)>0){
			
			
			$donation_orderno=$final_response[0];
			$trans_status=$final_response[2];
			$amount_paid=$final_response[3];
			$currency=$final_response[4];
			$pay_mode=$final_response[5];
			$trans_date=$final_response[10];
			$bank_ref_no=$final_response[9];
			$status_description=$final_response[7];
			$dataup['donation_transstatus']=$trans_status;
			$dataup['donation_paymode']=$pay_mode;
			$dataup['donation_transdate']=$trans_date;
			$dataup['donation_bankrefno']=$bank_ref_no;
			$dataup['donation_statusdesc']=$status_description;
			
			$donationdata=$this->dowebmod->getDonationByOrder($donation_orderno);
			if($donationdata){
				$donation_id=$donationdata->donation_id;
				$uppay=$this->dowebmod->upDonationStatus($dataup,$donation_id);	
				if($uppay){
					$enc_donation_id=$this->encryptcode->encrypt($donation_id,ENC_KEY_PASS);
					redirect("online-donation/status/$enc_donation_id");		
				}
			}
		}	
	}
	
	public function donation_status($enc_donation_id){
		$arr['siteTitle']="Payment Status detail";
		
		$donation_id=$this->encryptcode->decrypt($enc_donation_id,ENC_KEY_PASS);
		$arr['dodata']=$this->dowebmod->getPerDonation($donation_id);	
		$this->load->view('donation-fail-status',$arr);

	}
	
	public function donation_overview($enc_dotemp_id){
		$arr['siteTitle']="Devotee Donation Details";
		$custsesid=$this->session->userdata('custsesid');
		if(empty($custsesid)){
			$this->session->set_userdata('redirecturl',"online-donation");
			redirect('login');
		} 
		
		$response_url="https://www.mansadevi.org.in/portal/online-donation/worldline/response";
		
		
		
		$arr['regdata']=$this->webmod->getPerRegistration($custsesid);
		$dotemp_id=$this->encryptcode->decrypt($enc_dotemp_id,ENC_KEY_PASS);
		$arr['donationtemp']=$this->dowebmod->getPerDonTempData($dotemp_id);
		
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		$this->form_validation->set_rules('donation_amount','Donation Amount', 'trim|required|xss_clean',array(
		'required'=>'Donation Amount field is required'
		));
		if($this->form_validation->run()==true){
			$data=$this->input->post();
			
		$this->load->library('paynimo/TransactionRequestBean');
		$transactionRequestBean=new TransactionRequestBean();
		 
		//$obj=new AWLMEAPI();
		//$reqMsgDTO=new ReqMsgDTO();
		
		 //Setting all values here
	$name=$arr['donationtemp']->dotemp_name;
	$amount=$arr['donationtemp']->dotemp_amount; 
	$reg_mobileno=$arr['regdata']->reg_mobileno;
	$reg_email=$arr['regdata']->reg_email;
	$time=date("dmyHis");
	$txnid="DO-".substr(hash('sha256', mt_rand() . microtime()),0,4).$time;	
	

		
		$datado['donation_orderno']=$txnid;
		$datado['donation_regid']=$custsesid;
		$datado['donation_name']=$name;
		$datado['donation_mobile']=$reg_mobileno;
		$datado['donation_email']=$reg_email;
		
		$address=$arr['regdata']->reg_address_line1;
		if($arr['regdata']->reg_address_line2!=""){
			$address==$address." ".$arr['regdata']->reg_address_line2;
		}
		$datado['donation_address']=$address;
		$reg_city=$arr['regdata']->reg_city;
		$datado['donation_city']=$reg_city;
		$reg_state=$arr['regdata']->reg_state;
		$datado['donation_state']=$reg_state;
		$reg_pincode=$arr['regdata']->reg_pincode;
		$datado['donation_pincode']=$arr['regdata']->reg_pincode;
		$datado['donation_amount']=$arr['donationtemp']->dotemp_amount;
		$datado['donation_paymethod']=3;
	$donation_id=$this->dowebmod->insertDonation($datado);
	if($donation_id){
	$dorow=$this->dowebmod->getPerDonation($donation_id);
	$itc=$donation_id;		
	//$amount_final=number_format($amount,1);
			$amount_final=number_format($amount,1,'.','');

	$scheme_code="FIRST_".$amount_final."_0.0";	 
	$return_url=site_url("online-donation/worldline/response");
	$transactionRequestBean->merchantCode=WL_MERCHANTCODE_LIVE;
    $transactionRequestBean->ITC=$itc;
    $transactionRequestBean->customerName=$name;
    $transactionRequestBean->requestType=WL_REQTYPE1;
    $transactionRequestBean->merchantTxnRefNumber=$txnid;
    $transactionRequestBean->amount=$amount_final;
    $transactionRequestBean->currencyCode=WL_CURRENCYCODE;
    $transactionRequestBean->returnURL=$return_url;
    $transactionRequestBean->shoppingCartDetails=$scheme_code;
    $transactionRequestBean->TPSLTxnID="";
    $transactionRequestBean->mobileNumber=$reg_mobileno;
    $transactionRequestBean->txnDate=date("Y-m-d");
    $transactionRequestBean->bankCode=WL_BANKCODE;
    $transactionRequestBean->custId=$custsesid;
    $transactionRequestBean->key=WL_KEY;
    $transactionRequestBean->iv=WL_IV;
    $transactionRequestBean->accountNo="";
    $transactionRequestBean->webServiceLocator=WL_LOCATORURL;
    $transactionRequestBean->timeOut=30;
	
	$datapay['merchantCode']=$transactionRequestBean->merchantCode;
	$datapay['ITC']=$transactionRequestBean->ITC;
	$datapay['customerName']=$transactionRequestBean->customerName;
	$datapay['requestType']=$transactionRequestBean->requestType;
	$datapay['merchantTxnRefNumber']=$transactionRequestBean->merchantTxnRefNumber;
	$datapay['amount']=$transactionRequestBean->amount;
	$datapay['currencyCode']=$transactionRequestBean->currencyCode;
	$datapay['returnURL']=$transactionRequestBean->returnURL;
	$datapay['shoppingCartDetails']=$transactionRequestBean->shoppingCartDetails;
	$datapay['TPSLTxnID']=$transactionRequestBean->TPSLTxnID;
	$datapay['mobileNumber']=$transactionRequestBean->mobileNumber;
	$datapay['txnDate']=$transactionRequestBean->txnDate;
	$datapay['bankCode']=$transactionRequestBean->bankCode;
	$datapay['custId']=$transactionRequestBean->custId;
	$datapay['key']=$transactionRequestBean->key;
	$datapay['iv']=$transactionRequestBean->iv;
	$datapay['accountNo']=$transactionRequestBean->accountNo;
	$datapay['webServiceLocator']=$transactionRequestBean->webServiceLocator;
	$datapay['timeOut']=$transactionRequestBean->timeOut;
	$datapayser=serialize($datapay);		
	$this->dowebmod->upPerDonationParms($datapayser,$donation_id);	
			
	 //Writing in Request Log
  	$log="Name : ".$transactionRequestBean->customerName."; Date : ".date("F j, Y, g:i a")."; Request Data : ".$transactionRequestBean->merchantCode."|".$transactionRequestBean->ITC."|".$transactionRequestBean->customerName."|".$transactionRequestBean->requestType."|".$transactionRequestBean->merchantTxnRefNumber."|".$transactionRequestBean->amount."|".$transactionRequestBean->currencyCode."|".$transactionRequestBean->returnURL."|".$transactionRequestBean->shoppingCartDetails."|".$transactionRequestBean->TPSLTxnID."|".$transactionRequestBean->mobileNumber."|".$transactionRequestBean->txnDate."|".$transactionRequestBean->bankCode."|".$transactionRequestBean->custId."|".$transactionRequestBean->key."|".$transactionRequestBean->iv."|".$transactionRequestBean->accountNo."|".$transactionRequestBean->webServiceLocator.PHP_EOL;
    
	
    //Saving string to log by using "FILE_APPEND" to append.
    file_put_contents(base_url().'/application/logs/paynimo/request/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	$responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];
   	echo "<script>window.location = '" . $response . "'</script>";
    ob_flush();
	}
		}else{
			$this->load->view('online-donation-overview',$arr);
		}
	}
	
	
	public function getdetails($code, $parameters){
    if($parameters['showAllResponse'] == "ON"){        
        $column_value = [
            "txn_status"            => "Transaction Status",
            "txn_msg"               => "Message",
            "txn_err_msg"           => "Error Message",
            "clnt_txn_ref"          => "Transaction ID",
            "tpsl_bank_cd"          => "TPSL Bank Code",
            "tpsl_txn_id"           => "TPSL Transaction ID",
            "txn_amt"               => "Amount",
            "tpsl_txn_time"         => "Transaction Time",
            "tpsl_rfnd_id"          => "TPSL Refund ID",
            "bal_amt"               => "Balance Amount",
            "REFUND_DETAILS"        => "Refund details",
            "rqst_token"            => "Request Token",
            "bank_name"             => "Bank Name",
            "card_id"               => "Card ID",
            "alias_name"            => "Alias Name",
            "card_Type"             => "Card Type",
            "Card_Expiry"           => "Card Expiry",
            "hash"                  => "Hash",
            "BANK_TYPE"             => "Bank Type",
            "auth"                  => "Auth"
        ];
    }else{
        $column_value = [
            "txn_status"            => "Transaction Status",
            "txn_msg"               => "Message",
            "txn_err_msg"           => "Error Message",
            "clnt_txn_ref"          => "Transaction ID",
            "tpsl_bank_cd"          => "TPSL Bank Code",
            "tpsl_txn_id"           => "TPSL Transaction ID",
            "txn_amt"               => "Amount",
            "REFUND_DETAILS"        => "Refund details",
            "bank_name"             => "Bank Name"
        ];
    }
    if (in_array($code, array_keys($column_value))) {
        return $column_value[$code];
    }
	}
	public function worldline_donation_response(){
		$this->load->library('paynimo/TransactionResponseBean');
		if($_POST){
   		if(isset($_POST['msg'])) {
        $response = $_POST;
        if (is_array($response)) {
            $str = $response['msg'];
        } else if (is_string($response) && strstr($response, 'msg=')) {
            $outputstr = str_replace('msg=', '', $response);
            $outputArr = explode('&', $outputstr);
            $str = $outputArr[0];
        } else {
            $str = $response;
        }
        $transactionResponseBean = new TransactionResponseBean();
        $transactionResponseBean->setResponsePayload($str);
        $transactionResponseBean->key=WL_KEY;
        $transactionResponseBean->iv=WL_IV;
        $response = $transactionResponseBean->getResponsePayload();

        //Writing in Response Log
        $log="Date : ".date("F j, Y, g:i a")."; Response Data : ".$response.PHP_EOL;
		 //Saving string to log by using "FILE_APPEND" to append.
        file_put_contents(base_url().'/application/logs/paynimo/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
		$response_n = explode("|", $response);
		
        //display_response($response_n,$data);
		
			//echo WL_SHOWALLRESPONSE;
		 	//$parameters['showAllResponse']=WL_SHOWALLRESPONSE;
			//print_r($parameters);
		 	$dataar=array();
		   foreach($response_n as $val) {
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
				if($dataar['txn_status']=="0300" && $dataar['txn_msg']=="success"){
					
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
						redirect("online-donation/status/$enc_donation_id");
						
						
					}
			}else{
					
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
						$dataup['donation_transdate']=$txn_date;
						$dataup['donation_bankrefno']=$tpsl_txn_id;
						$dataup['donation_statusdesc']=$txn_status;
						$dataup['donation_txnrefno']=$rqst_token;
						$dataup['donation_up']=1;
						
						
						$uptxn=$this->dowebmod->upTxnByRefNo($dataup,$order_id);
						if($uptxn){
							$enc_donation_id=$this->encryptcode->encrypt($donation_id,ENC_KEY_PASS);
							redirect("online-donation/status/$enc_donation_id");
							
						}
				}
		   }
		
   		}elseif (isset($_POST['response'])) {
		//Writing in Response Log
        $log  = "Date : ".date("F j, Y, g:i a")."; Response Data : ".$_POST['response'].PHP_EOL;
        //Saving string to log by using "FILE_APPEND" to append.
        file_put_contents(base_url().'/application/logs/paynimo/response/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
		$response_n=explode("|", $_POST['response']);
		//echo "<pre>";
		//print_r($response_n);
		//echo "<pre>";
		
		 // $response1=explode("=", $response_n);
		 
		 
		   
		   
		 
       // display_response($response_n,$data);
    	}
	}else{
		redirect("online-donation/no-response");
    	//echo "No Response Received";
	}
		
	}
	public function no_response(){
		$arr['siteTitle']="No Response";
		$this->load->view('donation-no-response',$arr);
	}
	
}
?>