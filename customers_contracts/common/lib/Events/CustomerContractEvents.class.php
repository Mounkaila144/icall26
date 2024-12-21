<?php

class CustomerContractEvents {
     
 
    static function meetingChange(mfEvent $event)
    {         
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts', $meeting->getSite()))
             return ;   
       
        $meeting_settings=CustomerMeetingSettings::load($meeting->getSite());                
        if ($meeting_settings->get('status_transfer_to_contract_id')==null)
            return ;                                           
        if ($meeting->get('state_id')!=$meeting_settings->get('status_transfer_to_contract_id'))
            return ;   
        try
        {           
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($meeting, 'contract.meeting.transfert')); 
        }
        catch (mfException $e)
        {
            mfMessages::getInstance()->addError($e);
            return ;
        }       
        $contract=new CustomerContract($meeting);  
       
        if ($contract->isNotLoaded())
        {                   
           $user=mfContext::getInstance()->getUser();
           mfMessages::getInstance()->addInfo(__("Contract has been created"));
           $contract_settings=CustomerContractSettings::load($meeting->getSite());
           $contract->set('state_id',$contract_settings->get('default_status_id'));                      
           $contract->toContract($user);   
           $comment= new CustomerMeetingComment(null,$meeting->getSite());        
           $comment->set('comment',__('Contract has been created by [{user}] with status [{status}]',array('status'=>$meeting->getStatus()->getI18n(),'user'=>(string)mfContext::getInstance()->getUser()->getGuardUser())));           
           $comment->set('meeting_id',$meeting);
           $comment->set('type','LOG');
           $comment->save();    
           $comment->setHistory($user->getGuardUser()); 
           mfContext::getInstance()->getEventManager()->notify(new mfEvent($contract, 'contract.change',array('action'=>'to_contract')));          
        }   
        
          
    }
    
    
     static function initializationFormConfig(mfEvent $event)
    {
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$form->getSite()))
             return ;               
         $form->setValidator('contracts_clean',new mfValidatorBoolean());
    }
    
     static function initializationExecute(mfEvent $event)
    {       
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$form->getSite()))
             return ;            
        if ($form->getValue('contracts_clean'))
        {    
            CustomerContractUtils::initializeSite($form->getSite());            
        }
    }
    
    static function sendEmailToTeamManager(mfEvent $event)
    {        
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;   
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('contract_send_team_manager_email_change_state'))))
            return ;   
        if ($contract->hasPropertyChanged('state_id'))
        {    
            $model=CustomerContractSettings::load($contract->getSite())->getChangeStateModelEmail();
            if ($model->isNotLoaded())
            {    
                mfMessages::getInstance ()->addWarning(__("No model exists to send change state email."));
                return ;
            }    
            CustomerContractUtils::sendEmailContractToTeamManager($contract,$model);
        }
    }
    
    static function meetingChangeOpcAt(mfEvent $event)
    {         
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts', $meeting->getSite()))
             return ;      
        $user= mfcontext::getInstance()->getUser();
        $contract=new CustomerContract($meeting);  
        if ($contract->isLoaded() &&  $user->hasCredential(array(array('contract_transfert_meeeting_opc_at'))))
        {           
            $contract->set('opc_at',$meeting->get('opc_at')?(string)$meeting->getOpcAt():$meeting->get('opc_at'));
            $contract->set('opc_range_id',$meeting->get('opc_range_id'));
            $contract->save();
        }        
     /*   if ($contract->isLoaded() &&  $user->hasCredential(array(array('meeting_view_in_at_and_opc_at_to_contract_opc_at_opened_to'))))
        {
            $contract->set('opened_at',$contract->get('opc_at'));
            $contract->set('opened_at_range_id',$contract->get('opc_range_id'));
            $contract->save();
        }  */
    }
    
    
     static function sendEmailToSale1(mfEvent $event)
    {                  
         $contract=$event->getSubject();         
         if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ; 
         if ($contract->hasSale1() && $contract->hasPropertyChanged('state_id') && mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugx','contract_view_send_email_sale1_state_change'))))
         {    
            CustomerContractUtils::sendEmailToSale1($contract);
         }
    }
    
    static function meetingRemove(mfEvent $event)
    {         
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts', $meeting->getSite()))
             return ;                                        
         $contract=new CustomerContract($meeting,$meeting->getSite());
         $contract->delete();        
    }
    
    
    static function meetingsRemove(mfEvent $event)
    {         
        $meetings=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts', $meetings->getSite()))
             return ;                                        
        CustomerContractUtils::removeContractsFromMeetings($meetings);
    }
    
    static function setContractOpenedAtFromOpcAt(mfEvent $event)
    {                      
        $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;        
         if (!$contract->isLoaded())
             return ;        
        // if (!$contract->hasMeeting())
        //     return ;                     
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','meeting_view_in_at_and_opc_at_to_contract_sav_at_opened_to'))))
                 return ;          
         if (!$contract->hasPropertiesChanged(array('sav_at_range_id','sav_at')))
             return ;                   
        $contract->set('opened_at',$contract->get('sav_at'));
        $contract->set('opened_at_range_id',$contract->get('sav_at_range_id'));                              
        $contract->set('opc_at',$contract->get('sav_at'));
        $contract->set('opc_range_id',$contract->get('sav_at_range_id'));           
    }
    
    static function checkDateAndRangeOpcAt(mfEvent $event)
    {                      
        $meeting=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$meeting->getSite()))
             return ;        
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','meeting_transfer_opc_at_range_mandatory'))))
             return ; 
         if ($meeting->isNotLoaded())
             return ;        
         if (!$meeting->hasOpcAt() || !$meeting->hasOpcRange())         
             throw new mfException(__("Date opc/range is mandatory to transfer to contract."));
    }
    
    static function setContractOpcAtAndSavAtFromOpenedAt(mfEvent $event)
    {                      
        $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;        
         if (!$contract->isLoaded())
             return ;        
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','contract_view_opc_at_sav_at_from_opened_to'))))
                 return ;                                 
        $contract->set('sav_at',$contract->get('opened_at'));                              
        $contract->set('opc_at',$contract->get('opened_at'));             
    }
    
    static function setNewContractOpcAtAndSavAtFromOpenedAt(mfEvent $event)
    {                             
        $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;                   
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','contract_new_opc_at_sav_at_from_opened_to'))))
                 return ;                                 
        $contract->set('sav_at',$contract->get('opened_at'));                              
        $contract->set('opc_at',$contract->get('opened_at'));             
    }
    
    static function copyContract(mfEvent $event)
    {                      
        $copy=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts',$copy->getSite()))
             return ;                           
        $copy->copyProductsFrom($event['source']); 
        $copy->copyAttributionsFrom($event['source']); 
    }
    
    static function setContractDatesOpenedAt(mfEvent $event)
    {                      
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ; 
        
       if (in_array($event['action'],array('update','new')) && $event['form']->getValue('is_opened_dates',false))
       {          
           $contract->setDatesIsOpened();
           return ;
       }    
       if (in_array($event['action'],array('load')) &&  $event['form']->hasValidator('contract'))                                
       {          
           if ($event['form']->contract->hasValidator('is_opened_dates') && $event['form']['contract']['is_opened_dates']->getValue())
               $contract->setDatesIsOpened();           
       }    
    }
    
    
    static function checkMaxContractsByZone(mfEvent $event)
    {        
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))        
            return ;
        if (!in_array($event['action'],array('load','update')))
            return ;
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','contract_view_check_max_contract_by_zone','contract_new_check_max_contract_by_zone'))))
            return ;               
        $zones = CustomerContractZone::getZonesFromAddress($contract->getCustomer()->getAddress()); 
       // echo $zones->getMax();
        if ($zones->isEmpty() || $zones->getMax()==0) 
             return ;              
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_view_check_max_contract_by_zone_opc_at'))))
            $number_of_contracts=CustomerContractZone::getNumberOfContractsInOpcAt($contract,$zones);             
        else
            $number_of_contracts=CustomerContractZone::getNumberOfContractsInSavAt($contract,$zones);     
         if ($number_of_contracts < $zones->getMax())
             return ;
         throw new mfException(format_number_choice("[0]No Zone [1]Too many contracts : {max}, for date in the zone : [{names}].|(1,Inf]Too many contracts : {max}, for date in them zone : [{names}].",array('max'=>$zones->getMax(),'names'=>$zones->getNames()->implode(', ')),$zones->getNames()->count()));
    }
    
    static function setContractDatesFromOpenedAt(mfEvent $event)
    {        
        $contract=$event->getSubject();       
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))        
            return ;
        if (!in_array($event['action'],array('update')))
            return ;       
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','contract_update_dates_from_opened_at'))))
            return ;            
        $day = new DayTime($contract->getPropertyChanged('sav_at'));      
        if (!$contract->isDatesIsOpened() && $day->getDay()->getDate() != $contract->getFormatter()->getSavAt()->getDate() && !$contract->isSigned())
        {                     
            $contract->add(array(
                                // 'quoted_at'=>$contract->get('sav_at'),
                              //   'billing_at'=>$contract->get('sav_at'),
                                // 'doc_at'=>$contract->get('sav_at'),          
                               //  'opc_at'=>$contract->get('sav_at'),          
                                 //'pre_meeting_at'=>$contract->get('sav_at'),          
                                 'opened_at'=>$contract->get('sav_at'),      
                            ));
        }                    
    }
    
    static function setNewContractQuotedAtAtAndBillingAtFromOpenedAt(mfEvent $event)
    {                   
        $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;              
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','contract_new_quoted_at_billing_at_from_opened_to'))))
                 return ;                                         
        $contract->set('billing_at',$contract->get('opened_at'));                              
        $contract->set('quoted_at',$contract->get('opened_at'));             
    }
    
    
    static function preExecuteContract(mfEvent $event)
    {                   
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;              
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxxx','contract_view_hold_quote_no_save'))))
                 return ;     
        if ($contract->isHoldQuote())
            throw new mfException(__('Contract not saved. Contract is hold by quotation'));
    }
    
    
    static function setValidateExport(mfEvent $event)
    {                   
        $action=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts'))
             return ; 
        if ($action->getRequest()->getGetParameter('token'))
        {
            $token= new UserValidationToken(array('user'=>$action->getUser()->getGuardUser(),'token'=>$action->getRequest()->getGetParameter('token')));    
            if ($token->isLoaded())
            {
                $token->disable();                
                return ;
            }    
        }       
        $token= new UserValidationToken();      
        $token->create('ContractExport',__('Link for contract export'),url_to("customers_contracts",array('action'=>'ExportCsvContracts'))."?".$action->getRequest()->getGetParametersForUrl(),$action->getUser()->getGuardUser());               
        $action->getRequest()->addRequestParameter('token',$token);
        $action->forward('users','SendValidation');
    }
    
    static function setValidateKmlExport(mfEvent $event)
    {                   
        $action=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts'))
             return ; 
        if ($action->getRequest()->getGetParameter('token'))
        {
            $token= new UserValidationToken(array('user'=>$action->getUser()->getGuardUser(),'token'=>$action->getRequest()->getGetParameter('token')));    
            if ($token->isLoaded())
            {
                $token->disable();                
                return ;
            }    
        }       
        $token= new UserValidationToken();      
        $token->create('ContractExport',__('Link for contract kml export'),url_to("customers_contracts",array('action'=>'ExportKMLContracts'))."?".$action->getRequest()->getGetParametersForUrl(),$action->getUser()->getGuardUser());               
        $action->getRequest()->addRequestParameter('token',$token);
        $action->forward('users','SendValidation');
    }
    
    static function setContractBillableFromState(mfEvent $event){
        $contract=$event->getSubject();        
        if (!mfModule::isModuleInstalled('customers_contracts'))
             return ; 
        $contract_settings=CustomerContractSettings::load($contract->getSite());
        $contract->set('is_billable',($contract->get('state_id')===$contract_settings->getStatus1NoBillable()->get('id')||$contract->get('state_id')===$contract_settings->getStatus2NoBillable()->get('id'))?'NO':'YES');
    }
    
    static function setAutoSaveFieldForContract(mfEvent $event){
        $form=$event->getSubject();    // AutoSaveContractForm    
        if (!mfModule::isModuleInstalled('customers_contracts'))
             return ; 
       if ($form['field']->getValue()!='state_id')
           return ;       
       // Sale1
         if ($form->getContract()->hasSale1() && $form->getUser()->hasCredential(array(array('superadmin_debugx','contract_view_send_email_sale1_state_change'))))
         {    
          //   mfMessages::getInstance ()->addInfo(__("Email has been sent to sale1."));
             CustomerContractUtils::sendEmailToSale1($form->getContract());
         }
         // Team manager
         if ($form->getUser()->hasCredential(array(array('contract_send_team_manager_email_change_state'))))
         {
            $model=CustomerContractSettings::load($form->getContract()->getSite())->getChangeStateModelEmail();
            if ($model->isNotLoaded())
            {    
                mfMessages::getInstance ()->addWarning(__("No model exists to send change state email."));
                return ;
            }    
            CustomerContractUtils::sendEmailContractToTeamManager($form->getContract(),$model);
         }       
    }
    
    
    
    static function setCacheForContractUpdate(mfEvent $event){
        $contract=$event->getSubject();     
        if (!mfModule::isModuleInstalled('customers_contracts',$contract->getSite()))
             return ;         
        if (!in_array($event['action'],['update','new','autosave','attribution']))
                return ;  
        foreach (array(
            'state_id'=>'contract_status',
            'financial_partner_id'=>'contract_financial_partner',
            'team_id'=>'users.teams',
            'telepro_id'=>'users',
            'sale_1_id'=>'users',
            'sale_2_id'=>'users',
            'manager_id'=>'users',
            'admin_status_id'=>'contract_admin_status',
            'opened_at_range_id'=>'contract_range',
            'sav_at_range_id'=>'contract_range',
            'partner_layer_id'=>'layers',
            'opc_status_id'=>'contract_opc_status',
            'polluter_id'=>'polluters',
            'callcenter_id'=>'callcenters',
            'install_state_id'=>'contract_install_states',
            'time_state_id'=>'contract_time_status', 
            'opc_range_id'=>'contract_range',
            'company_id'=>'contract_companies',
            'assistant_id'=>'users',
            'created_by_id'=>'users'
        ) as $name=>$cache)
        {
            if ($contract->hasPropertyChanged($name) || $event['action']=='new')     
            {
               // echo "Name=".$name."<br/>";
                 mfCacheFile::removeCache($cache,'admin',$contract->getSite());                
            }     
        }
              
    }
    
    static function setConfigFilter2ForContract(mfEvent $event){
        
        if (!mfModule::isModuleInstalled('customers_contracts'))
             return ;         
         $filter=$event->getSubject(); 
         $defaults=new mfArray($filter->getDefault('in')['product_id']);         
         if ($defaults->isEmpty())
             return ;       
         $filter->getMfQuery()->left(CustomerContractProduct::getInnerForJoin('contract_id'));                       
    }
    
     static function meetingChangeOpenedAt(mfEvent $event)
    {        
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_contracts', $meeting->getSite()))
             return ;      
          $user= mfcontext::getInstance()->getUser();
          $contract=new CustomerContract($meeting);  
         
            if ($event['action']=='autosave')     
               {

               if ($user->hasCredential(array(array('meeting_to_contract_signed_at_to_opened_at'))))
               {
                   $quotation= new DomoprimeQuotation($meeting); 
                  if ($quotation->isLoaded())
                  {    
                       $contract->set('opened_at',$quotation->get('signed_at'))->save();
                  } 
               }
       }    
    }
}

