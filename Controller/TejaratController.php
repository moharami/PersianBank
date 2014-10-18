<?php
App::uses('PersianBankAppController', 'PersianBank.Controller');
App::import('Vendor', 'PersianBank.nusoap_client', array('file' => 'nusoap/nusoap.php'));
/**
 * Tejarats Controller
 *
 */
class TejaratController extends PersianBankAppController {

	var $uses = false;

/**
 * send_to_tejarat method
 *
 * @return void
 */
	public function admin_send_to_tejarat(){
		$user  = $this->Auth->user();
		$user_id = $user['id'];

		if (!empty($this->request->data)) {
			debug($this->request->data);
			die();
		}


		$try_again  = Configure::read('Tejarat.try_again');
		$return_url = Configure::read('Tejarat.return_url');		
		$amount     = $this->Session->read('amount');
		$merchantId = Configure::read('Tejarat.merchantId');
		$paymentId  = date("Ymd").date("Hi");
		$customerId = $user_id;
		$revertURL  = FULL_BASE_URL . $this->webroot . 'admin/persian_bank/Tejarat/verify_request';
		$this->set(compact('amount','merchantId','paymentId','customerId','revertURL'));
		

		
	}



/**
 * admin_bp_verify_request method
 *
 * @return void
 */
	public function admin_verify_request(){
		$try_again = Configure::read('Tejarat.try_again');
		$return_url = Configure::read('Tejarat.return_url');


		$ns   = 'http://tejarat/paymentGateway/definitions';		
		$wsdl = "http://pg.tejaratbank.net/paymentGateway/services/merchant.wsdl";
		// $this->request->data = array(
		// 		'resultCode'  => '100',
		// 		'paymentId'   => '201410181828',
		// 		'referenceId' => '000071625920'
		// 	);
		if (isset($this->request->data['resultCode'])) {
			

			$resultCode  = $this->request->data['resultCode'];
			$referenceId = isset($this->request->data['referenceId']) ? $this->request->data['referenceId'] : 0;
			$paymentID   = isset($_SESSION["PaymentID"]) ? $_SESSION['PaymentID'] : 0;

		    if (($resultCode == 100)) {
		        try {
		            $client = new nusoap_client($wsdl, true);
		            $err = $client->getError();
		            if ($err) {
		            	$this->Session->setFlash(__d('Behandam', $err),'default',array('class'=>'error'));		                
		            	$this->redirect($try_again);		                
		            }

		            $params = array(
		                "verifyRequest" => array(
							'merchantId'      => Configure::read('Tejarat.merchantId'),
							'referenceNumber' => $referenceId							
						),
		            );

		            $client->setUseCurl(0);
					$client->soap_defencoding = 'UTF-8';
					$client->decode_utf8      = true;

		            $client->setEndpoint($wsdl);
		            $result = $client->call("verify", $params);
		            if ($result == 100) {
		            	$this->Session->write('referenceId', $referenceId);
		            	$this->redirect($return_url);
		            }else{
		            	$error = $this->TejaratVerifyStatus($result);
		            	$this->Session->setFlash(__d('Behandam', $error),'default',array('class'=>'error'));
		            	$this->redirect($try_again);
		            }



		        } catch (Exception $ex) {
	        		$this->Session->setFlash(__d('Behandam', $ex->getMessage()),'default',array('class'=>'error'));		        	    
	        		$this->redirect($try_again);		            
		        }
		    }else{
		    	$error = $this->TejaratCheckStatus($resultCode);
		    	$this->Session->setFlash(__d('Behandam', $error),'default',array('class'=>'error'));
		    	$this->redirect($try_again);
		    }
		}
		
	}





/**
 *  method
 *
 * @return void
 */
public function TejaratCheckStatus($ecode){
	$tmess="شرح خطا:";
   	switch ($ecode){
		case 100:
			$tmess ="موفقیت تراکنش";
			break;
		case 110:
			$tmess ="انصراف دارنده کارت ";
			break;
		case 120:
			$tmess = "موجودی حساب کافی نیست";
			break;
		case 130:
			$tmess = "اطلاعات کارت اشتباه است";
			break;
		case 131:
			$tmess = "رمز کارت اشتباه است";
			break;
		case 132:
			$tmess = "کارت مسدود شده است";
			break;
		case 132:
			$tmess = "کارت مسدود شده است";
			break;
		case 133:
			$tmess = "کارت منقضی شده است";
			break;
		case 140:
			$tmess = "زمان مرود نظر به پایان رسیده است.";
			break;
		case 150:
			$tmess = "خطای داخلی کارت";
			break;
		case 160:
			$tmess = "خطا در Cvv2 یا ExpDate";
			break;
		case 166:
			$tmess = "بانک صادر کننده کارت شما مجوز انجام تراکنش  را صادر نکرده است.";
			break;
		case 200:
			$tmess = "مبلغ تراکنش بیشتر از سقف مجاز برای هر تراکنش است";
			break;
		case 201:
			$tmess = "مبلغ تراکنش بیشتر از سقف در روز می باشد";
			break;
		case 202:
			$tmess = "مبلغ تراکنش بیشتر از سقف مجاز در ماه است";
			break;
	}    
	return $tmess;
}



/**
 *  method
 *
 * @return void
 */
public function TejaratVerifyStatus($ecode){
	$tmess="شرح خطا:";
   	switch ($ecode){
		case -20:
			$tmess = "وجود کاراکتر های غیر مجاز در درخواست";
			break;
		case -30:
			$tmess = "تراکنش قبلا برگشت خورده است";
			break;
		case -50:
			$tmess = "طول رشته درخواست غیر مجاز است";
			break;
		case -51:
			$tmess = "خطا در درخواست";
			break;
		case -80:
			$tmess = "تراکنش مورد نظر یافت نشد.";
			break;
		case -81:
			$tmess = "تراکنش داخلی بانک";
			break;
		case -90:
			$tmess = "تراکنش قبلا تایید شده است";
			break;
		
	}    
	return $tmess;
}


}