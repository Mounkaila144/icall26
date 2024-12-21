<?php

require_once dirname(__FILE__)."/CustomerNewForm.class.php";
require_once dirname(__FILE__)."/ProductsMultipleNewForm.class.php";

class MeetingDateTimeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'date'=>new mfValidatorDate(array("date_format"=>"~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>\d{2}):(?P<minute>\d{2})~","with_time"=>true))
            ));
    }
       
}

class CustomerMeetingNewForm extends mfFormSite {
         
    function __construct($defaults = array(),$site = null) {
         parent::__construct($defaults,array(), $site);
     }
    
    function configure()
    {          
        $this->embedForm('meeting', new CustomerMeetingBaseForm($this->getDefault('meeting'),array(),$this->getSite()));
        $this->meeting->addValidators(array(
                 'assistant_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserUtils::getUsersForSelect($this->getSite()))),
                 'sales_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No commercial")+UserFunctionBaseUtils::getUsersByFunctionForSelect('SALES',$this->getSite()))),
                 'sale2_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No commercial")+UserFunctionBaseUtils::getUsersByFunctionForSelect('SALES',$this->getSite()))),
                 'telepro_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>"No teleprospector")+UserFunctionUtils::getUsersByFunctionForSelect('TELEPRO',$this->getSite()))),
                 'state_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>CustomerMeetingStatusUtils::getStatusForI18nSelect($this->getSite()))),
                 'callback_at'=>new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23))
                ));
       $this->embedForm('customer', new CustomerNewForm($this->getDefault('customer')));    
       $this->customer->setMessage('field_missing', __('This field is missing.'));
       $this->embedForm('address', new CustomerAddressBaseForm($this->getDefault('address')));   
     //  $this->embedForm('contact', new CustomerContactBaseForm($this->getDefault('contact'))); 
    //   $this->embedForm('house', new CustomerHouseBaseForm($this->getDefault('house'))); 
     //  $this->embedForm('financial', new CustomerFinancialBaseForm($this->getDefault('financial'))); 
       $this->embedForm('products', new ProductsMultipleNewForm(array(),$this->getSite()));
    //   $this->customer->addValidator('union_id',new mfValidatorChoice(array('key'=>true,'choices'=>CustomerUnionUtils::getUnionForI18nSelect($this->getSite()))));           
       unset($this->meeting['id'],$this->meeting['customer_id'],
              $this->customer['id'],$this->address['id'],$this->house['id'],
           //   $this->contact['id'],
              $this->address['country'],$this->financial['id']
             );
       $this->meeting->addValidator('created_at',new mfValidatorI18nDate(array('date_format'=>'a')));
    }
    
    function getDefaultValuesForMeeting()
    {       
        $values=array();
        $settings=  CustomerMeetingSettings::load($this->getSite());            
        $values['state_id']=$settings->getStatusByDefault()->get('id');
        $values['status_call_id']=$settings->getStatusCallByDefault()->get('id');
        if (isset($this->defaults['meeting']['in_at']['date']))
            $values['in_at']=$this->defaults['meeting']['in_at']['date'];
        return $values;                
    }     
    
    function setDefaultDateTime($datetime)
    {             
        $this->defaults['meeting']['in_at']=array('date'=>date("Y-m-d",  strtotime($datetime)),
                                                   'hour'=>date("H",  strtotime($datetime)),
                                                   'minute'=>date("i",  strtotime($datetime)),
                                                  );
    }
        
}

