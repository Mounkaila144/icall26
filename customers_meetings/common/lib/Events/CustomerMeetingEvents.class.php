<?php



class CustomerMeetingEvents  {
     
    static function setContractHold(mfEvent $event)
    {                  
         $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$contract->getSite()))
             return ;     
          if ($contract->hasMeeting())
              $contract->getMeeting()->setHold()->save();
    }
    
    
    static function setContractUnHold(mfEvent $event)
    {                  
         $contract=$event->getSubject();
          if (!mfModule::isModuleInstalled('customers_meetings',$contract->getSite()))
             return ;     
          if ($contract->hasMeeting())
              $contract->getMeeting()->setUnHold()->save();
    }
    
   // contracts.multiple.process
    static function setContractMultipleProcess(mfEvent $event)
    {                  
         $multiple=$event->getSubject();
          if (!mfModule::isModuleInstalled('customers_meetings',$multiple->getSite()))
             return ;     
         CustomerMeetingUtils::updateMultipleMeetingFromMultipleContracts($multiple);
    }
    
    
    
    static function setContractChange(mfEvent $event)
    {                         
         $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$contract->getSite()))
             return ; 
         if (!$contract->hasMeeting())
            return ;         
         
         if ($contract->hasPropertyChanged('is_hold'))
            $contract->getMeeting()->set('is_hold',$contract->get('is_hold'))  ;
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_company_change_update_meeting_company'))))
            $contract->getMeeting()->set('company_id',$contract->get('company_id'));  
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_polluter_change_update_meeting_polluter'))))
            $contract->getMeeting()->set('polluter_id',$contract->get('polluter_id'));  
         $contract->getMeeting()->save();       
    }
    
    static function sendEmailToSale1(mfEvent $event)
    {                  
         $meeting=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$meeting->getSite()))
             return ; 
         if ($meeting->hasSale() && $meeting->hasPropertyChanged('state_id') && mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','meeting_view_send_email_sale1_state_change'))))
         {    
           CustomerMeetingUtils::sendEmailToSale1($meeting);
         }
    }
    
    static function setMeetingChangeBeforeSave(mfEvent $event)
    {                   
       
         $meeting=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$meeting->getSite()))
             return ;         
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugX','meeting_new_in_at_and_opc_at_to_contract_opc_at_opened_to'))))
                 return ;                         
         if (!$meeting->hasOpcAt())
             return ;        
         $meeting->set('in_at_range_id',$meeting->get('opc_range_id'));                         
         $meeting->set('in_at',$meeting->get('opc_at'));                           
    }
    
    static function setMeetingUpdate(mfEvent $event)
    {           
       
         $meeting=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$meeting->getSite()))
             return ;        
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugX','meeting_view_in_at_and_opc_at_to_contract_sav_at_opened_to'))))
                 return ;        
         if (!$meeting->hasPropertiesChanged(array('opc_range_id','opc_at')))
             return ;    
         $meeting->set('in_at_range_id',$meeting->get('opc_range_id'));                         
         $meeting->set('in_at',$meeting->get('opc_at'));                           
    }
    
    
    static function setMeetingForContractChange(mfEvent $event)
    {               
       
         $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings',$contract->getSite()))
             return ;     
         if (!$contract->hasMeeting())
             return ;
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','meeting_view_in_at_and_opc_at_to_contract_sav_at_opened_to'))))
                 return ;        
         if (!$contract->hasPropertiesChanged(array('sav_at_range_id','sav_at')))
             return ;    
         $contract->getMeeting()->set('in_at_range_id',$contract->get('sav_at_range_id'));                         
         $contract->getMeeting()->set('in_at',$contract->get('sav_at')); 
         $contract->getMeeting()->save();
    }
    
    
     static function setServiceContractFilterConfig(mfEvent $event)
    {                  
        if (!mfModule::isModuleInstalled('customers_meetings'))
            return ;       
        // CustomerContractsServicesFormFilter    
        $event->getSubject()->getMfQuery()->left(CustomerContract::getOuterForJoin('meeting_id'));  
        $event->getSubject()->getObjectsForPager()->push('CustomerMeeting');   
        $model=new iCall26ServiceMeetingModelExport();
        $event->getSubject()->getModel()->getFields()->merge($model->getFields());         
    }
    
    
    static function setAutoSaveContract(mfEvent $event)
    {       
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings',$form->getContract()->getSite()))
            return ;       
        if (!$form->getContract()->hasMeeting())
            return ;       
        if ($form['field']->getValue()=='company_id' && $form->getUser()->hasCredential(array(array('contract_company_change_update_meeting_company'))))
        {          
           $form->getContract()->getMeeting()->set('company_id',$form->getContract()->get('company_id')) ;
        }
        if ($form['field']->getValue()=='polluter_id' && $form->getUser()->hasCredential(array(array('contract_polluter_change_update_meeting_polluter'))))
        {
           $form->getContract()->getMeeting()->set('polluter_id',$form->getContract()->get('polluter_id')) ;
        }    
        $form->getContract()->getMeeting()->save();
    }
     
    
    static function preExecuteMeeting(mfEvent $event)
    {                   
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings',$meeting->getSite()))
             return ;              
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxxx','meeting_view_hold_quote_no_save'))))
                 return ;     
        if ($meeting->isHoldQuote())
            throw new mfException(__('Meeting not saved. Meeeting is hold by quotation'));
    }
    
    
     static function copyMeeting(mfEvent $event)
    {                      
        $copy=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings',$copy->getSite()))
             return ;                           
        $copy->copyProductsFrom($event['source']); 
        
    }
    
     static function setCacheForMeetingUpdate(mfEvent $event){
        $meeting=$event->getSubject();     
        if (!mfModule::isModuleInstalled('customers_meetings',$meeting->getSite()))
             return ;         
        if (!in_array($event['action'],['update','new','autosave']))
                return ;  
        foreach (array(
            'telepro_id'=>array('users','meeting_state'),
            'sales_id'=>array('users','meeting_state'),
            'sale2_id'=>array('users','meeting_state'),
            'team_id'=>array('users','meeting_state'),
            'state_id'=>'meeting_state',
            'assistant_id'=>array('users','meeting_state'),
            'campaign_id'=>'meeting_campaigns',
            'callcenter_id'=>'callcenters',
            'status_call_id'=>'meeting_call_status',
            'status_lead_id'=>'meeting_status_lead',
            'type_id'=>'meeting_type',
            'polluter_id'=>'polluters',
            'opc_range_id'=>'range',
            'partner_layer_id'=>'layers',
            'company_id'=>'companies',
        ) as $name=>$_cache)
        {
            if ($meeting->hasPropertyChanged($name) || $event['action']=='new')     
            {
               // echo "Name=".$name."<br/>";
                foreach ((array)$_cache as $cache)    
                {    
                    mfCacheFile::removeCache($cache,'admin',$meeting->getSite());                
                }
            }     
        }
              
    }
                    

     static function clearCache(mfEvent $event){
         
        $meetings=$event->getSubject();     
        if (!mfModule::isModuleInstalled('customers_meetings',$meetings->getSite()))
             return ;         
         foreach (array(
            'telepro_id'=>array('users','meeting_state'),
            'sales_id'=>array('users','meeting_state'),
            'sale2_id'=>array('users','meeting_state'),
            'team_id'=>array('users','meeting_state'),
            'state_id'=>'meeting_state',
            'assistant_id'=>array('users','meeting_state'),
            'campaign_id'=>'meeting_campaigns',
            'callcenter_id'=>'callcenters',
            'status_call_id'=>'meeting_call_status',
            'status_lead_id'=>'meeting_status_lead',
            'type_id'=>'meeting_type',
            'polluter_id'=>'polluters',
            'opc_range_id'=>'range',
            'partner_layer_id'=>'layers',
            'company_id'=>'companies',
        ) as $name=>$_cache)
        {           
                foreach ((array)$_cache as $cache)    
                {    
                    mfCacheFile::removeCache($cache,'admin',$meetings->getSite());                
                }       
        }
              
    }          
    
}
