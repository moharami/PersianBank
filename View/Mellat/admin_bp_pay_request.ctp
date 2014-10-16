<section class="panel">
    <div class="panel-body">
      <div id="mask">
        <div id="loader">      
        </div>
      <div id="connect">
            <h4>در حال اتصال به درگاه بانک ملت </h4>
      </div>
      </div>
      <!--Form   -->

      <?php 
      echo $this->Form->create(null,array(
                               'url' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
                               'type' => 'post',
                               'name' =>'order'
                               )
                           );
       echo $this->Form->input('btnPayment',array(   
                                                   'name'  => 'RefId',
                                                   'value' => $RefId,
                                                   'type'  => 'hidden',
                                                 ));
       echo $this->Form->end(array(
                 'label' => __('ادامه'),
                 'class' => 'btn btn btn-lg pull-left'
                 )
       );
       ?>
    </div>
</section>


 <?php 
     // block config-script
     $this->start('scriptBottom');
          echo $this->Html->script('PersianBank.mellat');
     $this->end();
 ?>


