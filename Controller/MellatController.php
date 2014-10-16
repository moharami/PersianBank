<?php
App::uses('PersianBankAppController', 'PersianBank.Controller');
App::import('Vendor', 'PersianBank.nusoap_client', array('file' => 'nusoap/nusoap.php'));
/**
 * Parsians Controller
 *
 */
class MellatController extends PersianBankAppController {
	var $uses = false;

/** this method request payment from bank
 * admin_bpPayRequest method
 *
 * @return void
 */
	public function admin_bp_pay_request(){
		$try_again = Configure::read('Mellat.try_again');

		$client     = new nusoap_client('https://pgwsf.bpm.bankmellat.ir:443/pgwchannel/services/pgw?wsdl');
		$namespace  = 'http://interfaces.core.sw.bps.com/';
		

		$parameters = array(
		    'terminalId'     => Configure::read('Mellat.terminalId'),
		    'userName'       => Configure::read('Mellat.userName'),
		    'userPassword'   => Configure::read('Mellat.userPassword'),
		    'orderId'        => date("His"),
		    'amount'         => $this->Session->read('amount'),
		    'localDate'      => date("Ymd"),
		    'localTime'      => date("His"),
		    'additionalData' => '',
		    'callBackUrl'    => FULL_BASE_URL . $this->webroot . 'admin/persian_bank/Mellat/bp_verify_request',
		    'payerId'        => '0',
		);

		$code = $client->call('bpPayRequest', $parameters, $namespace);
		
		$code    = explode(',', $code);
		$ResCode = $code[0];


		if (!empty($code[1])) {
		    $RefId = $code[1];		    
		}		
		if ($ResCode != 0) {
			$error = $this->MellatCheckStatus($ResCode);
			$this->Session->setFlash(__d('Behandam', $error),'default',array('class'=>'error'));
			$this->redirect($try_again);			
		}else{
			$error = null;
		}
		$this->set(compact('RefId'));
	}


/**
 * admin_bp_verify_request method
 *
 * @return void
 */
	public function admin_bp_verify_request(){
		$try_again = Configure::read('Mellat.try_again');
		$return_url = Configure::read('Mellat.return_url');


		if (isset($this->request->data)) {
			$data            = $this->request->data;
			$ResCode         = $data['ResCode'];
			if ($ResCode == 0) {
				// ********************

				$parameters = array(
					'terminalId'      => Configure::read('Mellat.terminalId'),
					'userName'        => Configure::read('Mellat.userName'),
					'userPassword'    => Configure::read('Mellat.userPassword'),
					'orderId'         => $data['SaleOrderId'],
					'saleOrderId'     => $data['SaleOrderId'],
					'saleReferenceId' => $data['SaleReferenceId'],
				);
				
				$client = new nusoap_client('https://pgwsf.bpm.bankmellat.ir:443/pgwchannel/services/pgw?wsdl');
				$namespace  = 'http://interfaces.core.sw.bps.com/';
				$verify = $client->call('bpVerifyRequest', $parameters, $namespace);		
				if ($verify == 0) {					
					$this->Session->write('data', $data);
					$this->redirect($return_url);
				}else{
					$error   = $this->MellatCheckStatus($verify);
					$this->Session->setFlash(__d('Behandam', $error),'default',array('class'=>'error'));
					$this->redirect($try_again);				
				}
				// ********************								
			}else{
				$error 			= $this->MellatCheckStatus($ResCode);
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
public function MellatCheckStatus($ecode){
	$tmess="شرح خطا:";
   	switch ($ecode){
      case 0:
        $tmess="تراکنش با موفقیت انجام شد";
        break;
      case 11:
        $tmess="شماره کارت معتبر نیست";
        break;
      case 12:
        $tmess= "موجودی کافی نیست";
        break;
      case 13:
        $tmess= "رمز دوم شما صحیح نیست";
        break;
      case 14:
        $tmess= "دفعات مجاز ورود رمز بیش از حد است";
        break;
      case 15:
        $tmess= "کارت معتبر نیست";
        break;
      case 16:
        $tmess= "دفعات برداشت وجه بیش از حد مجاز است";
        break;
      case 17:
        $tmess= "کاربر از انجام تراکنش منصرف شده است";
        break;
      case 18:
        $tmess= "تاریخ انقضای کارت گذشته است";
        break;
      case 19:
        $tmess= "مبلغ برداشت وجه بیش از حد مجاز است";
        break;
      case 111:
        $tmess= "صادر کننده کارت نامعتبر است";
        break;
      case 112:
        $tmess= "خطای سوییچ صادر کننده کارت";
        break;
      case 113:
        $tmess= "پاسخی از صادر کننده کارت دریافت نشد";
        break;
      case 114:
        $tmess= "دارنده کارت مجاز به انجام این تراکنش نمی باشد";
        break;
      case 21:
        $tmess= "پذیرنده معتبر نیست";
        break;
      case 23:
        $tmess= "خطای امنیتی رخ داده است";
        break;
      case 24:
        $tmess= "اطلاعات کاربری پذیرنده معتبر نیست";
        break;
      case 25:
        $tmess= "مبلغ نامعتبر است";
        break;
      case 31:
        $tmess= "پاسخ نامعتبر است";
        break;
      case 32:
        $tmess= "فرمت اطلاعات وارد شده صحیح نیست";
        break;
      case 33:
        $tmess="حساب نامعتبر است";
        break;
      case 34:
        $tmess= "خطای سیستمی";
        break;
      case 35:
        $tmess= "تاریخ نامعتبر است";
        break;
      case 41:
        $tmess= "شماره درخواست تکراری است";
        break;
      case 42:
        $tmess= "تراکنش Sale یافت نشد";
        break;
      case 43:
        $tmess= "قبلا درخواست Verify داده شده است";
        break;
      case 44:
        $tmess= "درخواست Verify یافت نشد";
        break;
      case 45:
        $tmess= "تراکنش Settle شده است";
        break;
      case 46:
        $tmess= "تراکنش Settle نشده است";
        break;
      case 47:
        $tmess= "تراکنش Settle یافت نشد";
        break;
      case 48:
        $tmess= "تراکنش Reverse شده است";
        break;
      case 49:
        $tmess= "تراکنش Refund یافت نشد";
        break;
      case 412:
        $tmess= "شناسه قبض نادرست است";
        break;
      case 413:
        $tmess= "شناسه پرداخت نادرست است";
        break;
      case 414:
        $tmess= "سازمان صادر کننده قبض معتبر نیست";
        break;
      case 415:
        $tmess= "زمان جلسه کاری به پایان رسیده است";
        break;
      case 416:
        $tmess= "خطا در ثبت اطلاعات";
        break;
      case 417:
        $tmess= "شناسه پرداخت کننده نامعتبر است";
        break;
      case 418:
        $tmess= "اشکال در تعریف اطلاعات مشتری";
        break;
      case 419:
        $tmess= "تعداد دفعات ورود اطلاعات بیش از حد مجاز است";
        break;
      case 421:
        $tmess= "IP معتبر نیست";
        break;
      case 51:
        $tmess= "تراکنش تکراری است";
        break;
      case 54:
        $tmess= "تراکنش مرجع موجود نیست";
        break;
      case 55:
        $tmess= "تراکنش نامعتبر است";
        break;
      case 61:
        $tmess= "خطا در واریز";
        break;
	}    
	return $tmess;
}













}
