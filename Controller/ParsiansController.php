<?php
App::uses('PersianBankAppController', 'PersianBank.Controller');
App::import('Vendor', 'PersianBank.nusoap_client', array('file' => 'nusoap/nusoap.php'));
/**
 * Parsians Controller
 *
 */
class ParsiansController extends PersianBankAppController {

	/**
	 * this function send a request to parsian bank and recive authority
	 * if we recive status = 0 and authority we rediect user to the bank site
	 * after any result the user guide to the callbackUrl 
	 * admin_gotoParsian method
	 *
	 * @return void
	 */
		public function admin_gotoParsian(){

			$try_again = Configure::read('Parsian.try_again');	

			$soapclient = new nusoap_client('https://pec.shaparak.ir/pecpaymentgateway/eshopservice.asmx?wsdl','wsdl'); //Changed To Shaparak
			if (!$err = $soapclient->getError()){
				$soapProxy = $soapclient->getProxy();			
			}
			if ( (!$soapclient) || ($err = $soapclient->getError()) ) {
				$this->Session->setFlash(__d('Behandam', $err),'default',array('class'=>'error'));
				$this->redirect($try_again);
			}else{				
				$amount = $this->Session->read('amount');		    
				// $this->Session->delete('amount');	
				

				$PIN         = Configure::read('Parsian.PIN');

				$callbackUrl = FULL_BASE_URL . $this->webroot . 'admin/persian_bank/Parsians/check_payment_parsian';
				$authority   = 0 ;  	  // default authority
				$status      = 1 ;        // default status


			    $params = array(
					'pin'         => $PIN ,  // this is our PIN NUMBER
					'amount'      => $amount,
					'orderId'     => date("His"),
					'callbackUrl' => $callbackUrl,
					'authority'   => $authority,
					'status'      => $status
			    );	
				$sendParams = array($params);			
				
				$res        = $soapclient->call('PinPaymentRequest', $sendParams);	

				$authority  = $res['authority'];
				$status     = $res['status'];

			    if ( ($authority) && ($status == 0) ){// this is a succcessfull connection
				   $parsURL = "https://pec.shaparak.ir/pecpaymentgateway/?au=" . $authority ;
					$this->redirect($parsURL);
			    }else{ // this is unsucccessfull connection
					if ($err=$soapclient->getError()) {
						$this->Session->setFlash(__d('Behandam', $err),'default',array('class'=>'warning'));
						$this->redirect($try_again);
					}
					$output = $this->error_parsian($status);
					$this->Session->setFlash(__d('Behandam', $output),'default',array('class'=>'error'));
					$this->redirect($try_again);
			    }
			}			
		}




	/**
	 * this function is callbackUrl and first we check authoriy and status 
	 * if status == 0 it's successful paid , and we have to send another request to bank to say , yea i revice correct data please confirm that
	 * after that if status == 0 returned we return the user to another  action (return_url) . in the return url we must save authority in database for this user
	 * admin_check_Payment_Parsian method
	 *
	 * @return void
	 */
		public function admin_check_payment_parsian(){
			$try_again  = Configure::read('Parsian.try_again');
			$return_url = Configure::read('Parsian.return_url');

			$authority  = $_REQUEST['au'];
			$status     = $_REQUEST['rs'];
			if ($status == 0) {			
				$soapclient = new soapclient('https://pec.shaparak.ir/pecpaymentgateway/eshopservice.asmx?wsdl','wsdl');

				if ( (!$soapclient) OR ($err = $soapclient->getError()) ) {
					// this is unsucccessfull connection				
					$this->Session->setFlash(__d('Behandam', $err),'default',array('class'=>'error'));
					$this->redirect($try_again);
				} else {
					$status = 1 ;   // default status
					$PIN    = Configure::read('Parsian.PIN');			
					$params = array(
						'pin'       => $PIN ,  // this is our PIN NUMBER
						'authority' => $authority,
						'status'    => $status ) ; // to see if we can change it
					$sendParams = array($params) ;
					
					$res        = $soapclient->call('PinPaymentEnquiry', $sendParams);
					$status     = $res['status'];
					if ($status == 0) {				
						$this->Session->write('authority', $authority);
						$this->redirect($return_url);

					} else {
						// this is a UNsucccessfull payment
						// we update our DataBase
						$output = $this->error_parsian($status);
						// $this->Session->setFlash(__d('Behandam', $output),'default',array('class'=>'error'));
						$this->Session->setFlash(__d('Behandam', $output),'default',array('class'=>'error'));
						$this->redirect($try_again);
					}
				}
			} else {
				$output = $this->error_parsian($status);			
				$this->Session->setFlash(__d('Behandam', $output),'default',array('class'=>'error'));
				$this->redirect($try_again);
				
			}
		}


	/**
	 *  method error_parsian
	 *
	 * @return void
	 */
		function error_parsian($status){

			switch ($status){
				case 0:
					$error =  'تراکنش با موفقیت انجام شد.';
				    break;
				case 1:
					$error =  'تراکنش بلا تکلیف و نامشخص است.';
				    break;
				case 20:
					$error =  'کد فروشنده صحیح نمی باشد.' ;
				    break;
				case 22:
					$error =  'پين يا IP فروشنده درست نميباشد.';
				    break;
				case 30:
					$error =  'عمليات قبلا با موفقيت انجام شده است ';
				    break;
				case 34:
					$error =  'شماره تراکنش فروشنده درست نميباشد.';
				    break;
				default:
					$error = 'خطا';
			}
			return $error;
		}


}
