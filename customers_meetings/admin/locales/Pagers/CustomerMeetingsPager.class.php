<?php


class CustomerMeetingsPager extends Pager {
    
    
  /*  function __construct($classes)
    {             
       parent::__construct($classes);  
       $aliases=array('telepro'=>'telepro','sale'=>'sale','sale2'=>'sale2','creator'=>'creator');      
       if (CustomerMeetingSettings::load()->hasAssistant())
           $aliases['assistant']='assistant';
       $aliases['assistant']='assistant';
       $this->setAlias($aliases); 
    }  
    */
    
     function __construct(CustomerMeetingsFormFilter $filter)
    {               
       $this->filter=$filter;
       parent::__construct($filter->getObjectsForPager()->toArray());      
       $this->setAlias($filter->getAlias());               
    } 
    
    function getFilter()
    {
        return $this->filter;
    }
            
    protected function fetchObjects($db)
    {                  
       while ($items = $db->fetchObjects()) 
       {                               
              $item=$items->getCustomerMeeting();    
          /*    $item->set('status_call_id',$items->hasCustomerMeetingStatusCallI18n()?$items->getCustomerMeetingStatusCallI18n():false);
              if ($items->hasCustomerMeetingStatusCallI18n() && $items->hasCustomerMeetingStatusCall())
                  $items->getCustomerMeetingStatusCall()->setI18n($items->getCustomerMeetingStatusCallI18n()); */
             // if ($items->hasCustomerMeetingStatusI18n())
             //     $items->getCustomerMeetingStatus()->setCustomerMeetingStatusI18n($items->getCustomerMeetingStatusI18n());               
             //  if ($items->hasCustomerMeetingTypeI18n() && $items->hasCustomerMeetingType())
             //     $items->getCustomerMeetingType()->setI18n($items->getCustomerMeetingTypeI18n()); 
            //  $item->set('telepro_id',$items->hasTelepro()?$items->getTelepro():0);              
            //  $item->set('sales_id',$items->hasSale()?$items->getSale():0);              
           //   $item->set('sale2_id',$items->hasSale2()?$items->getSale2():0);              
            //  $item->set('assistant_id',$items->hasAssistant()?$items->getAssistant():0);
           //   $item->set('created_by_id',$items->hasCreator()?$items->getCreator():0);
           //   $item->set('callcenter_id',$items->hasCallcenter()?$items->getCallcenter():0);
          //    $item->set('campaign_id',$items->hasCustomerMeetingCampaign()?$items->getCustomerMeetingCampaign():0);
          //    $item->set('state_id',$items->hasCustomerMeetingStatus()?$items->getCustomerMeetingStatus():0); 
            //  $item->set('status_call_id',$items->hasCustomerMeetingStatusCall()?$items->getCustomerMeetingStatusCall():0);
          //    $item->set('status_lead_id',$items->hasCustomerMeetingStatusLead()?$items->getCustomerMeetingStatusLead():0); 
           //   $item->set('type_id',$items->hasCustomerMeetingType()?$items->getCustomerMeetingType():0); 
              $item->set('partner_layer_id',$items->hasPartnerLayerCompany()?$items->getPartnerLayerCompany():0);    
              $item->set('customer_id',$items->getCustomer());
              $item->getCustomer()->set('address',$items->getCustomerAddress());             
              $item->set('team',$items->team);
              mfContext::getInstance()->getEventManager()->notify(new mfEvent($items, 'meetings.list.pager.item',array('item'=>$item)));                                            
              $this->items[$item->get('id')]=$item;         
       }              
       SystemDebug::getInstance()->addMessage($db->getQuery());    
       CustomerMeetingUtils::getCommentsFromPager($this);
       CustomerMeetingUtils::getUserLocksFromPager($this);   
       CustomerMeetingUtils::getTeamsFromPager($this);  
       
       CustomerMeetingUtils::getStatusCallFromPager($this);
       CustomerMeetingUtils::getCampaignsFromPager($this);
       
       CustomerMeetingUtils::getUsersByFieldFromPager('telepro_id',$this);
       CustomerMeetingUtils::getUsersByFieldFromPager('sales_id',$this);
       CustomerMeetingUtils::getUsersByFieldFromPager('sale2_id',$this);
       CustomerMeetingUtils::getUsersByFieldFromPager('assistant_id',$this);
       CustomerMeetingUtils::getUsersByFieldFromPager('created_by_id',$this);
       
       CustomerMeetingUtils::getStatesFromPager($this);
       CustomerMeetingUtils::getCallcentersFromPager($this);
       
        CustomerMeetingUtils::getStatusLeadFromPager($this);
        CustomerMeetingUtils::getTypeFromPager($this);
        CustomerMeetingUtils::getProductsFromPager($this);
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.list.pager'));       
    }
   
      function getUser()
    {
        return $this->getFilter()->getUser();
    }
    
       function getKeys()
    {
        return new mfArray(parent::getKeys());
    }
    
     function getMeetingsJson()
     {
         return json_encode(array_keys($this->items));
     }
              
}

