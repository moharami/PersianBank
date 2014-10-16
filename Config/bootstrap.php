<?php 

// ************* Parsian Bank ***************************
	// if you want the user occure some error during pay time come back to this page and try again and have some chance to try another bank
	Configure::write(
	    'Parsian',
	    array(
			'try_again'  => array('plugin'  =>'payments'	,'controller' => 'PaymentAccountNumbers' , 'action' => 'list'			, 'admin'=>true),
			'return_url' => array('plugin' =>'payments'	,'controller' => 'PaymentAccountNumbers' , 'action' => 'bank_result'	, 'admin'=>true),
			'PIN'        => 'your pin........',
	    )
	);
// ************* Parsian Bank ***************************

 

 ?>
