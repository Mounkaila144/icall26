<?php



class CustomerMeetingFormEvents  {
     
    static function setNewForm(mfEvent $event)
    {                  
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;         
         require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingNewForms.class.php";   
        // $defaults=mfConfig::get('mf_env')=='dev'?array('MUTUELLE'=>array('surface_wall'=>120,'numberofpeople'=>1,'revenue'=>20000)):array();            
         $form->embedForm('extra', new CustomerMeetingNewForms($form->getDefault('extra',array() /* CustomerMeetingForms::getDefaultsData()*/ )));        
    }
    
     static function setViewForm(mfEvent $event)
    {                  
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug_xxx','meeting_view_forms_integrated'))))
             return ;    
         require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingNewForms.class.php";   
        // $defaults=mfConfig::get('mf_env')=='dev'?array('MUTUELLE'=>array('surface_wall'=>120,'numberofpeople'=>1,'revenue'=>20000)):array();            
         $form->embedForm('extra', new CustomerMeetingNewForms($form->getDefault('extra',array() /* CustomerMeetingForms::getDefaultsData()*/ )));        
    }
   
    static function meetingChange(mfEvent $event)
    {              
        $meeting=$event->getSubject();        
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$meeting->getSite()) || !isset($event['form']))
             return ;         
        if (!$event['form']->hasValidator('extra')) // check if validator exists.
            return ;      
        if ($event['action']=='update' || $event['action']=='populate')
        {           
            $forms=new CustomerMeetingForms($meeting);             
        }   
        else
        {                        
            $forms=new CustomerMeetingForms();
            $forms->set('meeting_id',$meeting);    
            $contract = new CustomerContract($meeting);
            if ($contract->isLoaded())
                $forms->set('contract_id',$contract);        
        }               
        if ($event['form']->isValid())  // 
        {                       
          $forms->setData($forms->setCensoredData($event['form']['extra']->getValues()),$event['form']->getEmbeddedForm('extra')->getParameters());                                                        
          $forms->save();       
          if ($event['action']=='new')
          {    
            mfContext::getInstance()->getEventManager()->notify(new mfEvent($forms, 'meeting.form.new'));   // ??????          
          }
        }           
    }
    
    static function EmailParametersBuildForMeeting(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $meeting=$action->getParameter('meeting');
         $forms=new CustomerMeetingForms($meeting);        
         $action->meeting['forms']=$forms->getDataI18n();            
    }
    
    static function SmsParametersBuildForMeeting(mfEvent $event)
    {
        self::EmailParametersBuildForMeeting($event);
    }
    
    static function EmailParametersBuildForContract(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $contract=$action->getParameter('contract');           
         if ($contract->getMeeting()->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($contract->getMeeting());        
         $action->meeting['forms']=$forms->getDataI18n();                                   
    }
    
    static function SmsParametersBuildForContract(mfEvent $event)
    {
        self::EmailParametersBuildForContract($event);
    }
    
    
    static function filterConfigForMeeting(mfEvent $event)
    {
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
        $settings= CustomerMeetingFormsSettings::load();             
        if (!$settings->isAvailable())
            return ;
        $filter=$event->getSubject();
        
        foreach ($settings->get('display_columns') as $formfield)
        {            
            $filter->search->addValidator($formfield,new mfValidatorChoice(array('key'=>true,'required'=>false,"choices"=>array(""=>__(""))+CustomerMeetingFormUtils::getValuesFromFormfieldForSelect($formfield))));
            $filter->addField($formfield,'CustomerMeetingForms');
        }   
        
        foreach ($settings->get('filter_columns') as $formfield)
        {           
          $filter->in->addValidator($formfield,new mfValidatorChoice(array("choices"=>CustomerMeetingFormUtils::getFormFieldI18n($formfield,$filter->getConditions()),'multiple'=>true,'key'=>true,'required'=>false))); 
        }         
        // Query
        $filter->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                      
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').     
                       " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id'). 
                       " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND ".CustomerMeetingTypeI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeetingForms::getInnerForJoin('meeting_id').                      
                            $filter->getConditions()->getWhere().  
                       " GROUP BY ".CustomerMeeting::getTableField('id').
                       ";");
    }
    
    static function filterExecuteForMeeting(mfEvent $event)
    {
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
        $settings= CustomerMeetingFormsSettings::load();             
        if (!$settings->isAvailable())
            return ;        
        CustomerMeetingFormUtils::loadFormsDataFromPager($event->getSubject());        
    }    
    
    static function DocumentParametersBuild(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $meeting=$action->getParameter('meeting');            
         if ($meeting->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($meeting);        
         $action->meeting['forms']=$forms->getDataI18nForDocument();  // Change 4/5/17  
    }
    
      
    static function DocumentMultipleParametersBuild(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;     
         $meetings=$action->getParameter('collection'); 
      //   echo "===========================";
         
     /*   $meeting=$action->getParameter('meeting');   
         if ($meeting->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($meeting);        
         $action->meeting['forms']=$forms->getDataI18n();   */ 
    }
    
    
    static function setExportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;         
         // fields mfArray Class
        // $event->getSubject()->getFields()->merge(CustomerMeetingFormUtils::getFormsI18nForExport());      
         
         $event->getSubject()->getFields()->merge(CustomerMeetingFormUtils::getFormsI18nForExport2());      
    }
    
    static function DocumentParametersBuildForContract(mfEvent $event)
    {                      
         $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;          
         $contract=$action->contract_base;        
         if ($contract->getMeeting()->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($contract->getMeeting());            
         $action->meeting['forms']=$forms->getDataI18nForDocument();   
    }
    
    
      static function setImportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;            
         CustomerMeetingFormUtils::setFormsI18nForImport($event->getSubject());      
    }
    
    
      static function setImportData(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;   
           // Subject: Formulaire de l'import  Parameters: Meeting
          CustomerMeetingFormUtils::setDataForImport($event->getParameters(),$event->getSubject()->getValues());    
    }
    
    static function setExportQueryForMeeting(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;         
        $event->getSubject()->getQuery()->left(CustomerMeetingForms::getInnerForJoin('meeting_id'));
    }
    
    static function setExportQueryForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;       
        $event->getSubject()->setObject('CustomerMeetingForms');
        $event->getSubject()->getQuery()->left(CustomerMeetingForms::getTable()." ON ".CustomerMeetingForms::getTableField('contract_id')."=".CustomerContract::getTableField('id'));
    }
    
    
    static function SetServiceQueryForMeeting(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;         
        $event->getSubject()->getObjects()->push('CustomerMeetingForms');
        $event->getSubject()->getQueryString()->left(CustomerMeetingForms::getInnerForJoin('meeting_id'));
    }
    
    static function setServiceModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;
         // fields mfArray Class                  
          $event->getSubject()->getModel()->getFields()->merge(CustomerMeetingFormUtils::getFormsI18nForService());      
    }
    
    
    static function EmailParametersBuildForInstallerSchedule(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $schedule=$action->getParameter('schedule');    
         if ($schedule)
         {                       
            if ($schedule->getContract()->getMeeting()->isNotLoaded())
                 return ;         
            $meeting=$schedule->getContract()->getMeeting();
         }  
         else
         {
             $schedules=$action->getParameter('schedules');    
             if ($schedules)
             {    
                if ($schedules->getFirst()->getContract()->getMeeting()->isNotLoaded())
                    return ;  
                $meeting=$schedules->getFirst()->getContract()->getMeeting();
             }
             else
             {
                 return ;
             }    
         }    
         $forms=new CustomerMeetingForms($meeting);        
         $action->meeting['forms']=$forms->getDataI18n();                                   
    }        
    
    static function setUnhold(mfEvent $event)
    {                        
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;  
      //  if (!$contract->hasMeeting())
      //       return ;
        $forms=new CustomerMeetingForms($contract);   
        if ($forms->isNotLoaded())
           return ;
        $forms->setUnhold();
        $forms->save();
    }
    
    static function setHold(mfEvent $event)
    {                        
         $contract=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;      
        // if (!$contract->hasMeeting())
       //      return ;
        $forms=new CustomerMeetingForms($contract);   
        if ($forms->isNotLoaded())
           return ;
        $forms->setHold(); 
        $forms->save();
    }
    
        
    static function DocumentParametersBuildPdfForContract(mfEvent $event)
    {
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         if ($pdf->getContract()->isNotLoaded())
              return ;
      //   if ($pdf->getContract()->getMeeting()->isNotLoaded())
      //       return ;         
         $forms=new CustomerMeetingForms($pdf->getContract());            
         $pdf->getAction()->meeting['forms']=$forms->getDataI18nForDocumentPdf();    
      // echo "<pre>"; var_dump($pdf->getAction()->meeting['forms']) ; die(__METHOD__);       
         mfContext::getInstance()->getEventManager()->notify(new mfEvent($pdf->getAction()->meeting['forms'], 'meeting.document.form.build.values',array('pdf'=>$pdf)));                
    }
    
    static function contractChange(mfEvent $event)
    {                                 
        $contract=$event->getSubject();        
        if (!mfModule::isModuleInstalled('customers_meetings_forms',$contract->getSite()))
             return ;                           
        if ($event['action']=='to_contract')
        {                     
            $forms=new CustomerMeetingForms($contract->getMeeting());
            if ($forms->isLoaded())
            {    
                $forms->set('contract_id',$contract);
                $forms->save();
            }
        } 
        elseif ($event['action']=='new' && $event['form'] instanceof mfForm && $event['form']->isValid() && $event['form']->hasValidator('extra'))
        {                         
           $forms=new CustomerMeetingForms();
           $forms->set('contract_id',$contract);                                            
           $forms->set('meeting_id',$contract->hasMeeting()?$contract->getMeeting():null); 
           $forms->setData($forms->setCensoredData($event['form']['extra']->getValues())); //,$event['form']->getEmbeddedForm('extra')->getParameters());                                              
           $forms->set('is_hold',$contract->get('is_hold'));
           $forms->save();                          
        }
        elseif ($event['action']=='update' && $event['form'] && $event['form'] instanceof mfForm  && mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug_xxx','meeting_view_forms_integrated','contract_view_meeting_forms_partial_iso','contract_view_meeting_forms_partial_iso_optional'))))
        {                       
           $forms=new CustomerMeetingForms($contract);
           $forms->setData($forms->setCensoredData($event['form']['extra']->getValues())); 
           $forms->set('is_hold',$contract->get('is_hold'));
           $forms->save();   
        }            
    }
    
    
     static function setNewContractForm(mfEvent $event)
    {                   
         $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugX','contract_new_forms'))))       
            return ;
         require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingNewForms.class.php";   
           // $defaults=mfConfig::get('mf_env')=='dev'?array('MUTUELLE'=>array('surface_wall'=>120,'numberofpeople'=>1,'revenue'=>20000)):array();            
         $form->embedForm('extra', new CustomerMeetingNewForms($form->getDefault('extra',array() /* CustomerMeetingForms::getDefaultsData()*/ )));              
    }
    
    
     static function setViewContractPartialForm(mfEvent $event)
    {                   
        $form=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;              
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug_xx','contract_view_meeting_forms_partial_iso'))))
        {               
            require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingViewPartialFormsForContractForm.class.php";                    
            $form->embedForm('extra', new CustomerMeetingViewPartialFormsForContractForm(mfContext::getInstance()->getUser(),new mfArray(array('iso','poseur')),$form->getContract(),array('surface_comble'=>true,'surface_mur'=>true,'surface_plancher'=>true,'numberofpeople'=>true,'revenue'=>true,'nombre_foyers_fiscaux'=>true,'REFERENCEDELAVIS1'=>true,'NUMEROSFISCAL1'=>true),$form->getDefault('extra')));                            
        } 
        elseif (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug_xx','contract_view_meeting_forms_partial_iso_optional'))))
        {        
            require_once dirname(__FILE__)."/../../locales/Forms/CustomerMeetingViewPartialIsoAndOptionalFormsForContractForm.class.php";                    
            $form->embedForm('extra', new CustomerMeetingViewPartialIsoAndOptionalFormsForContractForm(mfContext::getInstance()->getUser(),new mfArray(array('iso','optional')),$form->getContract(),array('surface_comble'=>true,'surface_mur'=>true,'surface_plancher'=>true,'numberofpeople'=>true,'revenue'=>true,'nombre_foyers_fiscaux'=>true,'REFERENCEDELAVIS1'=>true,'NUMEROSFISCAL1'=>true),$form->getDefault('extra')));                            
        }
    }
    
    
    static function DocumentForContractParametersBuild(mfEvent $event)
    {
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;        
         $contract=$action->getParameter('contract');            
         if ($contract->isNotLoaded())
             return ;         
         $forms=new CustomerMeetingForms($contract);        
         $action->contract['forms']=$forms->getDataI18nForDocument();    
    }
        
    static function DocumentForContractsParametersBuild(mfEvent $event)
    {  // NO SITE 
        $action=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         CustomerMeetingForms::getFormsForDocumentForContracts($action);
    }
    
    static function SetMeetingsMultipleProcess(mfEvent $event)
    {  
         $multiple=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_forms',$multiple->getSite()))
             return ;                
        if (in_array('create_contract',$multiple->getActions()))
        {
             $db=new mfSiteDatabase();
                $db->setParameters(array())                
                ->setQuery("UPDATE ".CustomerMeetingForms::getTable(). 
                           " INNER JOIN ".CustomerMeetingForms::getOuterForJoin('meeting_id').                        
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " SET ".CustomerMeetingForms::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')".                                      
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite()); 
             //   echo $db->getQuery();
        }
    }
    
    static function setDataForContractImport(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
        // Subject: Formulaire de l'import  Parameters: Contract
        CustomerMeetingFormUtils::setDataForContractImport($event->getParameters(),$event->getSubject()->getValues());   
    }
    
    
    static function setDataForContractTransfer(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
        // Subject: CustomerContractMasterEngine        
        $engine=$event->getSubject();        
        $forms=new CustomerMeetingForms($engine->getContract(),$engine->getContract()->getSite());
        $engine->getValues()->set('forms',$forms->get('data'));        
    }
    
     static function setDataForMeetingTransfer(mfEvent $event)
    {                 
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;  
        // Subject: CustomerContractMasterEngine        
        $engine=$event->getSubject();        
        $forms=new CustomerMeetingForms($engine->getMeeting(),$engine->getMeeting()->getSite());
        $engine->getValues()->set('forms',$forms->get('data'));        
    }
    
      static function setDataForQuotation(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;           
         $action=$event->getSubject(); //app_domoprime_pdfAction                 
         if ($action->quotation_base->hasContract())
         {                
            $forms=new CustomerMeetingForms($action->quotation_base->getContract());            
            $action->contract['forms']=$forms->getDataI18nForDocument();    
         } 
         elseif ($action->quotation_base->hasMeeting())
         {
             $forms=new CustomerMeetingForms($action->quotation_base->getMeeting());            
             $action->meeting['forms']=$forms->getDataI18nForDocument();    
         }                      
    }
    
    
    static function setDataForBilling(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         $action=$event->getSubject(); // app_domoprime_pdfBillingAction
         if ($action->getParameter('billing')->hasContract())
         {                
            $forms=new CustomerMeetingForms($action->getParameter('billing')->getContract());            
            $action->billing['contract']['forms']=$forms->getDataI18nForDocument();    
         } 
         elseif ($action->getParameter('billing')->hasMeeting())
         {
             $forms=new CustomerMeetingForms($action->getParameter('billing')->getMeeting());            
             $action->billing['meeting']['forms']=$forms->getDataI18nForDocument();    
         }                      
    }
    
    static function setDataForContractMasterTransfer(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         $form=$event->getSubject();          
         $forms=new CustomerMeetingForms($form->getContract());   
         $forms->set('data',$form->getValue('forms'))->save();
    }
    
    static function setFormForContractMasterTransfer(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         $form=$event->getSubject();          
         $form->setValidator('forms',new mfValidatorString(array('required'=>false)));
         
    }
    
    static function setDataForMeetingMasterTransfer(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         $form=$event->getSubject();          
         $forms=new CustomerMeetingForms($form->getMeeting());   
         $forms->set('data',$form->getValue('forms'))->save();
    }
    
    static function setFormForMeetingMasterTransfer(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         $form=$event->getSubject();          
         $form->setValidator('forms',new mfValidatorString(array('required'=>false)));         
    }       
    
    static function setServiceContractFilterConfig(mfEvent $event)
    {                  
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;
        //var_dump($event->getSubject()->getDefault('fields'));
        // CustomerContractsServicesFormFilter    
        $event->getSubject()->getMfQuery()->left(CustomerMeetingForms::getInnerForJoin('contract_id'));  
       // $event->getSubject()->getObjectsForPager()->push('CustomerMeetingForms');  
        $event->getSubject()->getObjectsForPager()->push('CustomerMeetingForms');              
        $event->getSubject()->getModel()->getFields()->merge(CustomerMeetingFormUtils::getFormsI18nWithNamespaceForService('forms'));         
    }
    
    static function setFormsContractForPager(mfEvent $event)
    {                  
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('customers_meetings_forms_contract_list_data','superadmin_debugx'))))
            return ;
        // Pager
         CustomerMeetingFormUtils::loadFormsDataFromContractPager($event->getSubject());        
    }    
    
    static function setContractFilterConfig(mfEvent $event)
    {                  
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('customers_meetings_forms_contract_list_data','superadmin_debugx'))))
            return ;        
        $event->getSubject()->getMfQuery()->left(CustomerMeetingForms::getInnerForJoin('contract_id'));        
        $event->getSubject()->getObjectsForPager()->push('CustomerMeetingForms');     
    } 
    
    
    static function setFormsMeetingForPager(mfEvent $event)
    {           
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('customers_meetings_forms_meeting_list_data','superadmin_debugx'))))
            return ;
        // Pager
         CustomerMeetingFormUtils::loadFormsDataFromMeetingPager($event->getSubject());        
    }    
    
    static function setMeetingFilterConfig(mfEvent $event)
    {                      
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
            return ;
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('customers_meetings_forms_meeting_list_data','superadmin_debugx'))))
            return ;
        /*$query= str_replace("FROM ".CustomerMeeting::getTable(),
                            " FROM ".CustomerMeeting::getTable().
                            " LEFT JOIN ".CustomerMeetingForms::getInnerForJoin('meeting_id'),  
                            $event->getSubject()->__getQuery());*/
        $event->getSubject()->getMfQuery()->left(CustomerMeetingForms::getInnerForJoin('meeting_id'));
        $event->getSubject()->addObject('CustomerMeetingForms');     
    } 
    
    
    static function DocumentParametersBuildPdfForMeeting(mfEvent $event)
    {
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                 
         if ($pdf->getContract()->isNotLoaded())
              return ;
      //   if ($pdf->getContract()->getMeeting()->isNotLoaded())
      //       return ;         
         $forms=new CustomerMeetingForms($pdf->getMeeting());            
         $pdf->getAction()->meeting['forms']=$forms->getDataI18nForDocumentPdf();    
      // echo "<pre>"; var_dump($pdf->getAction()->meeting['forms']) ; die(__METHOD__);       
         mfContext::getInstance()->getEventManager()->notify(new mfEvent($pdf->getAction()->meeting['forms'], 'meeting.document.form.build.values'));                   
    }
    
    
     static function setDataForWorksQuotation(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;           
         $action=$event->getSubject(); //app_domoprime_pdfAction                 
         if ($action->getParameter('quotation')->hasContract())
         {                
            $forms=new CustomerMeetingForms($action->getParameter('quotation')->getContract());            
            $action->contract['forms']=$forms->getDataI18nForDocument();    
         } 
         elseif ($action->getParameter('quotation')->hasMeeting())
         {
             $forms=new CustomerMeetingForms($action->getParameter('quotation')->getMeeting());            
             $action->meeting['forms']=$forms->getDataI18nForDocument();    
         }                      
    }
    
       static function setDataForWorksBilling(mfEvent $event)
    {         
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;           
         $action=$event->getSubject(); //app_domoprime_pdfAction                 
         if ($action->getParameter('billing')->hasContract())
         {                
            $forms=new CustomerMeetingForms($action->getParameter('billing')->getContract());            
            $action->contract['forms']=$forms->getDataI18nForDocument();    
         } 
         elseif ($action->getParameter('billing')->hasMeeting())
         {
             $forms=new CustomerMeetingForms($action->getParameter('billing')->getMeeting());            
             $action->meeting['forms']=$forms->getDataI18nForDocument();    
         }                      
    }
    
    
    static function setDataExport2ForContract(mfEvent $event)
    {           
       $export=$event->getSubject();      
       if (!mfModule::isModuleInstalled('customers_meetings_forms', $export->getSite()))
             return ;                     
       if (!$export->getFormat()->getSchema()->getNames()->glob('customer.meeting.forms*'))
           return ;    
       
   //    return ;
       
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".CustomerMeetingForms::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingForms::getTable().                           
                           " WHERE ".CustomerMeetingForms::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('CustomerMeetingForms'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('CustomerMeetingForms',$item);              
            } 
         } 
       
    }
    
    
    static function setParametersPdfForMeeting(mfEvent $event)
    {
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;                               
         $forms=new CustomerMeetingForms($pdf->getMeeting());            
         $pdf->getAction()->meeting['forms']=$forms->getDataI18nForDocumentPdf();    
      // echo "<pre>"; var_dump($pdf->getAction()->meeting['forms']) ; die(__METHOD__);       
       //  mfContext::getInstance()->getEventManager()->notify(new mfEvent($pdf->getAction()->meeting['forms'], 'meeting.document.form.build.values'));                   
    }
    
    
     static function setDataForContractHook(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;     
        $data=$event->getSubject();  //ServiceApplicationHookResponse         
        $forms=new CustomerMeetingForms($data->getContract());            
        if ($forms->isLoaded())
            $data->getData()->set('forms',mfArray::create($forms->getDataI18nForDocumentApi()));             
    }
    
    static function setDataForContractApi2(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;    
        $forms=new CustomerMeetingForms($event->getSubject()->getValue());          
        $event->getSubject()->toArrayForApi2()->set('forms',$forms->getDataI18nForDocumentApi()); 
    }
    
     static function setDataForMeetingApi2(mfEvent $event)
    {                        
        if (!mfModule::isModuleInstalled('customers_meetings_forms'))
             return ;           
        $forms=new CustomerMeetingForms($event->getSubject()->getValue());           
        $event->getSubject()->toArrayForApi2()->set('forms',$forms->getDataI18nForDocumentApi()); 
    }
    
   
}
