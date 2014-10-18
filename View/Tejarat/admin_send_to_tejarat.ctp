<section class="panel">
    <div class="panel-body">
      <div id="mask">
        <div id="loader">      
        </div>
      <div id="connect">
            <h4>در حال اتصال به درگاه بانک تجارت </h4>
      </div>
      </div>
      <!--Form   -->

      <?php 

     echo $this->Form->create(null,array(
         'url' => 'https://pg.tejaratbank.net/paymentGateway/page',
         'type' => 'post',
       ));

      echo $this->Form->input('merchantId',array(  
        'name'  => 'merchantId'  ,
        'value' => $merchantId,
        'type'  => 'hidden',
        ));

      echo $this->Form->input('amount',array( 
          'name'  => 'amount'  ,   
          'value' => $amount,          
          'type'  => 'hidden',
        ));

      echo $this->Form->input('paymentId',array(   
          'name'  => 'paymentId',  
          'value' => $paymentId,
          'type'  => 'hidden',
        ));

      echo $this->Form->input('customerId',array(  
          'name'  => 'customerId',   
          'value' => $customerId,
          'type'  => 'hidden',
        ));

      echo $this->Form->input('revertURL',array(  
          'name'  => 'revertURL',    
          'value' => $revertURL,
          'type'  => 'hidden',
        ));

      echo $this->Form->input('btnPayment',array(   
          'name'  => 'btnPayment',
          'value' => 'Send',
          'type'  => 'hidden',
        ));


       ?>
       <?php echo $this->Form->button('ادامه',array('type'=>'submit','class'=>'btn btn-info pull-left')); ?>
    </div>
</section>


 <?php 
     // block config-script
     $this->start('scriptBottom');
          echo $this->Html->script('PersianBank.tejarat');
     $this->end();
 ?>




