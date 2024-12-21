<?php

class AppDomoprimeIsoEvents  {
     
    
    static function setMeetingNewForm(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();        
        if (!$user->hasCredential(array(array('superadmin','meeting_new_app_domoprime_iso'))))
           return ;         
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestNewMeetingForm.class.php";      
        $form->embedForm('iso', new DomoprimeCustomerRequestNewMeetingForm($user,$form->getDefault('iso',array())));               
    }
   
    static function setMeetingChange(mfEvent $event)
    {                      
        $meeting=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso',$meeting->getSite()) || !isset($event['form']))
             return ;                
        if (!$event['form']->hasValidator('iso')) // check if validator exists.
            return ;          
        if ($event['action']=='new' || $event['action']=='update')
        {                             
            $request=new DomoprimeCustomerRequest($meeting,$meeting->getSite());
            $request->add($event['form']['iso']->getValues());            
            $contract=new CustomerContract($meeting);
            if ($contract->isLoaded())
                $request->set('contract_id',$contract);
            if ($event['action']=='new')
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.meeting.request.new',array('form'=>$event['form'])));  
            $request->save();               
            if (mfContext::getInstance()->getUser()->hasCredential(array(array('meeting_update_no_cumac_generation'))))
                return ;           
            try
           {      
                
                $engine=DomoprimeCumacEngine::getInstance()->getEngine($meeting);
                $engine->process();                 
                $report=new DomoprimeCalculation($engine);                
                $report->set('contract_id',$contract);                
                $report->process(mfcontext::getInstance()->getUser()->getGuardUser());                                       
           }
           catch (mfException $e)
           {                             
               // Remove last calculation
                $report=new DomoprimeCalculation($meeting);
                $report->release();
           }
        }                
    }
    
    static function setMeetingForm(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();          
        if (!$user->hasCredential(array(array('superadmin','meeting_view_app_domoprime_iso'))))
           return ;         
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestViewMeetingForm.class.php";      
        $form->embedForm('iso', new DomoprimeCustomerRequestViewMeetingForm($user,$form->getMeeting(),$form->getDefault('iso',array())));               
    }
    
    static function setContractForm(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();        
        if (!$user->hasCredential(array(array('superadmin','contract_view_app_domoprime_iso'))))
           return ; 
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestViewForm.class.php";           
        $form->embedForm('iso', new DomoprimeCustomerRequestViewForm($user,$form->getDefault('iso',array())));               
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($form, 'contract.view.request.form.config')); 
    }       
    
    
    static function setNewContractForm(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();                                    
        if (!$user->hasCredential(array(array('contract_new_app_domoprime_iso'))))
           return ;       
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestViewForm.class.php";      
        $form->embedForm('iso', new DomoprimeCustomerRequestViewForm($user,$form->getDefault('iso',array())));               
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($form, 'contract.new.request.form.config')); 
    }
    
    static function setContractChange(mfEvent $event)
    {           
        $contract=$event->getSubject();        
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$contract->getSite()))
             return ;       
        if ($event['action']=='to_contract')
        {
            $request=new DomoprimeCustomerRequest($contract->getMeeting(),$contract->getSite());
            $request->set('contract_id',$contract);
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.contract.request.to_contract'));   
            $request->save();
            return ; 
        }             
        if (!isset($event['form']))
             return ;       
        if (!$event['form']->hasValidator('iso')) // check if validator exists.
            return ;             
        if ($event['action']=='new' || $event['action']=='update')
        {                                   
            $request=new DomoprimeCustomerRequest($contract,$contract->getSite());
            $request->add($event['form']['iso']->getValues());              
            $request->set('contract_id',$contract);     
            if ($contract->hasMeeting())
                $request->set('meeting_id',$contract->get('meeting_id'));    
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.contract.request.new'));  
            $request->save();
             if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
                return ;
            try
           {          
                $engine=DomoprimeCumacEngine::getInstance()->getEngine($contract);
                $engine->process();   
              //  $engine=new DomoprimeIsoEngine($contract);
              //  $engine->process();                                    
                $report=new DomoprimeCalculation($engine);
                $report->process(mfcontext::getInstance()->getUser()->getGuardUser());                                  
           }
           catch (mfException $e)
           {
               // Remove last calculation
                $report=new DomoprimeCalculation($contract);
                $report->release();
           }
        }           
    }
    
    static function getSurfacesFromFormsForPager(mfEvent $event)
    {       
       $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso', $pager->getSite()))
             return ;        
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_contract_list_surface_from_form_101','app_domoprime_iso_contract_list_surface_from_form_102','app_domoprime_iso_contract_list_surface_from_form_103'))))
           return ;              
       if (!$pager->hasItems())
            return null;
        foreach ($pager as $item)
            $item->surfaces=new DomoprimeSurfaceCollection();
       $contracts=new mfArray($pager->getkeys());       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('DomoprimeCustomerRequest'))
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IN(".$contracts->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;        
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {               
            $pager->items[$item->get('contract_id')]->surfaces['surface_floor']=$item->get('surface_floor');
            $pager->items[$item->get('contract_id')]->surfaces['surface_wall']=$item->get('surface_wall');
            $pager->items[$item->get('contract_id')]->surfaces['surface_top']=$item->get('surface_top');           
        }       
    } 
    
    static function setVariablesForFormDocument(mfEvent $event)
    {
         $action=$event->getSubject();       
         if (!mfModule::isModuleInstalled('app_domoprime_iso', $action->contract_base->getSite()))
             return ;
         $request=new DomoprimeCustomerRequest($action->contract_base,$action->contract_base->getSite());
         $action->contract['request']=$request->toArrayForDocument();
    }
    
    
    static function setVariablesForFormDocumentPdfForContract(mfEvent $event)
    {
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
          if (!mfModule::isModuleInstalled('app_domoprime_iso',$pdf->getContract()->getSite()))
             return ;                 
         if ($pdf->getContract()->isNotLoaded())
              return ;
      //   if ($pdf->getContract()->getMeeting()->isNotLoaded())
      //       return ;         
         $request=new DomoprimeCustomerRequest($pdf->getContract(),$pdf->getContract()->getSite());            
         $pdf->getAction()->contract['request']=$request->toArrayForDocumentPdf();                   
    }
    
   
    static function setFilterConfigForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;             
       $filter=$event->getSubject();
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_filter_cumac_status'))) &&
           mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_contract_list_filter_class',
                                                                          'app_domoprime_iso_contract_list_filter_header_class',
                                                                          'app_domoprime_iso_contract_list_filter_sector',                                                                          
                                                                          'app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {
           $filter->getMfQuery()->left(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".
                                        DomoprimeCalculation::getTableField("isLast='YES'")
                            ) ;     
       }         
       $filter->getMfQuery()->left(DomoprimeCustomerRequest::getInnerForJoin('contract_id'));
       $filter->addObject('DomoprimeCustomerRequest');
       $filter->setValidator('surface_parcel_check',new mfValidatorBoolean());
       $filter->equal->addValidator('surface_parcel_checker',new mfValidatorString(array('required'=>false)));
       $filter->cols->getChoices()->set('surface_parcel_check','0030_Surface parcelle');   
       $filter->sizes->addValidator('surface_parcel_check',new mfValidatorInteger(array("required"=>false)));      
       $filter->order->addValidator('surface_home',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('surface_wall',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('surface_top',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('surface_floor',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('surface_ite',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('packboiler_quantity',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('pack_quantity',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
       $filter->order->addValidator('boiler_quantity',new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));      
      
       
       $filter->addField('surface_home','DomoprimeCustomerRequest');  
       $filter->addField('surface_ite','DomoprimeCustomerRequest');  
       $filter->addField('packboiler_quantity','DomoprimeCustomerRequest'); 
       $filter->addField('pack_quantity','DomoprimeCustomerRequest'); 
       $filter->addField('boiler_quantity','DomoprimeCustomerRequest'); 
            
       $filter->addField('surface_parcel_checker',array('class'=>'DomoprimeCustomerRequest',
                                             'equal'=>array('conditions'=>
                                                 "(".
                                                 DomoprimeCustomerRequest::getTableField('surface_top')."!=".
                                                     DomoprimeCustomerRequest::getTableField('parcel_surface').
                                                 ")")
                                            ));         
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_energy','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {                    
           $filter->addField('energy_id',array('class'=>'DomoprimeCustomerRequest'));
           $filter->equal->addValidator("energy_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeEnergy::getEnergyI18nListForSelect(),"key"=>true,"required"=>false)));           
           $filter->in->addValidator("energy_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeEnergy::getEnergyI18nForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_header_class','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {            
            $filter->cols->getChoices()->set('class_id','0040_iso_class');   
            $filter->sizes->addValidator('class_id',new mfValidatorInteger(array("required"=>false)));   
            $filter->addField('class_id',array('class'=>'DomoprimeCalculation'));
            $filter->equal->addValidator("class_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeClass::getClassForI18nSelect(),"key"=>true,"required"=>false)));
            $filter->in->addValidator("class_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeClass::getClassI18nForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_sector','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {                    
           $filter->addField('sector_id',array('class'=>'DomoprimeCalculation'));
           $filter->equal->addValidator("sector_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeSector::getSectorForSelect(),"key"=>true,"required"=>false)));           
           $filter->in->addValidator("sector_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeSector::getSectorsForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_filter_surfaces'))))
       {             
            $filter->addField('surface_wall','DomoprimeCustomerRequest');  
            $filter->addField('surface_top','DomoprimeCustomerRequest');  
            $filter->addField('surface_floor','DomoprimeCustomerRequest'); 
            $filter->order->addValidator("surface_wall",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));
            $filter->order->addValidator("surface_top",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));
            $filter->order->addValidator("surface_floor",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));                   
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {     
             $filter->getValidatorSchema()->getPostValidator()->getCallBacks()->push(array('AppDomoprimeIsoEvents','reorganize'));
             $filter->addField('class_energy_sector',null);
             $filter->equal->addValidator("class_energy_sector",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeUtils::getClassEnergyZone(),"key"=>true,"required"=>false)));                          
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_101',))))
       {
          $filter->cols->getChoices()->set('surface_top',__('column-surface_top'));  
          $filter->sizes->addValidator('surface_top',new mfValidatorInteger(array("required"=>false)));
          $filter->getDefaultColumns()->push('surface_top');
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_102'))))
       {
           $filter->cols->getChoices()->set('surface_wall',__('column-surface_wall'));  
           $filter->sizes->addValidator('surface_wall',new mfValidatorInteger(array("required"=>false)));
           $filter->getDefaultColumns()->push('surface_wall');
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_103'))))
       {
          $filter->cols->getChoices()->set('surface_floor',__('column-surface_floor'));   
          $filter->sizes->addValidator('surface_floor',new mfValidatorInteger(array("required"=>false)));
          $filter->getDefaultColumns()->push('surface_floor');
       } 
    }
    
    static function reorganize($validator,$values)
    {
        if (isset($values['equal']['class_energy_sector']))
        {
            $class_energy_sector=explode("_",$values['equal']['class_energy_sector']);
            $values['equal']['energy_id']=$class_energy_sector[1];
            $values['equal']['class_id']=$class_energy_sector[0];
            $values['equal']['sector_id']=$class_energy_sector[2];
        }
        return $values;
    }        
    
    static function setPagerForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;              
       DomoprimeCustomerRequest::getRequestFromPager($event->getSubject());
    } 
    
    static function setPagerItemForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                              
       if (!isset($event['item']))
           return ;
        $items=$event->getSubject();      
        if ($items->hasDomoprimeCustomerRequest())    
        {                
            $event['item']->request=$items->getDomoprimeCustomerRequest();     
        }    
    }
 
    static function setVariablesForDocumentPdf(mfEvent $event)
    {        
        $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$pdf->getSite()))
             return ;        
         $request=new  DomoprimeCustomerRequest($pdf->getContract(),$pdf->getSite());       
         $pdf->getAction()->contract['request']=$request->toArrayForDocumentPdf();
         
    }
    
    static function SetVariablesForDocument(mfEvent $event)
    {
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $action=$event->getSubject();        
        $request=new  DomoprimeCustomerRequest($action->contract_base,$action->contract_base->getSite());                  
        $action->contract['request']=$request->toArrayForDocument();
    }
    
    
    static function setFilterQueryForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;  
        $filter=$event->getSubject();
        if ($filter->hasValidator('surface_parcel_check') && $filter['surface_parcel_check']->getValue())
        {
           $filter->values['equal']['surface_parcel_checker']='YES';
        }           
    }
    
    static function CheckTransfertForContract(mfEvent $event)
    {
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$meeting->getSite()))
             return ;        
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_meeting_to_contract_verif_fiscal'))))
           return ;                    
       $request=new ServiceImpotVerifCustomer($meeting,$meeting->getSite());
       if ($request->isLoaded())
           return ;
       throw new mfException(__('Fiscal information is missing.',array(),'messages','app_domoprime_iso'));
    }
    
    
    
    static function setDataForContractTransfer(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        // Subject: CustomerContractMasterEngine        
        $engine=$event->getSubject();  
         // request       
        $request = new DomoprimeCustomerRequest($engine->getContract(),$engine->getContract()->getSite());               
        $engine->getValues()->set('requests',$request->toArrayForTransfer());
        
    }
    
    
    static function setDataForMeetingTransfer(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
            return ;  
        // Subject: CustomerMeetingMasterEngine        
        $engine=$event->getSubject();        
        // request           
        $request = new DomoprimeCustomerRequest($engine->getMeeting(),$engine->getMeeting()->getSite());
        $engine->getValues()->set('requests',$request->toArrayForTransfer());
        
        // Verif fiscal
    }
    
    
      static function setImportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;           
        $event->getSubject()->addValidators(array(
                'surface_wall'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)),       
                'surface_top'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)),   
                'surface_floor'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)),        
                'revenue'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'number_of_people'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'parcel_surface'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'parcel_reference'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'install_surface_wall'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'install_surface_top'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'install_surface_floor'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'tax_credit_used'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'number_of_fiscal'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)),               
                'number_of_children'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
                'declarants'=>new mfValidatorString(array("max_length"=>"10","trim"=>true,'required'=>false)), 
             //   'energy'=>new mfValidatorString(array("max_length"=>"20","trim"=>true,'required'=>false)), 
                ));
        if (!mfContext::getInstance()->getUser()->hasCredential([['app_domoprime_iso_meeting_import_remove_energy']]))
            $event->getSubject()->addValidator('energy',new mfValidatorString(array("max_length"=>"20","trim"=>true,'required'=>false)));
    }
    
      static function setImportData(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;   
           // Subject: Formulaire de l'import  Parameters: Meeting or Contract         
         $form=$event->getSubject();                 
         $request=new DomoprimeCustomerRequest($event->getParameters());
         $request->add($form->getValues());
         if ($form->hasField('energy') && $form->getValue('energy'))
        {            
            $energy_i18n=new DomoprimeEnergyI18n(array('lang'=>$form->getLanguage(),'value'=>$form->getValue('energy')));          
            if ($energy_i18n->isNotLoaded())                     
                $energy_i18n->set('energy_id', $energy_i18n->getEnergy()->save())->save();   
            $request->set('energy_id',$energy_i18n->getEnergy());
        }           
         mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.request.import')); 
         $request->save();       
    }
    
    
     static function setContractsMultipleFormConfig(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;       
        $form=$event->getSubject();       
        $user=mfContext::getInstance()->getUser();
        if ($user->hasCredential(array(array('superadmin','admin','contract_multiple_iso_generate_cumac'))))
            $form->getActions()->push('iso_generate_cumac');      
    }
    
    static function SetContractsMultipleProcess(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $multiple=$event->getSubject(); // CustomerContractMultipleProcess
        if (in_array('iso_generate_cumac',$multiple->getActions()))
        {                     
            $multiple->getMessages()->push(__("Cumac has been generated.",[],'messages','app_domoprime_iso'));                      
            DomoprimeIsoUtils::generateCalculationForContracts($multiple);
        }        
    }

     static function setExportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;
         // fields mfArray Class        
        $event->getSubject()->getFields()->merge(DomoprimeIsoExport::getFieldsForExport());      
    }   
    
    /*
     *  'app.domoprime.request.quantity.boiler',
       'app.domoprime.request.number_of_people_extra',
              'app.domoprime.request.quantity.pack',
              'app.domoprime.request.surface.ite',
              'app.domoprime.request.ana.prime',
              'app.domoprime.forms.surface_emmy_cp_value',
              'app.domoprime.request.surface_home.surface_emmy_cp_value'
     */
    static function setExportQueryForContract(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;        
        $filter=$event->getSubject();    
         if ($filter->getFormat()->getSchema()->in(['app.domoprime.request.surface.wall','app.domoprime.request.surface.floor', 
              'app.domoprime.request.surface.top','app.domoprime.request.install.surface.wall',
              'app.domoprime.request.install.surface.floor','app.domoprime.request.install.surface.top',            
              'app.domoprime.request.parcel.surface','app.domoprime.request.parcel.reference','app.domoprime.request.revenue',
              'app.domoprime.request.number_of_fiscal','app.domoprime.request.more_2_years','app.domoprime.request.number_of_children',
              'app.domoprime.request.number_of_people','app.domoprime.request.parcel_number','app.domoprime.request.quantity.boiler',
              'app.domoprime.request.quantity.pack','app.domoprime.request.surface.ite', 'app.domoprime.request.ana.prime',
              'app.domoprime.request.number_of_people_extra', 'app.domoprime.request.surface.home.coef.cumac.vmc' ,          
              'app.domoprime.forms.surface_emmy_cp_value', 'app.domoprime.request.surface.home',
              'app.domoprime.request.surface_home.surface_emmy_cp_value',
              'app.domoprime.request.declarants'])) 
        {            
            $filter->setObject('DomoprimeCustomerRequest');      
        }
        if ($filter->getFormat()->getSchema()->in(['app.domoprime.request.occupation.name'])) 
        {            
            $filter->setObject('DomoprimeOccupation');                      
        }        
        $filter->getQuery()->left(DomoprimeCustomerRequest::getInnerForJoin('contract_id'));
        $filter->getQuery()->left(DomoprimeCustomerRequest::getOuterForJoin('occupation_id'));
        if ($event->getSubject()->getFormat()->getSchema()->in(['app.domoprime.request.occupation.value']) )
        { 
            $filter->getQuery()->left(DomoprimeOccupationI18n::getInnerForJoin('occupation_id')." AND ".DomoprimeOccupationI18n::getTableField('lang')."='{lang}'");  
            $filter->setObject('DomoprimeOccupationI18n');              
        }
        
        
        if ($event->getSubject()->getFormat()->getSchema()->in(['app.domoprime.quotation.product.sale_price_with_tax',
                                                                'app.domoprime.quotation.product.total_price_and_adder_with_tax',
                                                                'app.domoprime.quotation.product.price_with_tax']) )
        {                    
             if (!$event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',false))
             {        
              //  $event->getSubject()->setObject('DomoprimeQuotationProduct');
                $event->getSubject()->getQuery()->left(DomoprimeQuotationProduct::getInnerForJoin('quotation_id')." AND ".DomoprimeQuotationProduct::getTableField('product_id')." =".CustomerContractProduct::getTableField('product_id'));                                  
                $event->getSubject()->getQuery()->groupby(DomoprimeQuotationProduct::getTableField('id'));
            } 
            $event->getSubject()->setObject('DomoprimeQuotationProduct');                      
        }
        if (!$filter->getFilter()->getValuesForOptions()->getValue('with_cumac',false) && !$event->getSubject()->getFormat()->getSchema()->in(['app.domoprime.quotation.product.sale_price_with_tax']))       
            $filter->getQuery()->groupBy(CustomerContract::getTableField('id'));               
    }   
        
     static function setVariablesForPartnerEmail(mfEvent $event)
     {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;           
       $action=$event->getSubject();        
       $request=new DomoprimeCustomerRequest($action->getParameter('contract'));
       if ($request->isNotLoaded())
           return ;
        $action->contract['request']=$request->toArrayForEmail();
    }    
    
    static function setVariablesForDocumentContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;           
       $action=$event->getSubject();        
       $request=new DomoprimeCustomerRequest($action->getParameter('contract'));
       if ($request->isNotLoaded())
           return ;
       $action->contract['request']=$request->toArrayForDocument();
    }    
    
    static function setFormConfigForMasterTransferContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                   
         $form=$event->getSubject();   // CustomerContractMasterRefreshForm         
         if ($form->getDefault('requests'))
         {  // mode isoxx => isoxx
              require_once __DIR__."/../../locales/Forms/CustomerRequestServiceForm.class.php";
              $form->embedForm('requests', new CustomerRequestServiceForm(array('required'=>false))) ;           
         }                
    }
    
    static function setFormForMasterTransferContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                    
        $form=$event->getSubject();   // CustomerContractMasterRefreshForm        
        if ($form->getValue('requests'))
        {  // mode isoxx => isoxx
          //  echo "<br>isoxx => isoxx</br>";
          //  echo "==============================================================================<br>";
          //  var_dump($form['requests']->getValues());
          //  echo "==============================================================================<br>";
            $request=new DomoprimeCustomerRequest($form->getContract(),$form->getContract()->getSite());
            $request->add($form['requests']->getValues());
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
            $request->save();    
             if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
                return ;
            try
           {
                $engine=DomoprimeCumacEngine::getInstance()->getEngine($form->getContract());
                $engine->process();   
               // $engine=new DomoprimeIsoEngine($form->getContract());
               // $engine->process();                                    
                $report=new DomoprimeCalculation($engine);
                $report->process(mfcontext::getInstance()->getUser()->getGuardUser());  
           }
           catch (mfException $e)
           {   // remove last calculation
                $report=new DomoprimeCalculation($form->getContract());
                $report->release();
           }                         
        } 
        elseif ($form->getValue('forms'))
        { // mode iso => isoxx
           // echo "1<pre>";
             $settings=new DomoprimeSettings(); 
             $request= new DomoprimeCustomerRequest($form->getContract());             
           /*   nb de personne,nombre defoyer,revenue,101,102,103,energie,,surface parcelle,ref parcelle*/
             $values= unserialize($form->getValue('forms'));
           //  var_dump($values,$settings->getFormFieldsSchema());
             foreach ($settings->getFormFieldsSchema() as $name=>$formfield)
             {              
                 if (!$formfield->getForm()->get('name') || !$formfield->get('name'))
                     continue;
                if (!isset($values[$formfield->getForm()->get('name')][$formfield->get('name')]))
                    continue;                
                $request->set($name,$values[$formfield->getForm()->get('name')][$formfield->get('name')]);
             }                                                        
             $request->save();
           //  var_dump($request);
        }    
    }
    
    static function setFormConfigForMasterTransferMeeting(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                   
         $form=$event->getSubject();   // CustomerMeetingMasterRefreshForm
         if ($form->getDefault('requests'))
         {  // mode isoxx => isoxx
          //    require_once __DIR__."/../../locales/Forms/CustomerRequestServiceForm.class.php";
          //    $form->embedForm('requests', new CustomerRequestServiceForm(array('required'=>false))) ;             
         }                
    }
    
    static function setFormForMasterTransferMeeting(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                    
        $form=$event->getSubject();   // CustomerMeetingMasterRefreshForm        
        if ($form->getValue('requests'))
        {  // mode isoxx => isoxx
            
             
        } 
        elseif ($form->getValue('forms'))
        { // mode iso => isoxx           
             $settings=new DomoprimeSettings(); 
             $request= new DomoprimeCustomerRequest($form->getMeeting());             
           /*   nb de personne,nombre defoyer,revenue,101,102,103,energie,,surface parcelle,ref parcelle*/
             $values= unserialize($form->getValue('forms'));
           //  var_dump($values,$settings->getFormFieldsSchema());
             foreach ($settings->getFormFieldsSchema() as $name=>$formfield)
             {              
                 if (!$formfield->getForm()->get('name') || !$formfield->get('name'))
                     continue;
                if (!isset($values[$formfield->getForm()->get('name')][$formfield->get('name')]))
                    continue;                
                $request->set($name,$values[$formfield->getForm()->get('name')][$formfield->get('name')]);
             }                                                        
             $request->save();         
        }    
    }
    
    static function setFilterForKmlContracts(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                   
        $formfilter=$event->getSubject(); 
        $formfilter->getMfQuery()->left(DomoprimeCustomerRequest::getInnerForJoin('contract_id'));
        $formfilter->getObjects()->push('DomoprimeCustomerRequest');         
    }
    
    static function setDataForKmlContracts(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                   
        $items=$event->getSubject(); 
        if ($items->hasDomoprimeCustomerRequest())
            $items->getCustomerContract()->request=$items->getDomoprimeCustomerRequest();
    }
    
    static function setPlacemarkForKmlContracts(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                   
        $placemark=$event->getSubject();  // GoogleKmlPlacemark
        $contract=$event['contract'];
        if (!$contract->hasRequest())
            return ;
        $placemark->setName($placemark->getName().__(" Parcelle:{parcel_surface} m²-103:{floor} m²-101:{top} m²-102:{wall} m²",
                ['parcel_surface'=>(string)$contract->getRequest()->getFormatter()->getParcelSurface(),
                 'floor'=>(string)$contract->getRequest()->getFormatter()->getSurfaceFloor(),
                 'wall'=>(string)$contract->getRequest()->getFormatter()->getSurfaceWall(),
                 'top'=>(string)$contract->getRequest()->getFormatter()->getSurfaceTop(),
                ]));
    }
    
    
    static function copyContract(mfEvent $event)
    {                      
        $copy=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;         
       // echo "Copy=".$copy->get('id')." Source=".$event['source']->get('id');
        $request=new DomoprimeCustomerRequest(array('contract'=>$copy));       
        $request->copyFromContract($event['source']);
    }
    
     static function setContractForm2(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();                           
        if (!$user->hasCredential(array(array('superadmin_debugxxxxx','superadminxx','contract_view_app_domoprime_iso_product_item'))))
           return ;               
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestView2Form.class.php";      
        $form->embedForm('iso2', new DomoprimeCustomerRequestView2Form($user,$form->getDefault('iso2',array())));
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($form, 'contract.view.request.form.config')); 
        
    }
    
    
    static function setContractChange2(mfEvent $event)
    {                  
        $contract=$event->getSubject();        
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$contract->getSite()))
             return ;       
        if ($event['action']=='to_contract')
        {
            $request=new DomoprimeCustomerRequest($contract->getMeeting(),$contract->getSite());
            $request->set('contract_id',$contract);
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.contract.request.to_contract2'));   
            $request->save();            
            return ; 
        }    
        if (!isset($event['form']))
             return ;       
        if (!$event['form']->hasValidator('iso2')) // check if validator exists.
            return ;            
        if ($event['action']=='new' || $event['action']=='update')
        {           
            $values=$event['form']['iso2']->getValues();           
            $request=new DomoprimeCustomerRequest($contract,$contract->getSite());
            $request->add($values);              
            $request->set('contract_id',$contract);     
            if ($contract->hasMeeting())
                $request->set('meeting_id',$contract->get('meeting_id'));         
            if ($event['action']=='new')
            {    
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($request, 'domoprime.iso.contract.request.new'));  
            }
            $request->save();
             if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
                return ;           
            try
           {                                                
                $engine=DomoprimeCumacEngine::getInstance()->getEngine($contract);
                $engine->process();   
                                
                $report=new DomoprimeCalculation($engine);                               
                $report->process(mfcontext::getInstance()->getUser()->getGuardUser());  
                
                 mfMessages::getInstance()->addInfo(__('Cumac calculation has been done.',[],'messages','app_domoprime_iso'));
           }
           catch (mfException $e)
           {              
               //remove last calculation
                $report=new DomoprimeCalculation($contract);
                $report->release();
           }                 
           // Items           
           $ids=new mfArray();
           foreach (array('wall','top','floor') as $type)
           {
               if (!$values['item_'.$type])
                       continue;
               $ids[]=$values['item_'.$type];
           }          
           $contract->updateItems(ProductItem::getItemsByIds($ids,$contract->getSite()));        
        }           
    }
    
    
     static function setParametersForDocumentContractMultiple(mfEvent $event)
    {               
        // NO SITE /
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;     
        // customers_contracts_documents_pdfMultiple                               
         DomoprimeCustomerRequest::loadParametersForContractMultiple($event->getSubject());
    }
    
    
    static function checkQuotationQuotedAt(mfEvent $event)
    {               
         $contract=$event->getSubject(); 
         if (!mfModule::isModuleInstalled('app_domoprime_iso',$contract->getSite()))
             return ;     
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('contract_view_app_domoprime_iso_quotation_signed_quoted_at'))))
            return ;         
         if ($event['action']!='update')
             return ;         
         $quotation= new DomoprimeQuotation($contract,$contract->getSite());
         if (!$quotation->isSigned())
             return ;              
         if ($contract->getOpenedAt()->getDay()->getDate() != $quotation->getSignedAt()->getDay()->getDate() && $contract->getQuotedAt()->getDay()->getDate() <= $quotation->getSignedAt()->getDay()->getDate())
              throw new mfException(__("Quoted Date of contract [%s] has to be equal to signature date of quotation [%s]",[$contract->getOpenedAt()->getDay()->getFormatted(),$quotation->getSignedAt()->getDay()->getFormatted()],'messages','app_domoprime_iso'));
     }
    
    
     static function setNewContractForm2(mfEvent $event)
    {                     
        $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        $user=mfContext::getInstance()->getUser();        
        if (!$user->hasCredential(array(array('superadmin_debugXXX','contract_new_app_domoprime_iso_product_item'))))
           return ; 
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestView2Form.class.php";      
        $form->embedForm('iso2', new DomoprimeCustomerRequestView2Form($user,$form->getDefault('iso2',array())));     
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($form, 'contract.new.request.form.config')); 
    }
    
    
    static function setCheckerForQuotation(mfEvent $event)
    {                       
        $action=$event->getSubject();  //app_domoprime_pdfAction
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        if (!$action->getUser()->hasCredential(array(array('app_domprime_iso_quotation_check')))) 
            return ;
         if ($action->getUser()->hasCredential(array(array('superadmin_debug')))) 
            return ;
        $checker=new DomoprimeQuotationChecker($action);
        $checker->process();
    }
    
    
    static function setCheckerForDocument(mfEvent $event)
    {                            
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_document_items_check')))) 
            return ; 
        $engine=$event->getSubject();  // DomoprimeIsoDocumentEngine
        $checker=new DomoprimeDocumentChecker($engine->getContract());
        $checker->process();
    }
    
    static function setCheckerForAllDocuments(mfEvent $event)
    {                     
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_all_document_items_check')))) 
            return ; 
        $checker=new DomoprimeDocumentChecker($contract);
        $checker->process();
        
    }
    
    static function setCheckerForAllSignedDocuments(mfEvent $event)
    {                     
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_all_signed_document_items_check')))) 
            return ;       
        $checker=new DomoprimeDocumentChecker($contract);
        $checker->process();
    }
    
    static function setCheckerForPreMeeting(mfEvent $event)
    {                     
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;          
        $user=mfContext::getInstance()->getUser();
        if (!$user->hasCredential(array(array('app_domprime_iso_premeeting_document_items_check')))) 
            return ;       
        $checker=new DomoprimeDocumentChecker($contract);
        $checker->process();
    }
    
    
    static function setContractHoldQuote(mfEvent $event)
    {                     
        $quotation=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                  
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_contract_hold_quote_new_quotation')))) 
            return ;       
        $quotation->getContract()->setHoldQuote()->save();
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_meeting_hold_quote_new_quotation')))) 
            return ; 
        if (!$quotation->hasMeeting())
            return ;
        $quotation->getMeeting()->setHoldQuote()->save();
    }
    
    static function setHoldQuoteContractForAllSignedDocuments(mfEvent $event)
    {                     
        $contract=$event->getSubject();  
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                              
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxxx','app_domprime_iso_contract_hold_quote_new_quotation_all_signed_documents'))))
                 return ;     
        $contract->setHoldQuote()->save();    

        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_meeting_hold_quote_new_quotation_all_signed_documents')))) 
            return ; 
        if (!$contract->hasMeeting())
            return ;
        $contract->getMeeting()->setHoldQuote()->save();        
    }
    
    static function setHoldQuoteContractForAllDocuments(mfEvent $event)
    {                     
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxxx','app_domprime_iso_contract_hold_quote_new_quotation_all_documents'))))
                 return ;     
         $contract->setHoldQuote()->save();
         
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('app_domprime_iso_meeting_hold_quote_new_quotation_all_documents')))) 
            return ; 
        if (!$contract->hasMeeting())
            return ;
        $contract->getMeeting()->setHoldQuote()->save();      
       // if ($contract->isHoldQuote())
       //     throw new mfException(__('Contract is hold by quotation',array(),'messages','customers_contract'));        
    }
    
    /*static function setCheckHoldQuoteContractForDocuments(mfEvent $event)
    {                     
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;               
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','contract_view_hold_quote_no_save'))))
                 return ;     
        if ($contract->isHoldQuote())
            throw new mfException(__('Contract not saved. Contract is hold by quotation',array(),'messages','customers_contract'));        
    }*/
    
      static function setVariablesForQuotation(mfEvent $event)
    {
         $action=$event->getSubject();       
         if (!mfModule::isModuleInstalled('app_domoprime_iso', $action->quotation_base->getSite()))
             return ;                                  
         if ($action->quotation_base->hasContract())
         {    
            $request=new DomoprimeCustomerRequest($action->quotation_base->getContract(),$action->quotation_base->getSite());                
            $action->contract['request']=$request->toArrayForDocument();
         }
         else
         {
            $request=new DomoprimeCustomerRequest($action->quotation_base->getMeeting(),$action->quotation_base->getSite());                
            $action->meeting['request']=$request->toArrayForDocument(); 
         }    
    } 
    
    static function setFieldsForContractExport(mfEvent $event)
    {                   
        $texts=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ; 
        $texts->merge(DomoprimeIsoExport::getFieldsForExport());        
    }
    
    static function setMultipleForMeetingTransfer(mfEvent $event)
    {                 
         $multiple=$event->getSubject(); // CustomerMeetingMultipleProcess
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$multiple->getSite()))
             return ;                                      
        DomoprimeIsoUtils::setMultipleForMeetingTransferForSelection($multiple->getSelection(),$multiple->getSite());
    }
    
    static function setVariablesForFormDocumentPdfForMeeting(mfEvent $event)
    {                   
        $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
        if (!mfModule::isModuleInstalled('app_domoprime_iso',$pdf->getMeeting()->getSite()))
             return ;                 
        if ($pdf->getMeeting()->isNotLoaded())
              return ;
        $request=new DomoprimeCustomerRequest($pdf->getMeeting(),$pdf->getMeeting()->getSite());            
        $pdf->getAction()->meeting['request']=$request->toArrayForDocumentPdf();      
    }
    
    
      static function setMeetingsMultipleFormConfig(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;       
        $form=$event->getSubject();             
        $user=mfContext::getInstance()->getUser();
        if ($user->hasCredential(array(array('superadmin','meeting_multiple_iso_generate_cumac'))))
            $form->getActions()->push('meeting_iso_generate_cumac');      
    }
    
    static function setFilterConfigForMeeting(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;              
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_meeting_list_request'))))
           return ; 
       $filter=$event->getSubject(); 
       $filter->getMfQuery()->left(DomoprimeCustomerRequest::getInnerForJoin('meeting_id'));
       $filter->addObject('DomoprimeCustomerRequest');
        
    }
    
    static function getSurfacesFromRequestMeetingForPager(mfEvent $event)
    {                 
        $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso', $pager->getSite()))
             return ;               
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXXXX','app_domoprime_iso_meeting_list_surface_from_form_101','app_domoprime_iso_meeting_list_surface_from_form_102','app_domoprime_iso_meeting_list_surface_from_form_103'))))
           return ;              
       if (!$pager->hasItems())
            return null;
        foreach ($pager as $item)
            $item->surfaces=new DomoprimeSurfaceCollection();
       $contracts=$pager->getkeys();       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('DomoprimeCustomerRequest'))
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('meeting_id')." IN(".$contracts->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;        
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {               
            $pager->items[$item->get('meeting_id')]->surfaces['surface_floor']=$item->get('surface_floor');
            $pager->items[$item->get('meeting_id')]->surfaces['surface_wall']=$item->get('surface_wall');
            $pager->items[$item->get('meeting_id')]->surfaces['surface_top']=$item->get('surface_top');           
        }            
    }
    
      static function copyMeeting(mfEvent $event)
    {  
        $copy=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;          
       // echo "Copy=".$copy->get('id')." Source=".$event['source']->get('id');
        $request=new DomoprimeCustomerRequest(array('meeting'=>$copy));       
        $request->copyFromMeeting($event['source']);
    }
    
    static function setVariablesForBilling(mfEvent $event)
    {  
        $action=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;          
         $billing=$event->getSubject()->getParameter('billing');
         $request=new DomoprimeCustomerRequest($billing->getContract(),$billing->getSite());
         $action->billing['request']=$request->toArrayForDocument();
    }
    
    
    static function setPagerItemForMeeting(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;                              
       if (!isset($event['item']))
           return ;      
        $items=$event->getSubject();
        if ($items->hasDomoprimeCustomerRequest())    
        {                
            $event['item']->request=$items->getDomoprimeCustomerRequest();     
        }    
    }
    
    
    
     static function setFilter2ConfigForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;            
    
       $filter=$event->getSubject();
   /*    if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_filter_cumac_status'))) &&
           mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_contract_list_filter_class',
                                                                          'app_domoprime_iso_contract_list_filter_header_class',
                                                                          'app_domoprime_iso_contract_list_filter_sector',                                                                          
                                                                          'app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {  // ADAMDEBUG
//           $filter->getMfQuery()->left(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".
//                                        DomoprimeCalculation::getTableField("isLast='YES'")
//                            ) ;     
       }        */ 
       $filter->getMfQuery()->left(DomoprimeCustomerRequest::getInnerForJoin('contract_id'));
       $filter->addObject('DomoprimeCustomerRequest');
       $filter->setValidator('surface_parcel_check',new mfValidatorBoolean());
       $filter->equal->addValidator('surface_parcel_checker',new mfValidatorString(array('required'=>false)));
       $filter->cols->getChoices()->set('surface_parcel_check','0030_Surface parcelle');   
       $filter->sizes->addValidator('surface_parcel_check',new mfValidatorInteger(array("required"=>false)));      
       $filter->addField('surface_parcel_checker',array('class'=>'DomoprimeCustomerRequest',
                                             'equal'=>array('conditions'=>
                                                 "(".
                                                 DomoprimeCustomerRequest::getTableField('surface_top')."!=".
                                                     DomoprimeCustomerRequest::getTableField('parcel_surface').
                                                 ")")
                                            ));         
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_energy','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {                    
           $filter->addField('energy_id',array('class'=>'DomoprimeCustomerRequest'));
           $filter->equal->addValidator("energy_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeEnergy::getEnergyI18nListForSelect(),"key"=>true,"required"=>false)));           
           $filter->in->addValidator("energy_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeEnergy::getEnergyI18nForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_class','app_domoprime_iso_contract_list_filter_header_class','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {            
            $filter->cols->getChoices()->set('class_id','0040_iso_class');   
            $filter->sizes->addValidator('class_id',new mfValidatorInteger(array("required"=>false)));   
            $filter->addField('class_id',array('class'=>'DomoprimeCalculation'));
            $filter->equal->addValidator("class_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeClass::getClassForI18nSelect(),"key"=>true,"required"=>false)));
            $filter->in->addValidator("class_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeClass::getClassI18nForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      

            $filter->getMfQuery()->left(DomoprimeCalculation::getInnerForJoin('contract_id'). " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'");

            
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_sector','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {                    
           $filter->addField('sector_id',array('class'=>'DomoprimeCalculation'));
           $filter->equal->addValidator("sector_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeSector::getSectorForSelect(),"key"=>true,"required"=>false)));           
           $filter->in->addValidator("sector_id",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeSector::getSectorsForSelect(),"key"=>true,"multiple"=>true,"required"=>false)));                      
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_filter_surfaces'))))
       {             
            $filter->addField('surface_wall','DomoprimeCustomerRequest');  
            $filter->addField('surface_top','DomoprimeCustomerRequest');  
            $filter->addField('surface_floor','DomoprimeCustomerRequest'); 
            $filter->order->addValidator("surface_wall",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));
            $filter->order->addValidator("surface_top",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));
            $filter->order->addValidator("surface_floor",new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)));                   
       }
       if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
       {     
             $filter->getValidatorSchema()->getPostValidator()->getCallBacks()->push(array('AppDomoprimeIsoEvents','reorganize'));
             $filter->addField('class_energy_sector',null);
             $filter->equal->addValidator("class_energy_sector",new mfValidatorChoice(array("choices"=>array(""=>"")+DomoprimeUtils::getClassEnergyZone(),"key"=>true,"required"=>false)));                          
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_101',))))
       {
          $filter->cols->getChoices()->set('surface_top',__('column-surface_top'));  
          $filter->sizes->addValidator('surface_top',new mfValidatorInteger(array("required"=>false)));
          $filter->getDefaultColumns()->push('surface_top');
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_102'))))
       {
           $filter->cols->getChoices()->set('surface_wall',__('column-surface_wall'));  
           $filter->sizes->addValidator('surface_wall',new mfValidatorInteger(array("required"=>false)));
           $filter->getDefaultColumns()->push('surface_wall');
       }
       if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_surface_from_form_103'))))
       {
          $filter->cols->getChoices()->set('surface_floor',__('column-surface_floor'));   
          $filter->sizes->addValidator('surface_floor',new mfValidatorInteger(array("required"=>false)));
          $filter->getDefaultColumns()->push('surface_floor');
       } 
    }
   
     static function getSurfacesFromFormsForPager2(mfEvent $event)
    {           
       $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime_iso', $pager->getSite()))
             return ;        
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_contract_list_surface_from_form_101','app_domoprime_iso_contract_list_surface_from_form_102','app_domoprime_iso_contract_list_surface_from_form_103'))))
           return ;              
       if (!$pager->hasItems())
            return ;
        foreach ($pager as $item)
            $item->surfaces=new DomoprimeSurfaceCollection();        
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('DomoprimeCustomerRequest'))
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IN(".$pager->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;        
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {                           
            $pager->items[$item->get('contract_id')]->surfaces['surface_floor']=$item->get('surface_floor');
            $pager->items[$item->get('contract_id')]->surfaces['surface_wall']=$item->get('surface_wall');
            $pager->items[$item->get('contract_id')]->surfaces['surface_top']=$item->get('surface_top');           
        }       
    }  
    
    
    static function setPager2ForContract2(mfEvent $event)
    {           
       $pager=$event->getSubject();      
       if (!mfModule::isModuleInstalled('app_domoprime_iso', $pager->getSite()))
             return ;        
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IN(".$pager->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
            {                           
                if (!isset($pager->items[$item->get('contract_id')]))
                    continue;
                $pager->items[$item->get('contract_id')]->request=$item->loaded();         
            }   
         }
         
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeCalculation::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().                           
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$pager->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('DomoprimeCalculation'))
            {                           
                if (!isset($pager->items[$item->get('contract_id')]))
                    continue;
                $pager->items[$item->get('contract_id')]->calculation=$item->loaded();         
            }   
         }
         
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))  
                ->setObjects(array('DomoprimeClass','DomoprimeClassI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeClass::getTable().    
                           " INNER JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id').
                           " INNER JOIN ".DomoprimeCalculation::getInnerForJoin('class_id').
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$pager->getKeys()->implode(",").")".                         
                                    " AND ".DomoprimeClassI18n::getTableField('lang')."='{lang}'".
                                    " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                 if (!isset($pager->items[$items->get('contract_id')]))
                     continue;
                 $pager->items[$items->get('contract_id')]->calculation->set('class_id',$items->getDomoprimeClass());         
                 $pager->items[$items->get('contract_id')]->calculation->getClass()->setI18n($items->getDomoprimeClassI18n());         
            }   
         }
         
    }
    
    static function setDataExport2ForContract(mfEvent $event)
    {           
       $export=$event->getSubject();      
       if (!mfModule::isModuleInstalled('app_domoprime_iso', $export->getSite()))
             return ;        
       
        
       
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.request.*')->isEmpty())
      {    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {                           
            if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                continue;
            $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeCustomerRequest',$item);              
        } 
       }
      }
      
      if (!$export->getFormat()->getSchema()->getNames()->glob(['app.domoprime.request.occupation*','app.domoprime.occupation*'])->isEmpty())
      {         
         $db=mfSiteDatabase::getInstance();
              $db->setParameters(array('lang'=>$export->getLanguage()))
                ->setObjects(array('DomoprimeOccupation','DomoprimeOccupationI18n'))
                ->setQuery("SELECT {fields},contract_id FROM ".DomoprimeCustomerRequest::getTable(). 
                           " INNER JOIN ".DomoprimeCustomerRequest::getOuterForJoin('occupation_id').
                           " INNER JOIN ".DomoprimeOccupationI18n::getInnerForJoin('occupation_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
        while ($items=$db->fetchObjects())
        {                           
            if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                continue;
            $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeOccupation',$items->getDomoprimeOccupation());              
            $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeOccupationI18n',$items->getDomoprimeOccupationI18n());              
        } 
       } 
      }        
      
    }
    
    
    static function setConfigExport2ForContract(mfEvent $event)
    {                    
       if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;        
      /*  if (!$event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',false))
        {        
              //  $event->getSubject()->setObject('DomoprimeQuotationProduct');
                $event->getSubject()->getQuery()->left(DomoprimeQuotationProduct::getInnerForJoin('quotation_id')." AND ".DomoprimeQuotationProduct::getTableField('product_id')." =".CustomerContractProduct::getTableField('product_id'));                                  
                $event->getSubject()->getQuery()->groupby(DomoprimeQuotationProduct::getTableField('id'));
        }  */
      
           
    }
     
    
     static function setPager2ForMeeting2(mfEvent $event)
    {
        $pager=$event->getSubject();              
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;              
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_iso_meeting_list_request'))))
           return ;      
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeCustomerRequest::getFieldsAndKeyWithTable()." FROM ".DomoprimeCustomerRequest::getTable().                           
                           " WHERE ".DomoprimeCustomerRequest::getTableField('meeting_id')." IN(".$pager->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if ($db->getNumRows())
        {
           while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
           {                           
               if (!isset($pager->items[$item->get('meeting_id')]))
                   continue;
               $pager->items[$item->get('meeting_id')]->request=$item->loaded();         
           }   
        }       
    }
    
    static function setMeetingNewFormApi2(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;     
        $form=$event->getSubject();          
        if (!$form->getUser()->hasCredential(array(array('superadmin','api2_meeting_new_request'))))
           return ;         
        require_once __DIR__."/../../locales/Forms/DomoprimeCustomerRequestNewMeetingForm.class.php";      
        $form->embedForm('iso', new DomoprimeCustomerRequestNewMeetingForm($form->getUser()));                
    }
    
    static function setDataForContractApi2(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;     
        $formatter=$event->getSubject();      
        $request = new DomoprimeCustomerRequest($formatter->getValue());
        if ($request->isLoaded())
            $formatter->toArrayForApi2()->set('requests',$request->toArrayForApi2());             
    }
    
    
     static function setDataForContractHook(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('app_domoprime_iso'))
             return ;     
        $data=$event->getSubject();  //ServiceApplicationHookResponse         
        $request = new DomoprimeCustomerRequest($data->getContract());
        if ($request->isLoaded())
            $data->getData()->set('request',$request->toArrayForApi2());             
    }
}
