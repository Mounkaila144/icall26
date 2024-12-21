<?php


class CustomerMeetingsDuplicatePhonePager extends Pager {
    
    
    function __construct()
    {             
       parent::__construct(array('CustomerMeeting',
                            'Customer','CustomerAddress',
                            'CustomerMeetingStatus',
                            'CustomerMeetingStatusI18n',                             
                            'assistant'=>'User',
                            'Callcenter',
                            'telepro'=>'User','creator'=>'User',
                            'sale'=>'User','sale2'=>'User'));  
       $aliases=array('telepro'=>'telepro','sale'=>'sale','sale2'=>'sale2','creator'=>'creator');      
       if (CustomerMeetingSettings::load()->hasAssistant())
           $aliases['assistant']='assistant';
       $aliases['assistant']='assistant';
       $this->setAlias($aliases);
    }        
            
    protected function fetchObjects($db)
    {              
       while ($items = $db->fetchObjects()) 
       {                               
              $item=$items->getCustomerMeeting(); 
              if ($items->hasCustomerMeetingStatusI18n())
                  $items->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($items->getCustomerMeetingStatusI18n()); 
              if ($items->hasCustomerMeetingStatusCallI18n() && $items->hasCustomerMeetingStatusCall())
                  $items->getCustomerMeetingStatusCall()->setI18n($items->getCustomerMeetingStatusCallI18n()); 
               if ($items->hasCustomerMeetingTypeI18n() && $items->hasCustomerMeetingType())
                  $items->getCustomerMeetingType()->setI18n($items->getCustomerMeetingTypeI18n()); 
              $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():null);              
              $item->set('sales_id',$items->hasSale()?$items->getSale():null);              
              $item->set('sale2_id',$items->hasSale2()?$items->getSale2():null);              
              $item->set('assistant_id',$items->hasAssistant()?$items->getAssistant():null);
              $item->set('created_by_id',$items->hasCreator()?$items->getCreator():null);
              $item->set('callcenter_id',$items->hasCallcenter()?$items->getCallcenter():null);
              $item->set('campaign_id',$items->hasCustomerMeetingCampaign()?$items->getCustomerMeetingCampaign():null);
              $item->set('state_id',$items->hasCustomerMeetingStatus()?$items->getCustomerMeetingStatus():null); 
              $item->set('status_call_id',$items->hasCustomerMeetingStatusCall()?$items->getCustomerMeetingStatusCall():null);
              $item->set('status_lead_id',$items->hasCustomerMeetingStatusLead()?$items->getCustomerMeetingStatusLead():null); 
              $item->set('type_id',$items->hasCustomerMeetingType()?$items->getCustomerMeetingType():null); 
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->set('customer_id',$items->getCustomer());           
              $this->items[$item->get('id')]=$item;         
       }                   
    }         
              
}

