#PersianBank

perisan bank plugin for cakephp
This Plugin is made for interacte with Persian bank 
in this plugin  we make all bank access for any cakephp program 
## List of Bank
1. Parsian
2. Melat (Comming Soon)
3. Tejarat (Comming Soon)


## Requirements

The master branch has the following requirements:

* CakePHP 2.2.0 or greater.
* PHP 5.3.0 or greater.

## Installation

* Clone/Copy the files in this directory into `app/Plugin/PersianBank`

This can be done with the git submodule command
```sh
git submodule add https://github.com/moharami/PersianBank app/Plugin/PersianBank
```

* Ensure the plugin is loaded in `app/Config/bootstrap.php` by calling `CakePlugin::load('PersianBank', array('bootstrap' => true, 'routes' => false));`

## Parsian
1. in the PersianBank Plugin Config/bootstrap.php you must add your setting 
```php
Configure::write(
    'Parsian',
    array(
		'try_again'  => array('plugin'  =>'payments'	,'controller' => 'PaymentAccountNumbers' , 'action' => 'list'			, 'admin'=>true),
		'return_url' => array('plugin' =>'payments'		,'controller' => 'PaymentAccountNumbers' , 'action' => 'bank_result'	, 'admin'=>true),
		'PIN'        => 'your pin ...........',
    )
);
```
* try_again  : this url is your payment page, if something wrong during payment , we get back user to the payment page
* return_url : after user paid correctly the authority key get back to this url
* PIN        : this is your pin that you recive from bank - this pin is unique and it set to your ip address that you send to parsian bank


### example of preparing your program to send user to bank site
```php
/**
 * admin_send_to_bank method
 *
 * @return void
 */
	public function admin_send_to_bank(){		
		$price      = 1000; //Rials
		$this->Session->write('amount', $price);

		$this->redirect(array('plugin'=>'persian_bank', 'controller' => 'Parsians', 'action' => 'gotoParsian'));
		
	}
```

### example of back data from bank
```php
/**
 * bank_result method
 *
 * @return void
 */
	public function admin_bank_result(){
		$authority = $this->Session->read('authority');
		// this authority is successfull paid  - please attention delete this session(authority) after save your data in database
		// save data in database
		
	}
```

### Documentaion of Parsian
documentaion that i reciver from parsian bank is placed in Vendor/Documentation/Parsian


# Mellat
1. in the PersianBank Plugin Config/bootstrap.php you must add your setting 
```php
 Configure::write(
     'Mellat',
     array(
        'try_again'    => array('plugin'  =>'payments'  ,'controller' => 'PaymentAccountNumbers' , 'action' => 'list'           , 'admin'=>true),
        'return_url'   => array('plugin'  =>'payments'  ,'controller' => 'PaymentAccountNumbers' , 'action' => 'mellat_result'  , 'admin'=>true),
        'terminalId'   => '',
        'userName'     => '',
        'userPassword' => '',
     )
 );
```
* try_again  : this url is your payment page, if something wrong during payment , we get back user to the payment page
* return_url : after user paid correctly the authority key get back to this url
* PIN        : this is your pin that you recive from bank - this pin is unique and it set to your ip address that you send to parsian bank
* terminalId : terminalId that banks give to you
* userName   :  username for this terminal id
* userPassword : password for this terminal id

### example of preparing your program to send user to bank site
```php
/**
 * admin_mellat_send_to_bank method
 *
 * @return void
 */
    public function admin_mellat_send_to_bank(){
        $price      = 1000; //Rials
        $this->Session->write('amount', $price);
        $this->redirect(array('plugin'=>'persian_bank', 'controller' => 'mellat', 'action' => 'bp_pay_request'));
        
    }
```

### example of back data from bank
```php
/**
 * admin_mellat_result method
 *
 * @return void
 */
    public function admin_mellat_result(){          
        $data = $this->Session->read('data');
        $this->Session->delete('data');

        // this authority is successfull paid  - please attention delete this session(authority) after save your data in database
        // save data 
        
    }
```

### Documentaion of Parsian
documentaion that i reciver from parsian bank is placed in Vendor/Documentation/Mellat



# Tejarat 
1. in the PersianBank Plugin Config/bootstrap.php you must add your setting 
```php
 Configure::write(
     'Tejarat',
     array(
        'try_again'    => array('plugin'  =>'payments'  ,'controller' => 'PaymentAccountNumbers' , 'action' => 'list'           , 'admin'=>true),
        'return_url'   => array('plugin'  =>'payments'  ,'controller' => 'PaymentAccountNumbers' , 'action' => 'tejarat_result' , 'admin'=>true),
        'merchantId'   => 'A2A4',   
     )
 );
```
* try_again  : this url is your payment page, if something wrong during payment , we get back user to the payment page
* return_url : after user paid correctly the authority key get back to this url
* merchantId        : this is your merchantId that you recive from bank 


### example of preparing your program to send user to bank site
```php
/**
 * admin_mellat_send_to_bank method
 *
 * @return void
 */
    public function admin_tejarat_send_to_bank(){
        $price      = 1000; //Rials
        $this->Session->write('amount', $price);
        $this->redirect(array('plugin'=>'persian_bank', 'controller' => 'Tejarat', 'action' => 'send_to_tejarat'));
        
    }
```

### example of back data from bank
```php
/**
 * admin_tejarat_result method
 *
 * @return void
 */
    public function admin_tejarat_result(){ 
    debug($this->request->data);
            die();      
        $data = $this->Session->read('data');
        $this->Session->delete('data');

        // this authority is successfull paid  - please attention delete this session(authority) after save your data in database
        // save data 
        
    }
```

### Documentaion of Tejarat
documentaion that i reciver from Tejarat bank is placed in Vendor/Documentation/Tejarat


