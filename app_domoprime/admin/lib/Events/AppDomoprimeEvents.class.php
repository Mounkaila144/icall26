<?php



class AppDomoprimeEvents  {
     
    static function updateForm(mfEvent $event)
    {                     
         $form_result=$event->getSubject();
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;       
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
             return ;
         try
         {
         $form_result->getCustomerMeeting()->domoprimeEngine=new DomoprimeEngine($form_result);
         $form_result->getCustomerMeeting()->domoprimeEngine->process();
         }
         catch (mfException $e)
         {
             // Remove last calculation
              // $report=new DomoprimeCalculation($contract);
              //  $report->release();
         }
    }
   
    static function setExportModel(mfEvent $event)
    {                  
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
         // fields mfArray Class         
         $event->getSubject()->getFields()->merge(DomoprimeExport::getFieldsForExport());        
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin','contract_export_dictionary_quotation_engine5'))))
            $event->getSubject()->getFields()->merge(DomoprimeEngine5QuotationExport::getFieldsForExport());        
    }
    
    static function setExportQuery(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;            
        $event->getSubject()->getQuery()               
                ->left(DomoprimeCalculation::getInnerForJoin('contract_id'). " AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                ->left(DomoprimeProductCalculation::getInnerForJoin('calculation_id'));  
         if (CustomerContractSettings::load($event->getSubject()->getSite())->hasPolluter())
        {    
            $event->getSubject()->getQuery()->left(DomoprimeCalculation::getOuterForJoin('polluter_id')) ;
            $event->getSubject()->setObject('PartnerPolluterCompany');
        }
         $event->getSubject()->setObject('DomoprimeCalculation');
       $event->getSubject()->setObject('DomoprimeProductCalculation');
    }
    
    static function meetingTransfert(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;                           
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin','admin','app_domoprime_transfert_authorized'))))
            return ;                
        $meeting=$event->getSubject();        
        if (DomoprimeSettings::load($meeting->getSite())->get('calculation_on_meeting_save')=='NO')
            return ;
        $calculation=new DomoprimeCalculation($meeting);                   
        if ($calculation->isRefused() || !$calculation->isAccepted() || $calculation->isNotLoaded())
        {                
            $meeting->set('state_id',CustomerMeetingSettings::load()->getStatusByDefault());
            $meeting->save();
            if ($calculation->isNotLoaded())
                 throw new mfException(__("The meeting can not be transferred due to calculation doesn't exist.",array(),'messages','app_domoprime'));
            throw new mfException(__("The meeting can not be transferred due to calculation is refused or not validated.",array(),'messages','app_domoprime'));
        }
    }
    
    
     static function setExportQueryForContract(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
        if (mfcontext::getInstance()->getUSer()->hasCredential([['app_domoprime_contract_export_default_no_calculation']]))
            return ;       
              
      
        if (!$event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',true))
        {                   
            $event->getSubject()->getQuery()->left(DomoprimeCalculation::getTable()." ON ".DomoprimeCalculation::getTableField('contract_id')."=".CustomerContract::getTableField('id')." AND ".DomoprimeCalculation::getTableField('isLast')."='YES'");            
            if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin','contract_export_dictionary_quotation_engine5'))))
            {                 
                $event->getSubject()->setObject('DomoprimeQuotation');                             
                $event->getSubject()->getQuery()->left(DomoprimeQuotation::getInnerForJoin('contract_id')." AND ".DomoprimeQuotation::getTableField('is_last')."='YES'");                                       
             //    $event->getSubject()->setObject('DomoprimeQuotationProduct');   // for debug 
             //   $event->getSubject()->getQuery()->left(DomoprimeQuotationProduct::getInnerForJoin('quotation_id')); // for debug 
                
            }           
            $event->getSubject()->setObject('DomoprimeBilling');
            $event->getSubject()->getQuery()->left(DomoprimeBilling::getInnerForJoin('contract_id')." AND ".DomoprimeBilling::getTableField('is_last')."='YES'"); 
            return ;
        }            
         
        $event->getSubject()->setObject('DomoprimeCalculation');
        $event->getSubject()->setObject('DomoprimeClass');
        $event->getSubject()->setObject('DomoprimeProductCalculation');  // for debug 
        $event->getSubject()->setObject('DomoprimeClassI18n');
        if ($event->getSubject()->getFormat()->getSchema()->in(['app.domoprime.class.energy.sector','app.domoprime.sector.name','app.domoprime.energy.name','app.domoprime.energy.value']))
        {        
            $event->getSubject()->setObject('DomoprimeEnergy');
            $event->getSubject()->setObject('DomoprimeSector');
            $event->getSubject()->setObject('DomoprimeEnergyI18n');
        }         
        $query=$event->getSubject()->getQuery();     
         
        $query->left(DomoprimeCalculation::getTable()." ON ".DomoprimeCalculation::getTableField('contract_id')."=".CustomerContract::getTableField('id'))                            
              ->left(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))                         
              ->left(DomoprimeCalculation::getOuterForJoin('class_id'))
              ->left(DomoprimeCalculation::getOuterForJoin('energy_id'))             
              ->left(DomoprimeClassI18n::getInnerForJoin('class_id')." AND ".DomoprimeClassI18n::getTableField('lang')."='{lang}'")             
               ->where(DomoprimeCalculation::getTableField('isLast')."='YES'")
               ->where(DomoprimeProductCalculation::getTableField('surface')." > 0")
               ->where(DomoprimeProductCalculation::getTableField('product_id')."=".CustomerContractProduct::getTableField('product_id'))
             ->groupBy(DomoprimeProductCalculation::getTableField('id'));
         
        $event->getSubject()->setObject('DomoprimeQuotation');
        $event->getSubject()->setObject('DomoprimeQuotationProductItem');      
        $event->getSubject()->setObject('ProductItem');
        
        $query->left(DomoprimeQuotation::getInnerForJoin('contract_id')." AND ".DomoprimeQuotation::getTableField('is_last')."='YES'");        
        $query->left(DomoprimeQuotationProduct::getInnerForJoin('quotation_id')." AND ".
                        "(".DomoprimeQuotationProduct::getTableField('product_id')." = ".CustomerContractProduct::getTableField('product_id').
                            " OR ".DomoprimeQuotationProduct::getTableField('product_id')." != ".DomoprimeProductCalculation::getTableField('product_id').
                        ")"
                    );
            
        // AND (t_domoprime_quotation_product.product_id =t_customers_contract_product.product_id OR t_domoprime_quotation_product.product_id != t_domoprime_product_calculation.product_id)
        $query->left(DomoprimeQuotationProductItem::getInnerForJoin('quotation_product_id'));
        $query->left(DomoprimeQuotationProductItem::getOuterForJoin('item_id'));

        $event->getSubject()->setObject('DomoprimeBilling');
        $query->left(DomoprimeBilling::getInnerForJoin('contract_id')." AND ".DomoprimeBilling::getTableField('is_last')."='YES'"); 
        if ($event->getSubject()->getFormat()->getSchema()->in(['app.domoprime.class.energy.sector','app.domoprime.energy.name','app.domoprime.energy.value']))
        { 
            $query->left(DomoprimeCalculation::getOuterForJoin('sector_id'));
            $query->left(DomoprimeEnergyI18n::getInnerForJoin('energy_id')." AND ".DomoprimeEnergyI18n::getTableField('lang')."='{lang}'");
        }
       // echo "<pre>"; var_dump($query->getLeft()); die(__METHOD__);
      //  echo "<pre>"; echo $query; die(__METHOD__);
    }
    
    static function setContractsMultipleFormConfig(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;       
        $form=$event->getSubject();       
        $user=mfContext::getInstance()->getUser();
        if ($user->hasCredential(array(array('superadmin','admin','contract_multiple_generate_cumac'))))
            $form->getActions()->push('generate_cumac');
        if ($user->hasCredential(array(array('superadmin','admin','contract_multiple_generate_billings'))))
            $form->getActions()->push('generate_billings');  
        if ($user->hasCredential(array(array('superadmin','admin','contract_multiple_delete_cumac'))))
            $form->getActions()->push('delete_cumac');  
        if ($user->hasCredential(array(array('superadmin'))))
            $form->getActions()->push('quotation_contract');  
    }
    
    static function SetContractsMultipleProcess(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;               
        $multiple=$event->getSubject();
        if (in_array('generate_cumac',$multiple->getActions()))
        {                     
            $multiple->getMessages()->push(__("Cumac has been generated."));
            DomoprimeCalculation::generateCalculationForContracts($multiple);
        }
        if (in_array('generate_billings',$multiple->getActions()))
        {                                 
            $number_of_billings=DomoprimeBilling::generateBillingsForContracts($multiple);
            $multiple->getMessages()->push(__("%s billings have been generated.",$number_of_billings,'messages','app_domoprime'));
        }
        if (in_array('delete_cumac',$multiple->getActions()))
        {                                 
            DomoprimeCalculation::deleteForContracts($multiple);
            $multiple->getMessages()->push(__("Calculations have been deleted.",[],'messages','app_domoprime'));
        }
    }
    
    static function SetVariablesForFormDocument(mfEvent $event)
    {
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;               
        $action=$event->getSubject();
        $contract=$action->contract_base;
        $calculation= new DomoprimeCalculation($contract);             
        if ($calculation->isNotLoaded())
            throw new mfException(__("Cumac calculation is missing.",array(),'messages','app_domoprime'));
        $action->calculation=$calculation->toArrayForDocument();
        // Take last quotation
        $quotation=new DomoprimeQuotation($contract,$contract->getSite());
        if ($quotation->isLoaded())
        {    
            $action->quotation=$quotation->toArrayForQuotation();   
            $action->quotation['created_at']=CustomerModelEmailI18n::format_date($quotation->get('created_at'));  
            $action->quotation['dated_at']=CustomerModelEmailI18n::format_date($quotation->get('dated_at'));  
            $action->quotation['products']=$quotation->getProductsWithItems()->toArrayForQuotation();
        }      
        // Take last billing
        $billing= new DomoprimeBilling($contract,$contract->getSite());
        if ($billing->isLoaded())
        {    
            $action->billing=$billing->toArrayForBilling();   
            $action->billing['created_at']=CustomerModelEmailI18n::format_date($billing->get('created_at'));  
            $action->billing['dated_at']=CustomerModelEmailI18n::format_date($billing->get('dated_at')); 
            $action->billing['products']=$billing->getProductsWithItems()->toArrayForBilling();      
        }
    }
    
    
    static function multipleDocumentExport(mfEvent $event)
    {               
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;            
        $form=$event->getSubject();
        $form->addActions(array('domoprime_export_pdf','domoprime_billing_pdf','domoprime_quotation_pdf'));        
    }
    
     static function contractChange(mfEvent $event)
    {                
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $contract->getSite()))
             return ;
      //  $action=$event->getParameters();
        // affect contract in quotation and cumac calculation
        if ($event['action']=='to_contract')
        {
            DomoprimeQuotation::setContractForQuotationsFromMeeting($contract);                    
            DomoprimeCalculation::setContractForCalculationsFromMeeting($contract);            
        } 
        if (in_array($event['action'],array('to_contract','new')) && mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_schedule_installations_creation'))))
        {                      
            // Create installation products          
            $forms=new CustomerMeetingForms($contract->getMeeting());
            if ($forms->isNotLoaded())
               return ;
            $settings=DomoprimeSettings::load($contract->getSite());
            $products=new mfArray();
            foreach ($settings->getSurfaceForFieldByProducts() as $product_id=>$surface_formfield)
            {
                if ($surface=$forms->getDataFromFormField($surface_formfield))
                {
                    $products[]=$product_id;
                }                        
            }    
            ProductInstallerScheduleUtils::createInstallationsByProductsFromContract($contract,$products);
        }             
        if (in_array($event['action'],array('update')))
        {       
           if (DomoprimeSettings::load($contract->getSite())->get('calculation_on_contract_save')=='NO')
               return ;
           if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
              return ;
           if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_iso_no_cumac_generation'))))
              return ;          
           try
           {                          
                $engine=new DomoprimeEngine($contract);
                $engine->process();                                    
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
    
    
  /*   static function meetingChange(mfEvent $event)
    {                
        $meeting=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $meeting->getSite()))
             return ;
                 
        if (in_array($event['action'],array('update','new')))
        {       
           if (DomoprimeSettings::load($meeting->getSite())->get('calculation_on_meeting_save')=='NO')
               return ;          
           try
           {
                $engine=new DomoprimeEngine($meeting);
                $engine->process();                                    
                $report=new DomoprimeCalculation($engine);
                $report->process(mfcontext::getInstance()->getUser()->getGuardUser());    
           }
           catch (mfException $e)
           {
               
           }
        } 
    }*/
    
    static function getSurfacesForPager(mfEvent $event)
    {       
       $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $pager->getSite()))
             return ;
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('app_domoprime_contract_list_surfaces','app_domoprime_contract_list_surface_101','app_domoprime_contract_list_surface_102','app_domoprime_contract_list_surface_103'))))
           return ;
       if (!$pager->hasItems())
            return null;
        $settings=new DomoprimeSettings(null,$pager->getSite());
        $products_for_surfaces=$settings->getSurfaceNamesForProducts();
        $contracts=new mfArray($pager->getkeys());
        foreach ($pager as $item)
            $item->contract_products=new CustomerContractProductCollection(null,$pager->getSite());;
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContractProduct'))
                ->setQuery("SELECT {fields} FROM ".CustomerContractProduct::getTable().                          
                           " WHERE ".CustomerContractProduct::getTableField('contract_id')." IN(".$contracts->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
      //  SystemDebug::getInstance()->addMessage($db->getQuery()); 
        if (!$db->getNumRows())
            return ;        
        while ($items=$db->fetchObjects())
        {                                
            $pager->items[$items->getCustomerContractProduct()->get('contract_id')]->contract_products[$products_for_surfaces[$items->getCustomerContractProduct()->get('product_id')]]=$items->getCustomerContractProduct();
        }             
    } 
    
    static function getQmacForPager(mfEvent $event)
    {       
        $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $pager->getSite()))
             return ;     
        if (!$pager->hasItems())
            return null;
        $contracts=new mfArray($pager->getkeys());
        foreach ($pager as $item)
            $item->calculation=null; 
        $query="";
        $objects=array('DomoprimeCalculation','CustomerContract');
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_list_calculation_class_pager'))))
        {
            $query= " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('class_id').  
                    " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id')." AND " .DomoprimeClassI18n::getTableField('lang')."='{lang}'";
            $objects[]='DomoprimeClassI18n';
            $objects[]='DomoprimeClass';
        }           
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getLanguage()))
                ->setObjects($objects)
                ->setQuery("SELECT {fields} FROM ".DomoprimeCalculation::getTable().  
                           " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('contract_id').
                          $query.                      
                           " WHERE ".CustomerContract::getTableField('id')." IN(".$contracts->implode(",").") AND ".                         
                                  DomoprimeCalculation::getTableField('isLast')."='YES'" .
                           ";")               
                ->makeSiteSqlQuery($pager->getSite());  
     //   SystemDebug::getInstance()->addMessage($db->getQuery());                 
        if (!$db->getNumRows())
            return ;        
        while ($items=$db->fetchObjects())
        {                                
            $item=$items->getDomoprimeCalculation();
            if ($items->hasDomoprimeClass())                
                $item->set('class_id',$items->getDomoprimeClass());
            if ($items->hasDomoprimeClassI18n())                
                $item->getClass()->setI18n($items->getDomoprimeClassI18n());          
            $pager->items[$items->getCustomerContract()->get('id')]->calculation=$item;
        }                  
    }
    
     static function getSurfacesFromFormsForPager(mfEvent $event)
    {       
       $pager=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $pager->getSite()))
             return ;
       if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugXX','app_domoprime_contract_list_surfaces_from_forms','app_domoprime_contract_list_surface_from_forms_101','app_domoprime_contract_list_surface_from_forms_102','app_domoprime_contract_list_surface_from_forms_103'))))
           return ;
       if (!$pager->hasItems())
            return null;
        $settings=new DomoprimeSettings(null,$pager->getSite());      
        $settings->loadSurfacesFromFields();
        $contracts=new mfArray($pager->getkeys());
        foreach ($pager as $item)
            $item->surfaces=new DomoprimeSurfaceCollection();
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerMeetingForms','CustomerContract'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeetingForms::getTable().  
                           " INNER JOIN ".CustomerMeetingForms::getOuterForJoin('contract_id').
                        //   " INNER JOIN ".CustomerMeetingForms::getOuterForJoin('meeting_id').
                         //  " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN(".$contracts->implode(",").")".                         
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return ;        
        while ($items=$db->fetchObjects())
        {               
            $pager->items[$items->getCustomerContract()->get('id')]->surfaces->merge($items->getCustomerMeetingForms()->getDataFromFormFields($settings->getSurfacesFromFields()));
        }           
    } 
    
    
    static function DocumentParametersBuildFormValuesForContract(mfEvent $event)
    {    /* ================ NO SITE ============= */   
         $values=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;                          
         $settings= new DomoprimeSettings();                     
         $iso_field=$settings->getEnergyFormField()->getForm()->get('name');
         $energy_field=$settings->getEnergyFormField()->get('name');
         if (isset($values[$iso_field][$energy_field]) && $values[$iso_field][$energy_field] instanceof CustomerMeetingExportFormField)
         {                               
            $values[$iso_field][$energy_field]['electricity']=$values[$iso_field][$energy_field]['value'] == $settings->get('energy_electricity')?"1":"0";                                     
         }  
         
         
         
    }
    
     static function SetVariablesForFormDocumentPdf(mfEvent $event)
    {         // $settings=DomoprimeSettings::load($quotation->getSite());
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('app_domoprime',$pdf->getSite()))
             return ;                              
          $calculation= new DomoprimeCalculation($pdf->getContract());       
        $pdf->getAction()->calculation=$calculation->toArrayForDocumentPdf();          
        $pdf->getAction()->contract['master_reference']=$pdf->getContract()->get('id')."-".$pdf->getContract()->get('customer_id')."-".$pdf->getContract()->getCustomer()->getAddress()->get('postcode');
        $quotation=new DomoprimeQuotation($pdf->getContract(),$pdf->getSite());
        if ($quotation->isLoaded())
        {    
            $pdf->getAction()->quotation=$quotation->toArrayForPdf();   
            $pdf->getAction()->quotation['created_at']=CustomerMeetingFormDocumentParameters::format_date($quotation->get('created_at'));  
            $pdf->getAction()->quotation['dated_at']=CustomerMeetingFormDocumentParameters::format_date($quotation->get('dated_at'));  
            $pdf->getAction()->quotation['products']=$quotation->getProductsWithItems()->toArrayForQuotation();
            $pdf->getAction()->quotation['restincharge']= DomoprimeSettings::load($pdf->getSite())->getRestInCharge(); 
            $pdf->getAction()->master=$quotation->getProductsWithItems()->hasMaster()?$quotation->getProductsWithItems()->getMaster()->toArrayForQuotation():"";                                                                                               
        }           
        // Take last billing
        $billing= new DomoprimeBilling($pdf->getContract(),$pdf->getSite());
        if ($billing->isLoaded())
        {    
            $pdf->getAction()->billing=$billing->toArrayForPdf();   
            $pdf->getAction()->billing['created_at']=CustomerMeetingFormDocumentParameters::format_date($billing->get('created_at'));  
            $pdf->getAction()->billing['dated_at']=CustomerMeetingFormDocumentParameters::format_date($billing->get('dated_at')); 
            $pdf->getAction()->billing['products']=$billing->getProductsWithItems()->toArrayForBilling();      
            $pdf->getAction()->billing['restincharge']= DomoprimeSettings::load($pdf->getSite())->getRestInCharge(); 
        }
        
        // Adder       
       // Mettre permission documents 
        $forms=new CustomerMeetingForms($pdf->getContract());   
        // meeting.forms.iso.numberofpeople
        // meeting.forms.iso.noms_prenoms_declarants
        // meeting.forms.iso.nombre_foyers_fiscaux
        if ($calculation->getClass()->get('name') == 1)
        {              
            // tres modest
            $pdf->getAction()->extra=array(
             //   'class'=>1,
                'verymodest'=>array(                    
                    'numberofpeople'=>$forms->getDataFromFieldname('iso','numberofpeople'),
                    'noms_prenoms_declarants'=>$forms->getDataFromFieldname('iso','noms_prenoms_declarants'),
                    'nombre_foyers_fiscaux'=>$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux'),
                    'nombre_foyers_fiscaux_sup_1'=>$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux') > 1?$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux'):"",
                )
            );
                        
        }   
        elseif ($calculation->getClass()->get('name') == 0)
        {            
            // modest
            $pdf->getAction()->extra=array(
             //   'class'=>0,
                'modest'=>array(
                    'numberofpeople'=>$forms->getDataFromFieldname('iso','numberofpeople'),
                    'noms_prenoms_declarants'=>$forms->getDataFromFieldname('iso','noms_prenoms_declarants'),
                    'nombre_foyers_fiscaux'=>$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux'),
                    'nombre_foyers_fiscaux_sup_1'=>$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux') > 1?$forms->getDataFromFieldname('iso','nombre_foyers_fiscaux'):"",
                )
            );                      
        }              
    }
    
    static function MeetingFormDocumentPdfArchive(mfEvent $event)
    {         
         $pdf=$event->getSubject(); // CustomerMeetingFormDocumentFromPDF Or  CustomerMeetingFormDocumentPDF
         if (!mfModule::isModuleInstalled('app_domoprime',$pdf->getSite()))
             return ;                       
        if (DomoprimeSettings::load($pdf->getSite())->get('ah_archivage')=='YES')
          {                       
            $archive=new CustomerDocument();
            $archive->createDocument($pdf->getContract()->getCustomer(),$pdf->getDocument()->get('name'),$pdf->getDocument()->getName(),$pdf->getFile());                              
          }
        
    }
    
    static function MeetingFormUpdate(mfEvent $event)
    {                
        $forms=$event->getSubject();  // CustomerMeetingForms
      //  $forms=new CustomerMeetingForms();
        if (!mfModule::isModuleInstalled('app_domoprime', $forms->getSite()))
             return ;                
        if (DomoprimeSettings::load($forms->getSite())->get('calculation_on_meeting_save')=='NO')
               return ;    
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
             return ;
        try
        {
            $engine=new DomoprimeEngine($forms);        
            $engine->process();                                    
            $report=new DomoprimeCalculation($engine);
            $report->process(mfcontext::getInstance()->getUser()->getGuardUser());   
        }
        catch (mfException $e)
        {
             // Remove last calculation
                $report=new DomoprimeCalculation($forms->hasContract()?$forms->getContract():$forms->getMeeting());
                $report->release();
        }
    }
    
    static function CustomerAddressUpdateForContract(mfEvent $event)
    {                
        $contract=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime', $contract->getSite()))
             return ;     
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_no_cumac_generation'))))
             return ;
        try
        {
          //  $engine=new DomoprimeEngine($contract);        
          //  $engine->process();     
            
            $engine=DomoprimeCumacEngine::getInstance()->getEngine($contract);
            $engine->process();  
                
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
    
    static function setFilterForContract(mfEvent $event)
    {
        $filter=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;     
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_filter_cumac_status'))))
           return ;
        if ($filter instanceof CustomerContractsFormFilter)     
        {    
        $filter->getMfQuery()->left(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".
                                        DomoprimeCalculation::getTableField("isLast='YES'")
                            );          
        }
        if ($filter instanceof CustomerContractsFormFilter2)        
           $filter->getMfQuery()->left(CustomerContract::getOuterForJoin('polluter_id'));             
        $filter->equal->addValidator("domoprime_status",new mfValidatorChoice(array("choices"=>array(''=>__(''),'IS_NULL'=>__("Not calculated",array(),'messages','app_domoprime'),'ACCEPTED'=>__("ACCEPTED",array(),'messages','app_domoprime'),'REFUSED'=>__('REFUSED',array(),'messages','app_domoprime')),'key'=>true,'required'=>false)));      
        $filter->addField('domoprime_status',array( 'class'=>'DomoprimeCalculation','name'=>'status'));       
       // $filter->cols->getChoices()->push('domoprime_status');
       // $filter->sizes->addValidator('domoprime_status',new mfValidatorInteger(array("required"=>false)));
    }
    
    static function setVariablesForQuotation(mfEvent $event)
    {
        $action=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;     
        $quotation=$action->quotation_base;        
        if ($quotation->hasMeeting() && $quotation->getMeeting()->hasPolluter())
       {                               
           $polluter_recipient= new DomoprimePolluterRecipient($quotation->getMeeting()->getPolluter());                                                      
       }
      if ($quotation->hasContract() && $quotation->getContract()->hasPolluter())
       {             
           $polluter_recipient= new DomoprimePolluterRecipient($quotation->getContract()->getPolluter());              
       }
       if ($polluter_recipient && $polluter_recipient->isLoaded())
       {
            $action->recipient=$polluter_recipient->getRecipient()->toArrayForDocument();   
       }          
    }
    
    
    static function setOptionsForContractsExport(mfEvent $event)
    {        
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;                 
        $formFilter=$event->getSubject();
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contracts_list_export_options_cumac'))))
                return ;                    
        
        if (!$formFilter->hasDefaults())
            $formFilter->setDefault(array_merge($formFilter->getDefault(),array('with_cumac'=>true)));
        $formFilter->options->addValidator('with_cumac',new mfValidatorBoolean(array()));    
        if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_export_with_details'))))
            $formFilter->options->addValidator('with_details',new mfValidatorBoolean(array()));     
    }
    
    
    static function setFilterOptionsForContractExport(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;          
        $formFilter=$event->getSubject();        
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contracts_list_export_options_cumac'))))
                return ;            
        $formFilter->options->addValidator('with_cumac',new mfValidatorBoolean(array())); 
        if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_export_with_details'))))
            $formFilter->options->addValidator('with_details',new mfValidatorBoolean(array()));  
        $options= $formFilter->getDefault('options');
        if (!isset($options['with_cumac']))          
            $formFilter->setDefault('options',array_merge((array)$options,array('with_cumac'=>true)));                
    }
    
    static function setCheckerForPreMeeting(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;          
        $contract=$event->getSubject();        
      //  if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contracts_list_export_options_cumac'))))
      //          return ;                     
      //   echo "Premmeting";
    }
    
    static function setFilterQuotationForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;          
        if (!mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_contract_list_has_quotation'))))
            return ;       
        $filter=$event->getSubject();        
        $filter->getMfQuery()->left(DomoprimeQuotation::getInnerForJoin('contract_id')." AND ".DomoprimeQuotation::getTableField("is_last='YES'")) ;          
        $filter->setValidator("has_quotation",new mfValidatorBoolean());  
        $filter->equal->setValidator("has_quotation",new mfValidatorChoice(array('required'=>false,'choices'=>array('','IS_NULL','IS_NOT_NULL'))));  
        $filter->addField('has_quotation',array( 'class'=>'DomoprimeQuotation','name'=>'id'));
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debugxxx','app_domoprime_contract_list_has_quotation_default_true'))))            
            $filter->setDefault('has_quotation',true); 
    }
    
   /* static function setFilterQueryQuotationForContract(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;          
        if (!mfCOntext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))))
            return ;
        $filter=$event->getSubject();        
        if ($event['values']['has_quotation'])
        {          
            echo "++";
           $event['values']['equal']['has_quotation']="IS_NOT_NULL" ;
        }     
       // var_dump($event['values']['equal']['has_quotation']); echo "----------------------------------------------<br/>";
    }*/
    
    static function setValidateInstallerExport(mfEvent $event)
    {                   
        $action=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
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
        $token->create('AppDomoprimeInstallerExport',__('Link for contract installer export'),url_to("app_domoprime",array('action'=>'ExportForInstallers'))."?".$action->getRequest()->getGetParametersForUrl(),$action->getUser()->getGuardUser());               
        $action->getRequest()->addRequestParameter('token',$token);
        $action->forward('users','SendValidation');
    }
    
    static function setFieldsForContractExport(mfEvent $event)
    {                   
        $texts=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
        $texts->merge(DomoprimeExport::getFieldsForExport());        
    }
    
    
    static function setVariablesForFormDocumentPdfForMeeting(mfEvent $event)
    {         // $settings=DomoprimeSettings::load($quotation->getSite());
         $pdf=$event->getSubject(); //CustomerMeetingFormDocumentFromPdf
         if (!mfModule::isModuleInstalled('app_domoprime',$pdf->getSite()))
             return ;                              
          $calculation= new DomoprimeCalculation($pdf->getMeeting());       
          $pdf->getAction()->calculation=$calculation->toArrayForDocumentPdf();          
         $quotation=new DomoprimeQuotation($pdf->getMeeting(),$pdf->getSite());
        if ($quotation->isLoaded())
        {    
            $pdf->getAction()->quotation=$quotation->toArrayForPdf();   
            $pdf->getAction()->quotation['created_at']=CustomerMeetingFormDocumentParameters::format_date($quotation->get('created_at'));  
            $pdf->getAction()->quotation['dated_at']=CustomerMeetingFormDocumentParameters::format_date($quotation->get('dated_at'));  
            $pdf->getAction()->quotation['products']=$quotation->getProductsWithItems()->toArrayForQuotation();
           // $pdf->getAction()->quotation['restincharge']= DomoprimeSettings::load($pdf->getSite())->getRestInCharge(); */
        }
        // Take last billing
        $billing= new DomoprimeBilling($pdf->getMeeting(),$pdf->getSite());
        if ($billing->isLoaded())
        {    
            $pdf->getAction()->billing=$billing->toArrayForPdf();   
            $pdf->getAction()->billing['created_at']=CustomerMeetingFormDocumentParameters::format_date($billing->get('created_at'));  
            $pdf->getAction()->billing['dated_at']=CustomerMeetingFormDocumentParameters::format_date($billing->get('dated_at')); 
            $pdf->getAction()->billing['products']=$billing->getProductsWithItems()->toArrayForBilling();      
          //  $pdf->getAction()->billing['restincharge']= DomoprimeSettings::load($pdf->getSite())->getRestInCharge(); 
        }        
    }
    
    static function setMultipleForMeeting(mfEvent $event)
    {
        // CustomerMeetingMultipleProcess
        $multiple=$event->getSubject(); //CustomerMeetingMultipleProcess
        if (!mfModule::isModuleInstalled('app_domoprime',$multiple->getSite()))
             return ;   
        if (!in_array('create_contract',$multiple->getActions()))
           return ; 
        DomoprimeCalculation::updateCalculationWithContractFromMultipleMeetings($multiple);                 
    }
    
    static function setQuotationsForMultipleMeeting(mfEvent $event)
    {
        // CustomerMeetingMultipleProcess
        $multiple=$event->getSubject(); //CustomerMeetingMultipleProcess
        if (!mfModule::isModuleInstalled('app_domoprime',$multiple->getSite()))
             return ;   
        if (!in_array('create_contract',$multiple->getActions()))
           return ; 
        DomoprimeQuotationUtils::updateQuotationWithContractFromMultipleMeetings($multiple);              
    }
    
    static function setQuotationsForMultipleContract(mfEvent $event)
    {
        // CustomerMeetingMultipleProcess
        $multiple=$event->getSubject(); //CustomerMeetingMultipleProcess
        if (!mfModule::isModuleInstalled('app_domoprime',$multiple->getSite()))
             return ;   
        if (!in_array('quotation_contract',$multiple->getActions()))
           return ;          
       $multiple->getMessages()->push(__("Quotations have been updated with selection.",[],'messages','app_domoprime'));
        DomoprimeQuotationUtils::updateQuotationWithContractFromMultipleContracts($multiple);              
    }
    
    static function setProductForContractAndMeeting(mfEvent $event)
    {
        
       // $product=$event->getSubject(); //Product
        if (!mfModule::isModuleInstalled('app_domoprime',$event->getSubject()->getSite()))
             return ;   
        CustomerContractUtils::createDefaultProductForContracts($event->getSubject());
    }
    
    
    static function setPartnerLayersForPager2(mfEvent $event)
    {         
        if (!mfModule::isModuleInstalled('app_domoprime',$event->getSubject()->getSite()))
             return ;   
        CustomerContractUtils::getLayersFromPager($event->getSubject());       
    } 
       
    
     static function setDataExport2ForContract(mfEvent $event)
    {           
       $export=$event->getSubject();      
       if (!mfModule::isModuleInstalled('app_domoprime', $export->getSite()))
             return ;                  
    
       if ($event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',true)) 
           return ;    
       if ($event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_details',false))           
           return ;                   
    /*   if ($event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_details',true)) 
       {         
           return ;               
       }*/
      if (!$export->getFormat()->getSchema()->getNames()->glob(
              ['app.domoprime.quotation.*','app.domoprime.quotation.*_types']
              )->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeQuotation::getFieldsAndKeyWithTable()." FROM ".DomoprimeQuotation::getTable().                           
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {                
            while ($item=$db->fetchObject('DomoprimeQuotation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeQuotation',$item);              
            } 
         }
      }
      
    /*  if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.quotation.product*')->isEmpty())      
      {                
           $export->getSubObjects()->set('domoprime_quotation_product','DomoprimeQuotationProduct');
           $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())  
                ->setObjects(array('DomoprimeQuotationProduct','Product','CustomerContractProduct'))
                ->setQuery("SELECT {fields},".
                                    DomoprimeQuotation::getTableField('contract_id')." as contract_id,".
                                    CustomerContractProduct::getTableField('id')." as contract_product_id".
                                " FROM ".DomoprimeQuotationProduct::getTable().     
                           " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').
                           " INNER JOIN ".CustomerContractProduct::getTable()." ON ".CustomerContractProduct::getTableField('contract_id')."=".DomoprimeQuotation::getTableField('contract_id').
                                            " AND ".DomoprimeQuotationProduct::getTableField('product_id')." =".CustomerContractProduct::getTableField('product_id').
                           " INNER JOIN ".CustomerContractProduct::getOuterForJoin('product_id').
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
        // echo $db->getQuery();
         if ($db->getNumRows())
         {                
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;  
                $item = $items->getCustomerContractProduct();
                $item->set('product_id',$items->getProduct());
                
                $item->domoprime_quotation_product=$items->getDomoprimeQuotationProduct();
                
                $export->getCollection()->getItemByKey($items->get('contract_id'))->getCustomerContract()->getContractProducts()->push($item);
                                   
            } 
         } 
         if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.quotation.product.item*')->isEmpty())      
         {
             die(__METHOD__);
         }    
         
         
      } */
      
      
    
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.billing.*')->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeBilling::getFieldsAndKeyWithTable()." FROM ".DomoprimeBilling::getTable().                           
                           " WHERE ".DomoprimeBilling::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeBilling::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {           
            while ($item=$db->fetchObject('DomoprimeBilling'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeBilling',$item);              
            } 
         }
      } 
      
  
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.global.cumac_value','app.domoprime.classic.global.cumac_value','app.domoprime.modest.global.cumac_value',
                                                'app.domoprime.precarity', 'app.domoprime.modest','app.domoprime.very_modest','app.domoprime.classic.true',
                                                'app.domoprime.classic.false','app.domoprime.modest.pourcentage','app.domoprime.very_modest.pourcentage',
                                                'app.domoprime.class.energy.sector',
                                                'app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.class.energy.sector','app.domoprime.sector.name',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.bonus_precarity','app.domoprime.type_grille_precarite_a_ou_b','app.domoprime.intermediate')
         || !$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.product*')->isEmpty())
      {          
           $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                             
                ->setQuery("SELECT ".DomoprimeCalculation::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().                               
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('DomoprimeCalculation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                 $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeCalculation',$item);              
            } 
         }
                  
       // echo "<pre>"; var_dump($export->getCollection()); die(__METHOD__);
      } 
      
      // class
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class'
                                                )
              )
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeClass','DomoprimeClassI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('class_id').
                           " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeClass() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClass',$items->getDomoprimeClass());       
                if ($items->hasDomoprimeClassI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClassI18n',$items->getDomoprimeClassI18n());                       
            }            
         }
      }
    
      // energy     
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeEnergy','DomoprimeEnergyI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('energy_id').
                           " LEFT JOIN ".DomoprimeEnergyI18n::getInnerForJoin('energy_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeEnergy() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergy',$items->getDomoprimeEnergy());       
                if ($items->hasDomoprimeEnergyI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergyI18n',$items->getDomoprimeEnergyI18n());                       
            }            
         }
      }
    
      // sector      
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector','app.domoprime.sector.name'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeSector'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('sector_id').                         
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".                                
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeSector() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeSector',$items->getDomoprimeSector());                               
            }            
         }
      }
      
    /*  if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.quotation.product.item*')->isEmpty())
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeQuotationProductItem','DomoprimeQuotationProduct'))
                ->setQuery("SELECT {fields},".DomoprimeQuotation::getTableField('contract_id')." as contract_id FROM ".DomoprimeQuotationProductItem::getTable().   
                           " INNER JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('quotation_product_id').                         
                           " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('quotation_id').
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".                                
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;              
               if ($export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeQuotation()->get('id')==$items->getDomoprimeQuotationProduct()->get('quotation_id'))
                   $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeQuotationProductItem',$items->getDomoprimeQuotationProductItem());                               
               if ($export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeQuotation()->get('id')==$items->getDomoprimeQuotationProduct()->get('quotation_id'))
                   $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeQuotationProduct',$items->getDomoprimeQuotationProduct());  
            }            
         }
       //  echo "<pre>"; var_dump($export->getCollection()); die(__METHOD__);
      }*/
    }
    
    
    static function setConfigFilter2ForContract(mfEvent $event)
    {                  
       if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;        
        $formFilter=$event->getSubject();  
       // echo "--2--";
        if (!$formFilter->equal->hasValidator('class_id'))
            return ;
     //   echo "--1--";
        
    }
    
    static function setSubQueryForContractExport2(mfEvent $event)
    {                  
        $export=$event->getSubject();      
        if (!mfModule::isModuleInstalled('app_domoprime', $export->getSite()))
             return ;                  
        
        if ($event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',true)) 
        {        
           $export->getSubQuery()->left(DomoprimeCalculation::getInnerForJoin('contract_id')." AND isLast='YES'")
                     ->left(DomoprimeProductCalculation::getInnerForJoin('calculation_id'));                     
           
         /*  if (!$export->getFormat()->getSchema()->glob('contract.product.*')->isEmpty())
                return ;
           $export->getSubQuery()->left(CustomerContractProduct::getInnerForJoin('contract_id'))
                                  ->left(CustomerContractProduct::getOuterForJoin('product_id'));
           $export->getObjects()->push('Product');
           $export->getObjects()->push('CustomerContractProduct');    */   
        
           return ;    
        }
                 
        if (!$export->getFormat()->getSchema()->glob('contract.product.*')->isEmpty())
        {                           
           $export->getSubQuery()->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'));
           $export->getSubQuery()->getJoin()->findAndRemove(CustomerContractProduct::getOuterForJoin('product_id'));
           $export->getObjects()->findAndRemove('Product');
           $export->getObjects()->findAndRemove('CustomerContractProduct');                              
        }
                                  
    }
    
    
    
     static function setDataExport2CumacForContract(mfEvent $event)
    {           
       $export=$event->getSubject();      
       if (!mfModule::isModuleInstalled('app_domoprime', $export->getSite()))
             return ;              
       if (!$event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_cumac',false)) 
             return ;        
      if (!$event->getSubject()->getFilter()->getUser()->hasCredential([['app_domoprime_contract_list_export_cumac']])) 
          return ;            
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.quotation.item.*')->isEmpty())      
      {        
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array()) 
                ->setObjects(array('ProductItem','Product','DomoprimeQuotationProductItem'))
                ->setQuery("SELECT {fields},".DomoprimeQuotation::getTableField('contract_id')." as contract_id FROM ".DomoprimeQuotation::getTable().                      
                           " INNER JOIN ".DomoprimeQuotationProduct::getInnerForJoin('quotation_id').
                           " INNER JOIN ".DomoprimeQuotationProductItem::getInnerForJoin('quotation_id').
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').
                           " INNER JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').
                                 " AND ".DomoprimeQuotationProduct::getTableField('product_id')." =".CustomerContractProduct::getTableField('product_id').
                           " INNER JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('item_id').
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         // echo $db->getQuery();
         if ($db->getNumRows())
         {                
             while ($items=$db->fetchObjects())
             {
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;   
                if ($export->getCollection()->getItemByKey($items->get('contract_id'))->collection ===null)
                {                    
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection = new mfArray();
                }                             
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->collection->hasItemByKey($items->getProduct()->get('id')))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection[$items->getProduct()->get('id')]=$items->getProduct(); 
                
                if ($export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items===null)
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items=new mfArray();
                
                $export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items[$items->getProductItem()->get('id')]=$items;
                
             }                    
         }                                                
      }  
       
     // die(__METHOD__);  
       
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.product*')->isEmpty())
      {           
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeProductCalculation','DomoprimeCalculation','Product'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeProductCalculation::getTable().   
                           " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').    
                           " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id'). 
                           " INNER JOIN ".CustomerContractProduct::getTable()." ON ".CustomerContractProduct::getTableField('product_id')."=".DomoprimeProductCalculation::getTableField('product_id'). " AND ".
                                        CustomerContractProduct::getTableField('contract_id')."=".DomoprimeCalculation::getTableField('contract_id').
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".      
                                " AND ".DomoprimeProductCalculation::getTableField('surface')." > 0".
                                " AND ".DomoprimeProductCalculation::getTableField('product_id')."=".CustomerContractProduct::getTableField('product_id').             
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
    //    echo $db->getQuery(); die(__METHOD__);
       // echo "<pre>";
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                     
                if (!$export->getCollection()->hasItemByKey($items->getDomoprimeCalculation()->get('contract_id')))
                    continue;                
                $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->set('DomoprimeCalculation',$items->getDomoprimeCalculation());
                if ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection ===null)
                {                    
                    $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection = new mfArray();
                }
              //  var_dump($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection);
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->collection->hasItemByKey($items->getProduct()->get('id')))
                {                   
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection[$items->getProduct()->get('id')]=$items; 
                }
               
                foreach ($items->getObjects() as $name=>$item)
                {
                    if ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->items)
                    {
                        foreach ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->items as $product_item_items)
                        {                            
                            $product_item_items->set($name,$item);     
                        }    
                    }   
                    else
                    {   
                     $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->set($name,$item);     
                    }
                }              
            }            
         }      
      }
      
  
      
      //calculation
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.global.cumac_value','app.domoprime.classic.global.cumac_value','app.domoprime.modest.global.cumac_value',
                                                'app.domoprime.precarity', 'app.domoprime.modest','app.domoprime.very_modest','app.domoprime.classic.true',
                                                'app.domoprime.classic.false','app.domoprime.modest.pourcentage','app.domoprime.very_modest.pourcentage',
                                                'app.domoprime.class.energy.sector',
                                                'app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.class.energy.sector','app.domoprime.sector.name',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.bonus_precarity','app.domoprime.type_grille_precarite_a_ou_b','app.domoprime.intermediate')
         || !$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.product*')->isEmpty())
      {          
           $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                             
                ->setQuery("SELECT ".DomoprimeCalculation::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().                               
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('DomoprimeCalculation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                 $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeCalculation',$item);              
            } 
         }
       // echo "<pre>"; var_dump($export->getCollection()); die(__METHOD__);
      }
      
      
      // class
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class'
                                                )
              )
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeClass','DomoprimeClassI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('class_id').
                           " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeClass() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClass',$items->getDomoprimeClass());       
                if ($items->hasDomoprimeClassI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClassI18n',$items->getDomoprimeClassI18n());                       
            }            
         }
      }
    
      // energy     
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeEnergy','DomoprimeEnergyI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('energy_id').
                           " LEFT JOIN ".DomoprimeEnergyI18n::getInnerForJoin('energy_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeEnergy() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergy',$items->getDomoprimeEnergy());       
                if ($items->hasDomoprimeEnergyI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergyI18n',$items->getDomoprimeEnergyI18n());                       
            }            
         }
      }
    
      // sector      
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector','app.domoprime.sector.name'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeSector'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('sector_id').                         
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".                                
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeSector() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeSector',$items->getDomoprimeSector());                               
            }            
         }
      }
      
      
      
      if (!$export->getFormat()->getSchema()->getNames()->glob(
              'app.domoprime.quotation.*'
              )->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeQuotation::getFieldsAndKeyWithTable()." FROM ".DomoprimeQuotation::getTable().                           
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {                
            while ($item=$db->fetchObject('DomoprimeQuotation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeQuotation',$item);              
            } 
         }
      }
      
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.billing.*')->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeBilling::getFieldsAndKeyWithTable()." FROM ".DomoprimeBilling::getTable().                           
                           " WHERE ".DomoprimeBilling::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeBilling::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {           
            while ($item=$db->fetchObject('DomoprimeBilling'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeBilling',$item);              
            } 
         }
      } 
              
      
    }
    
    
    
    static function setDataExport2DetailsForContract(mfEvent $event)
    {                 
       $export=$event->getSubject();      
       if (!mfModule::isModuleInstalled('app_domoprime', $export->getSite()))
             return ;                    
       if (!$event->getSubject()->getFilter()->getValuesForOptions()->getItemByKey('with_details',false)) 
             return ;         
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.quotation.item.*')->isEmpty())      
      {        
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array()) 
                ->setObjects(array('ProductItem','Product','DomoprimeQuotationProductItem'))
                ->setQuery("SELECT {fields},".DomoprimeQuotation::getTableField('contract_id')." as contract_id FROM ".DomoprimeQuotation::getTable().                      
                           " INNER JOIN ".DomoprimeQuotationProduct::getInnerForJoin('quotation_id').
                           " INNER JOIN ".DomoprimeQuotationProductItem::getInnerForJoin('quotation_id').
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').
                           " INNER JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " INNER JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').
                                 " AND ".DomoprimeQuotationProduct::getTableField('product_id')." =".CustomerContractProduct::getTableField('product_id').
                           " INNER JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('item_id').
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         // echo $db->getQuery();
         if ($db->getNumRows())
         {                
             while ($items=$db->fetchObjects())
             {
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;   
                if ($export->getCollection()->getItemByKey($items->get('contract_id'))->collection ===null)
                {                    
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection = new mfArray();
                }                             
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->collection->hasItemByKey($items->getProduct()->get('id')))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection[$items->getProduct()->get('id')]=$items->getProduct(); 
                
                if ($export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items===null)
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items=new mfArray();
                
                $export->getCollection()->getItemByKey($items->get('contract_id'))->collection->getItemByKey($items->getProduct()->get('id'))->items[$items->getProductItem()->get('id')]=$items;
                
             }                    
         }                                                
      }  
       
     // die(__METHOD__);  
       
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.product*')->isEmpty())
      {           
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeProductCalculation','DomoprimeCalculation','Product'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeProductCalculation::getTable().   
                           " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('calculation_id').    
                           " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id'). 
                           " INNER JOIN ".CustomerContractProduct::getTable()." ON ".CustomerContractProduct::getTableField('product_id')."=".DomoprimeProductCalculation::getTableField('product_id'). " AND ".
                                        CustomerContractProduct::getTableField('contract_id')."=".DomoprimeCalculation::getTableField('contract_id').
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".      
                                " AND ".DomoprimeProductCalculation::getTableField('surface')." > 0".
                                " AND ".DomoprimeProductCalculation::getTableField('product_id')."=".CustomerContractProduct::getTableField('product_id').             
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
    //    echo $db->getQuery(); die(__METHOD__);
       // echo "<pre>";
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                     
                if (!$export->getCollection()->hasItemByKey($items->getDomoprimeCalculation()->get('contract_id')))
                    continue;                
                $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->set('DomoprimeCalculation',$items->getDomoprimeCalculation());
                if ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection ===null)
                {                    
                    $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection = new mfArray();
                }
              //  var_dump($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection);
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->collection->hasItemByKey($items->getProduct()->get('id')))
                {                   
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->collection[$items->getProduct()->get('id')]=$items; 
                }
               
                foreach ($items->getObjects() as $name=>$item)
                {
                    if ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->items)
                    {
                        foreach ($export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->items as $product_item_items)
                        {                            
                            $product_item_items->set($name,$item);     
                        }    
                    }   
                    else
                    {   
                     $export->getCollection()->getItemByKey($items->getDomoprimeCalculation()->get('contract_id'))->collection[$items->getProduct()->get('id')]->set($name,$item);     
                    }
                }              
            }            
         }      
      }
      
  
      
      //calculation
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.global.cumac_value','app.domoprime.classic.global.cumac_value','app.domoprime.modest.global.cumac_value',
                                                'app.domoprime.precarity', 'app.domoprime.modest','app.domoprime.very_modest','app.domoprime.classic.true',
                                                'app.domoprime.classic.false','app.domoprime.modest.pourcentage','app.domoprime.very_modest.pourcentage',
                                                'app.domoprime.class.energy.sector',
                                                'app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.class.energy.sector','app.domoprime.sector.name',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class',
                                                'app.domoprime.bonus_precarity','app.domoprime.type_grille_precarite_a_ou_b','app.domoprime.intermediate')
         || !$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.product*')->isEmpty())
      {          
           $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                             
                ->setQuery("SELECT ".DomoprimeCalculation::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().                               
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($item=$db->fetchObject('DomoprimeCalculation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                 $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeCalculation',$item);              
            } 
         }
       // echo "<pre>"; var_dump($export->getCollection()); die(__METHOD__);
      }
      
      
      // class
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector',
                                                'app.domoprime.class.name','app.domoprime.class.value','app.domoprime.bonus_precarity','app.domoprime.bonus_precarity_class'
                                                )
              )
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeClass','DomoprimeClassI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('class_id').
                           " LEFT JOIN ".DomoprimeClassI18n::getInnerForJoin('class_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeClass() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClass',$items->getDomoprimeClass());       
                if ($items->hasDomoprimeClassI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeClassI18n',$items->getDomoprimeClassI18n());                       
            }            
         }
      }
    
      // energy     
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.energy.name','app.domoprime.energy.value','app.domoprime.bonus_precarity_class'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=> mfcontext::getInstance()->getUser()->getLanguage()))             
                ->setObjects(array('DomoprimeEnergy','DomoprimeEnergyI18n'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('energy_id').
                           " LEFT JOIN ".DomoprimeEnergyI18n::getInnerForJoin('energy_id')." AND lang='{lang}'".
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeEnergy() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergy',$items->getDomoprimeEnergy());       
                if ($items->hasDomoprimeEnergyI18n() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeEnergyI18n',$items->getDomoprimeEnergyI18n());                       
            }            
         }
      }
    
      // sector      
      if ($export->getFormat()->getSchema()->getNames()->in('app.domoprime.class.energy.sector','app.domoprime.sector.name'))
      {
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setObjects(array('DomoprimeSector'))
                ->setQuery("SELECT {fields},".DomoprimeCalculation::getTableField('id')." as calculation_id,".DomoprimeCalculation::getTableField('contract_id')." as contract_id FROM ".DomoprimeCalculation::getTable().   
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('sector_id').                         
                           " WHERE ".DomoprimeCalculation::getTableField('contract_id')." IN(".$export->getCollection()->getKeys()->implode(",").")".   
                                " AND ".DomoprimeCalculation::getTableField('isLast')."='YES'".                                
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {
            while ($items=$db->fetchObjects())
            {                           
                if (!$export->getCollection()->hasItemByKey($items->get('contract_id')))
                    continue;
                if (!$export->getCollection()->getItemByKey($items->get('contract_id'))->hasDomoprimeCalculation())
                    continue;
                if ($items->hasDomoprimeSector() && $export->getCollection()->getItemByKey($items->get('contract_id'))->getDomoprimeCalculation()->get('id')==$items->get('calculation_id'))
                    $export->getCollection()->getItemByKey($items->get('contract_id'))->set('DomoprimeSector',$items->getDomoprimeSector());                               
            }            
         }
      }
      
      
      
      if (!$export->getFormat()->getSchema()->getNames()->glob(
              'app.domoprime.quotation.*'
              )->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeQuotation::getFieldsAndKeyWithTable()." FROM ".DomoprimeQuotation::getTable().                           
                           " WHERE ".DomoprimeQuotation::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeQuotation::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {                
            while ($item=$db->fetchObject('DomoprimeQuotation'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeQuotation',$item);              
            } 
         }
      }
      
      if (!$export->getFormat()->getSchema()->getNames()->glob('app.domoprime.billing.*')->isEmpty())      
      {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())             
                ->setQuery("SELECT ".DomoprimeBilling::getFieldsAndKeyWithTable()." FROM ".DomoprimeBilling::getTable().                           
                           " WHERE ".DomoprimeBilling::getTableField('contract_id')." IN('".$export->getCollection()->getKeys()->implode("','")."')".   
                                " AND ".DomoprimeBilling::getTableField('is_last')."='YES'".
                           ";")               
                ->makeSiteSqlQuery($export->getSite()); 
         if ($db->getNumRows())
         {           
            while ($item=$db->fetchObject('DomoprimeBilling'))
            {                           
                if (!$export->getCollection()->hasItemByKey($item->get('contract_id')))
                    continue;
                $export->getCollection()->getItemByKey($item->get('contract_id'))->set('DomoprimeBilling',$item);              
            } 
         }
      }                     
    }
    
    static function setCalculationForContractTransfer(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
         // CustomerContract        
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$event->getSubject()->get('meeting_id'),'contract_id'=>$event->getSubject()->get('id')))             
                ->setQuery("UPDATE ".DomoprimeCalculation::getTable().                        
                           " SET contract_id='{contract_id}'".
                           " WHERE ".DomoprimeCalculation::getTableField('meeting_id')."='{meeting_id}'".                                 
                           ";")               
                ->makeSqlQuery();        
    }
    
    
     static function setQuotationForContractTransfer(mfEvent $event)
    {
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;         
         // CustomerContract        
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$event->getSubject()->get('meeting_id'),'contract_id'=>$event->getSubject()->get('id')))             
                ->setQuery("UPDATE ".DomoprimeQuotation::getTable().                        
                           " SET contract_id='{contract_id}'".
                           " WHERE ".DomoprimeQuotation::getTableField('meeting_id')."='{meeting_id}'".                                 
                           ";")               
                ->makeSqlQuery();        
    }
    
    
    static function meetingChangeOpenedAt(mfEvent $event)
    {                
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;                            
        if ($event['action']!='to_contract') 
            return ;                    
        if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('meeting_to_contract_quotation_signed_at_to_opened_at'))))
            return ;  
        $contract=$event->getSubject();
        $quotation= new DomoprimeQuotation($contract->getMeeting()); 
        if ($quotation->isNotLoaded())
               return ;                     
        $contract->set('opened_at',$quotation->hasSignedAt()?$quotation->getSignedAt()->getDay()->getDate():null)->save();           
    }
          
    function UpdateBillingFromLastQuotation(mfEvent $event)
      {             
         if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;               
         if (!mfContext::getInstance()->getUser()->hasCredential(array(array('contract_update_billing_from_last_quotation'))))
             return ;
         $messages = mfMessages::getInstance();     
         $quotation=$event->getSubject();
          if ($quotation->isNotLoaded())
          {    
               $messages->addError(__("Quotation is invalid.")); 
               return;   
          }
          if ($quotation->getContract()->isNotLoaded())
          {    
              $messages->addError(__("Contract is invalid."));
              return;      
          }
           $billing=new DomoprimeBilling($quotation->getContract());         
          if ($billing->isNotLoaded())
          {
              $messages->addError(__("Billing is invalid."));
              return;
          }                
         
            $billing->updateFromQuotationWithUser($quotation,mfContext::getInstance()->getUser());
            $quotation->getContract()->setClosedAtFromOpcAt();       
         
    }
    
    
    static function meetingTransferLastQuotation(mfEvent $event)
    {          
       $meeting=$event->getSubject();
       if (!mfModule::isModuleInstalled('app_domoprime', $meeting->getSite()))
             return ;      
       $user=mfContext::getInstance()->getUser();
       if (!$user->hasCredential(array(array('last_quotation_signed_required_for_transfer'))))
               return ;
        $quotation= new DomoprimeQuotation($meeting);    
        if($quotation->isSigned())
            return ;                
        throw new mfException(__("Last quotation is not signed"));                   
    } 
    
    
    static function UnholdFormsForQuotationForContract(mfEvent $event)
    {                        
        $quotation=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;  
        if ($quotation->isNotLoaded())
             return ;
    //    if (!mfContext::getInstance()->getUser()->hasCredential(array(array('quotation_update_unhold_meeting_forms'))))
     //          return ;      
        $forms=new CustomerMeetingForms($quotation->getContract());   
        if ($forms->isNotLoaded())
           return ;
        $forms->setUnhold(); 
        $forms->save();
    }
    
     static function UnholdFormsForQuotationForMeeting(mfEvent $event)
    {                        
        $quotation=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;  
        if ($quotation->isNotLoaded())
             return ;
    //    if (!mfContext::getInstance()->getUser()->hasCredential(array(array('quotation_update_unhold_meeting_forms'))))
     //          return ;      
        $forms=new CustomerMeetingForms($quotation->getMeeting());   
        if ($forms->isNotLoaded())
           return ;
        $forms->setUnhold(); 
        $forms->save();
    }
    
     static function setQuotationDateFilterForContract(mfEvent $event)
     {
       
        $filter=$event->getSubject();
        if (!mfModule::isModuleInstalled('app_domoprime'))
             return ;     
         if (!mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin','app_domoprime_contract_list_filter_quotation_signed'))))
            return ;     
        $filter->getMfQuery()->left(DomoprimeQuotation::getInnerForJoin('contract_id')." AND ".
                                        DomoprimeQuotation::getTableField("is_last='YES'")." AND ".
                                        DomoprimeQuotation::getTableField("is_signed='YES'")
                            );          

 
    }
}
