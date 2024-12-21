<?php



class AppDomoprimeIsoEvents  {
     
    
    static function setMigrateFormsForContract(mfEvent $event)
    {    // For ISO 1.0                  
        $forms=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;
         if (isset($event['request']))
             return ;                  
         $request=new DomoprimeCustomerRequest($forms->getContract());
         if ($request->isLoaded())
             return ;            
         $forms_iso=new DomoprimeCustomerMeetingForms();
         $forms_iso->set('data',$forms->get('data'));
         $forms_iso->initializeSettings();
         $request=$forms_iso->transfertToRequest();
         $request->set('contract_id',$forms->getContract());
         $request->set('customer_id',$forms->getContract()->get('customer_id'));
         $request->save();                  
    }
    
    static function setRequestForContract(mfEvent $event)
    {    // For ISO 2.0                  
        $forms=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;
         if (!isset($event['request']))
             return ;                  
         /*$request=new DomoprimeCustomerRequest($forms->getContract());
         if ($request->isLoaded())
             return ;            
         $forms_iso=new DomoprimeCustomerMeetingForms();
         $forms_iso->set('data',$forms->get('data'));
         $forms_iso->initializeSettings();
         $request=$forms_iso->transfertToRequest();
         $request->set('contract_id',$forms->getContract());
         $request->set('customer_id',$forms->getContract()->get('customer_id'));
         $request->save();    */              
    }
    
     static function setFormConfigForTransferContract(mfEvent $event)
    {                 
       // if (!mfModule::isModuleInstalled('app_domoprime_iso'))
       //     return ;  
        $form=$event->getSubject();  // CustomerContractSlaveNewForm          
        require_once __DIR__."/../../locales/Forms/CustomerRequestServiceForm.class.php";
        $form->embedForm('requests', new CustomerRequestServiceForm(array('required'=>false))) ;
    }
    
    
    static function setFormForTransferContract(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
       $form=$event->getSubject();  // CustomerContractSlaveNewForm 
       // Requests  
       $request=new DomoprimeCustomerRequest(null,$form->getContract()->getSite());
       $request->add($form['requests']->getValues());
       
       // Tarif
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'contract.request.transfert.populate')); 
        
       //energy            
        if ($form['requests']['energy_id']->getValue())
        {            
            $energy_i18n=new DomoprimeEnergyI18n(array('value'=>$form['requests']['energy_id']['value']->getValue()));
            if ($energy_i18n->isNotLoaded())
            {    
               $energy=new DomoprimeEnergy(); 
               $energy->add($form['requests']['energy_id']->getValue())->save();
               $energy->setI18n($energy_i18n);
               $energy->getI18n()->set('energy_id',$energy);
               $energy->getI18n()->add($form['requests']['energy_id']->getValue())->save();
            }
            $request->set('energy_id',$energy_i18n->getEnergy());
        }
       // occupation 
        if ($form['requests']['occupation_id']->getValue())
        {
            $occupation_i18n=new DomoprimeOccupationI18n(array('value'=>$form['requests']['occupation_id']['value']->getValue()));
            if ($occupation_i18n->isNotLoaded())
            {    
               $occupation=new DomoprimeOccupation(); 
               $occupation->add($form['requests']['occupation_id']->getValue())->save();
               $occupation->setI18n($occupation_i18n);
               $occupation->getI18n()->set('occupation_id',$occupation);
               $occupation->getI18n()->add($form['requests']['occupation_id']->getValue())->save();
            }
            $request->set('occupation_id',$occupation_i18n->getOccupation());
        }
       // type 
       if ($form['requests']['layer_type_id']->getValue())
        {
            $type_i18n=new DomoprimeTypeLayerI18n(array('value'=>$form['requests']['layer_type_id']['value']->getValue()));
            if ($type_i18n->isNotLoaded())
            {    
               $type=new DomoprimeTypeLayer(); 
               $type->add($form['requests']['layer_type_id']->getValue())->save();
               $type->setI18n($type_i18n);
               $type->getI18n()->set('type_id',$type);
               $type->getI18n()->add($form['requests']['layer_type_id']->getValue())->save();
            }
            $request->set('type_id',$type_i18n->getType());
        } 
       $request->set('contract_id',$form->getContract());       
       $request->set('customer_id',$form->getContract()->get('customer_id'));  
       $request->save();    
       
       
       
       
       
    }
    
    static function setFormForTransferContractOffline(mfEvent $event)
    {                 
        if (mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $form=$event->getSubject();  
       if (!$form->getValue('requests'))
           return ;
       $request=$form->getValue('requests');
       // Requests               
        $settings=new DomoprimeSettings();       
       $forms=new CustomerMeetingForms($form->getContract(),$form->getContract()->getSite());
       $forms->set('data',$form['forms']->getValue());
       foreach ($settings->getFormFieldsSchema() as $name=>$formfield)
       {    
          $forms->setDataFromNamespaceAndName($formfield->getForm()->get('name'),$formfield->get('name'),$request[$name]);
       }                     
       $forms->save();         
    }
    
   
    /*
     * 
     * M E E T I N G
     *      
     */
    static function setMigrateFormsForMeeting(mfEvent $event)
    {    // For ISO 1.0                  
        $forms=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;
         if (isset($event['request']))
             return ;                  
         $request=new DomoprimeCustomerRequest($forms->getMeeting());
         if ($request->isLoaded())
             return ;            
         $forms_iso=new DomoprimeCustomerMeetingForms();
         $forms_iso->set('data',$forms->get('data'));
         $forms_iso->initializeSettings();
         $request=$forms_iso->transfertToRequest();
         $request->set('meeting_id',$forms->getMeeting());
         $request->set('customer_id',$forms->getMeeting()->get('customer_id'));
         $request->save();                  
    }
    
    static function setRequestForMeeting(mfEvent $event)
    {    // For ISO 2.0                  
        $forms=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;
         if (!isset($event['request']))
             return ;                  
         /*$request=new DomoprimeCustomerRequest($forms->getContract());
         if ($request->isLoaded())
             return ;            
         $forms_iso=new DomoprimeCustomerMeetingForms();
         $forms_iso->set('data',$forms->get('data'));
         $forms_iso->initializeSettings();
         $request=$forms_iso->transfertToRequest();
         $request->set('contract_id',$forms->getContract());
         $request->set('customer_id',$forms->getContract()->get('customer_id'));
         $request->save();    */              
    }
    
     static function setFormConfigForTransferMeeting(mfEvent $event)
    {                 
       // if (!mfModule::isModuleInstalled('app_domoprime_iso'))
       //     return ;  
        $form=$event->getSubject();  // CustomerMeetingSlaveNewForm          
        require_once __DIR__."/../../locales/Forms/CustomerRequestServiceForm.class.php";
        $form->embedForm('requests', new CustomerRequestServiceForm(array('required'=>false))) ;
    }
    
    
   /* static function setFormConfigForTransferMeetingOffline(mfEvent $event)
    {                 
        if (mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        echo "----"      ;
        $form=$event->getSubject();  // CustomerMeetingSlaveNewForm          
        require_once __DIR__."/../../locales/Forms/MeetingRequestServiceForm.class.php";
        $form->embedForm('requests', new MeetingRequestServiceForm(),array('required'=>false)) ;
    }*/
    
    
    static function setFormForTransferMeeting(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
       $form=$event->getSubject();  // CustomerMeetingSlaveNewForm 
       // Requests  
       $request=new DomoprimeCustomerRequest(null,$form->getMeeting()->getSite());
       $request->add($form['requests']->getValues());
       //energy            
        if ($form['requests']['energy_id']->getValue())
        {            
            $energy_i18n=new DomoprimeEnergyI18n(array('value'=>$form['requests']['energy_id']['value']->getValue()));
            if ($energy_i18n->isNotLoaded())
            {    
               $energy=new DomoprimeEnergy(); 
               $energy->add($form['requests']['energy_id']->getValue())->save();
               $energy->setI18n(new  DomoprimeEnergyI18n());
               $energy->getI18n()->set('energy_id',$energy);
               $energy->getI18n()->add($form['requests']['energy_id']->getValue())->save();
            }
            $request->set('energy_id',$energy_i18n->getEnergy());
        }
       // occupation 
        if ($form['requests']['occupation_id']->getValue())
        {
            $occupation_i18n=new DomoprimeOccupationI18n(array('value'=>$form['requests']['occupation_id']['value']->getValue()));
            if ($occupation_i18n->isNotLoaded())
            {    
               $occupation=new DomoprimeOccupation(); 
               $occupation->add($form['requests']['occupation_id']->getValue())->save();
               $occupation->setI18n(new  DomoprimeOccupationI18n());
               $occupation->getI18n()->set('occupation_id',$occupation);
               $occupation->getI18n()->add($form['requests']['occupation_id']->getValue())->save();
            }
            $request->set('occupation_id',$occupation_i18n->getOccupation());
        }
       // type 
       if ($form['requests']['layer_type_id']->getValue())
        {
            $type_i18n=new DomoprimeTypeLayerI18n(array('value'=>$form['requests']['layer_type_id']['value']->getValue()));
            if ($type_i18n->isNotLoaded())
            {    
               $type=new DomoprimeTypeLayer(); 
               $type->add($form['requests']['layer_type_id']->getValue())->save();
               $type->setI18n(new  DomoprimeTypeLayerI18n());
               $type->getI18n()->set('type_id',$type);
               $type->getI18n()->add($form['requests']['layer_type_id']->getValue())->save();
            }
            $request->set('type_id',$type_i18n->getType());
        } 
       $request->set('meeting_id',$form->getMeeting());       
       $request->set('customer_id',$form->getMeeting()->get('customer_id'));  
       $request->save();    
    }
    
    
    static function setFormForTransferMeetingOffline(mfEvent $event)
    {                 
        if (mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
       $form=$event->getSubject();  
       if (!$form->getValue('requests'))
           return ;
       $request=$form->getValue('requests');
       // Requests               
        $settings=new DomoprimeSettings();       
       $forms=new CustomerMeetingForms($form->getMeeting(),$form->getMeeting()->getSite());
       $forms->set('data',$form['forms']->getValue());
       foreach ($settings->getFormFieldsSchema() as $name=>$formfield)
       {    
          $forms->setDataFromNamespaceAndName($formfield->getForm()->get('name'),$formfield->get('name'),$request[$name]);
       }                     
       $forms->save();         
    }
    
    /* FRONT END */
    static function setDataForSlaveTransferContrat(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        $transfer_data=$event->getSubject();        
        $request=new DomoprimeCustomerRequest($transfer_data->getContract());
        $data = $request->toArrayForTransfer();               
        if ($transfer_data->getSettings()->getMode() == CustomerContractSlaveSettings::MODE0)           
            $data->merge($request->toArray(array('surface_ite','pack_quantity','boiler_quantity','number_of_parts')));                
        $transfer_data->set('requests',$data);
    }
}
