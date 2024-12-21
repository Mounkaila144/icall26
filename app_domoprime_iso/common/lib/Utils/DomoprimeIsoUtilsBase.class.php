<?php


class DomoprimeIsoUtilsBase {
    
    
    static function migrateModels($site=null)
    {
      /*  iso: {$meeting.forms.iso.surface_comble}  {$meeting.forms.iso.surface_mur} {$meeting.forms.iso.surface_plancher}
         isoxx {$contract.request.surface_top} {$contract.request.surface_wall} {$contract.request.surface_floor}
    */
        // Customer emails
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".CustomerModelEmailI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site); 
         // Customer sms
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".CustomerModelSmsI18n::getTable().   
                       " SET message=REPLACE(message,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "message=REPLACE(message,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "message=REPLACE(message,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site); 
         // User emails
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".UserModelEmailI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site); 
        // User sms
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".UserModelSmsI18n::getTable().   
                       " SET message=REPLACE(message,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "message=REPLACE(message,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "message=REPLACE(message,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site); 
        // Quotation
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".DomoprimeQuotationModelI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site);         
        // Billing
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".DomoprimeBillingModelI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site);   
        // Installer emails
         $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".InstallerModelEmailI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site);
          // Patner emails
       /*  UPDATE t_partners_model_email_i18n  
           SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor');
        */
        if (mfModule::isModuleInstalled('partners_communication_emails',$site))
        {        
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array())              
            ->setQuery("UPDATE ".PartnerModelEmailI18n::getTable().   
                       " SET body=REPLACE(body,'meeting.forms.iso.surface_comble','contract.request.surface_top'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_mur','contract.request.surface_wall'),".
                             "body=REPLACE(body,'meeting.forms.iso.surface_plancher','contract.request.surface_floor')".                    
                        ";")
            ->makeSiteSqlQuery($site);   
        }
    }     
    
    static function generateCalculationForContracts(CustomerContractMultipleProcess $multiple)
    {        
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContract','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')".
                           ";")
                ->makeSiteSqlQuery($multiple->getSite());
         if (!$db->getNumRows())
             return ;
         $contracts=new mfArray();
         while ($items=$db->fetchObjects())
         {
             $item=$items->getCustomerContract();
             $item->set('customer_id',$items->getCustomer());
             $contracts[]=$item;
         }                 
         foreach ($contracts as $contract)
         {
             try
             {
                $engine=new DomoprimeIsoEngine($contract);
                $engine->process();
                $report=new DomoprimeCalculation($engine);
                $report->process(mfContext::getInstance()->getUser()->getGuardUser());    
             } 
             catch (mfException $ex) 
             {
                 $multiple->getMessages()->push(__("Customer [%s] ",$contract->getCustomer()->getName()).$ex->getMessage());
                 // Remove last calculation
                $report=new DomoprimeCalculation($contract);
                $report->release();
             }
         }         
    }
    
    static function setMultipleForMeetingTransferForSelection(mfArray $selection,$site=null)
    {         
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("UPDATE ".DomoprimeCustomerRequest::getTable().
                           " INNER JOIN ".DomoprimeCustomerRequest::getOuterForJoin('meeting_id').
                           " INNER JOIN ".CustomerCOntract::getInnerForJoin('meeting_id').
                           " SET ".DomoprimeCustomerRequest::getTableField('contract_id')."=".CustomerCOntract::getTableField('id').
                           " WHERE ".CustomerMeeting::getTableField('id')." IN('".$selection->implode("','")."')".
                           ";")
                ->makeSiteSqlQuery($site); 
    }
}
