<?php


class CustomerMeetingViewForm extends mfFormSite {
         
    function __construct($defaults = array(),$site = null) {
         parent::__construct($defaults,array(), $site);
     }
    
    function configure()
    {          
        $this->setValidator('id',new mfValidatorInteger());
        $this->embedForm('meeting', new CustomerMeetingBaseForm($this->getDefault('meeting'),array(),$this->getSite()));
        $this->meeting->addValidators(array(
                 'assistant_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserUtils::getUsersForSelect($this->getSite()))),
                 'sales_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No commercial")+UserFunctionBaseUtils::getUsersByFunctionForSelect('SALES',$this->getSite()))),
                 'sale2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No commercial")+UserFunctionBaseUtils::getUsersByFunctionForSelect('SALES',$this->getSite()))),
                 'telepro_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelect('TELEPRO',$this->getSite()))),
                 'state_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),
                 'callback_at'=>new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23))
                ));
       $this->embedForm('customer', new CustomerBaseForm($this->getDefault('customer')));    
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));   
    //   $this->embedForm('contact', new CustomerContactBaseForm($this->getDefault('contact'))); 
    //   $this->embedForm('house', new CustomerHouseBaseForm($this->getDefault('house'))); 
    //   $this->embedForm('financial', new CustomerFinancialBaseForm($this->getDefault('financial'))); 
   //    $this->customer->addValidator('union_id',new mfValidatorChoice(array('key'=>true,'choices'=>CustomerUnionUtils::getUnionForI18nSelect($this->getSite()))));
       unset($this->meeting['customer_id'],$this->meeting['id'],
              $this->customer['id'],$this->address['id'],$this->house['id'],
              $this->contact['id'],$this->address['country'],$this->financial['id']
             );
       // Settings
       $this->defaults['address']['country']='FR';
       $this->meeting->addValidator('created_at',new mfValidatorI18nDate(array('date_format'=>'a')));
    }
    
    function getDefaultValuesForMeeting()
    {
        $values=array();
        $state=new CustomerMeetingStatus('WAITING',$this->getSite());
        $values['state_id']=$state->get('id');
        return $values;                
    }
}

