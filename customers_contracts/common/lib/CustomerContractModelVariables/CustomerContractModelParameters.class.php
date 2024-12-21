<?php


class CustomerContractModelParameters  {
    
    
    static function loadParametersForEmail(CustomerContract $contract,$action)
    {        
       $action->company= SiteCompanyUtils::getSiteCompany($contract->getSite())->toArray();                      
       $action->customer=$contract->getCustomer()->toArray();      
       $action->contract=$contract->toArray();  
       // Meeting
       $action->meeting=$contract->getMeeting()->toArray();
       $action->meeting['created_at']=CustomerModelEmailI18n::format_date($contract->getMeeting()->get('created_at'));  
       $action->meeting['updated_at']=CustomerModelEmailI18n::format_date($contract->getMeeting()->get('updated_at'));  
       $action->meeting['in_at']=CustomerModelEmailI18n::format_date($contract->getMeeting()->get('in_at'));  
       $action->meeting['in_at']['time']=format_date($contract->getMeeting()->get('in_at'),"t");
       
       $action->contract['state']=$contract->getStatus()->getCustomerContractStatusI18n();             
       $action->contract['previous_state']=$contract->hasPreviousStatus()?$contract->getPreviousStatus()->getCustomerContractStatusI18n():"";  
       // Amount & tax  
       $action->contract['total_price_without_tax']=$contract->getPriceWithoutTax();
       $action->contract['total_price_with_tax']=$contract->getPriceWithoutTax();
       $action->contract['tax_amount']=$contract->getTaxAmount();
       $action->contract['tax']=format_pourcentage($contract->getTax());
       // Contract users
       $action->contract['team']=(string)$contract->getTeam()->get('name');              
       $action->contract['telepro']=$contract->getTelepro()->toArrayForDocument();       
       $action->contract['sale_1']=$contract->getSale1()->toArrayForDocument();
       $action->contract['sale_2']=$contract->getSale2()->toArrayForDocument();              
       $action->contract['manager']=$contract->getManager()->toArrayForDocument();         
       $action->contract['partner']=$contract->getPartner()->toArray();
       $action->contract['opc_status']=(string)$contract->getOpcStatus()->getI18n();
       if ($contract->hasTimeStatus())
            $action->contract['time_status']=(string)$contract->getTimeStatus()->getI18n(); 
       if ($contract->hasAdminStatus())
            $action->contract['admin_status']=(string)$contract->getAdminStatus()->getI18n();
       if ($contract->hasOpcRange())
            $action->contract['opc_range']=(string)$contract->getOpcRange()->getI18n();  
     //  var_dump($action->contract['sale1']); die(__METHOD__);
       // Dates
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       $action->contract['created_at']=CustomerModelEmailI18n::format_date($contract->get('created_at'));  
       $action->contract['updated_at']=CustomerModelEmailI18n::format_date($contract->get('updated_at'));  
       $action->contract['opened_at']=CustomerModelEmailI18n::format_date($contract->get('opened_at'));  
       $action->contract['opc_at']=CustomerModelEmailI18n::format_date($contract->get('opc_at'));      
       $action->contract['sav_at']=CustomerModelEmailI18n::format_date($contract->get('sav_at')); 
       $action->contract['apf_at']=CustomerModelEmailI18n::format_date($contract->get('apf_at')); 
       $action->contract['doc_at']=CustomerModelEmailI18n::format_date($contract->get('doc_at')); 
       if ($contract->hasQuotedAt())
           $action->contract['quoted_at']=CustomerModelEmailI18n::format_date($contract->get('quoted_at')); 
       if ($contract->hasBillingAt())
            $action->contract['billing_at']=CustomerModelEmailI18n::format_date($contract->get('billing_at')); 
       // sold products (separate with ,)
       $action->contract['products']=$action->getComponent('/customers_contracts/products', array('COMMENT'=>false,'contract'=>$contract))->getContent();                
       // proposed products (separate with ,)         
       if (mfModule::isModuleInstalled('customers_meetings',$contract->getSite()))
          $action->meeting['products']=$action->getComponent('/customers_meetings/products', array('COMMENT'=>false,'meeting'=>$contract->getMeeting()))->getContent();                       
    }
    
     static function loadParametersForSms(CustomerContract $contract,$action)
    {
        self::loadParametersForEmail($contract, $action);
    }
     
    static function loadParametersForDocument(CustomerContract $contract,$action)
    {        
       self::loadParametersForEmail($contract, $action);
    }
    
    
    
    static function loadParametersForContracts(CustomerContractCollection $contracts,$action)
    {        
        $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
        $action->company= SiteCompanyUtils::getSiteCompany($contracts->getSite())->toArray();                      
        $action->contracts=array();              
       foreach ($contracts as $contract)
       {                          
            $_contract=array();
            $_contract['contract']=$contract->toArray();  
            $_contract['customer']=$contract->getCustomer()->toArray();   
            $_contract['contract']['state']=$contract->getStatus()->getCustomerContractStatusI18n();             
            $_contract['contract']['previous_state']=$contract->hasPreviousStatus()?$contract->getPreviousStatus()->getCustomerContractStatusI18n():"";  
            // Amount & tax  
            $_contract['contract']['total_price_without_tax']=$contract->getPriceWithoutTax();
            $_contract['contract']['total_price_with_tax']=$contract->getPriceWithoutTax();
            $_contract['contract']['tax_amount']=$contract->getTaxAmount();
            $_contract['contract']['tax']=format_pourcentage($contract->getTax());
            // Contract users
            $_contract['contract']['team']=(string)$contract->getTeam()->get('name');              
            $_contract['contract']['telepro']=$contract->getTelepro()->toArrayForDocument();       
            $_contract['contract']['sale_1']=$contract->getSale1()->toArrayForDocument();
            $_contract['contract']['sale_2']=$contract->getSale2()->toArrayForDocument();              
            $_contract['contract']['manager']=$contract->getManager()->toArrayForDocument();         
            $_contract['contract']['partner']=$contract->getPartner()->toArray(); // get('name')  
            $_contract['contract']['opc_status']=(string)$contract->getOpcStatus()->getI18n();
            if ($contract->hasTimeStatus())
                 $_contract['contract']['time_status']=(string)$contract->getTimeStatus()->getI18n(); 
            if ($contract->hasAdminStatus())
                 $_contract['contract']['admin_status']=(string)$contract->getAdminStatus()->getI18n();
            if ($contract->hasOpcRange())
                 $_contract['contract']['opc_range']=(string)$contract->getOpcRange()->getI18n();      
            // Dates       
            $_contract['contract']['created_at']=CustomerModelEmailI18n::format_date($contract->get('created_at'));  
            $_contract['contract']['updated_at']=CustomerModelEmailI18n::format_date($contract->get('updated_at'));  
            $_contract['contract']['opened_at']=CustomerModelEmailI18n::format_date($contract->get('opened_at'));  
            $_contract['contract']['opc_at']=CustomerModelEmailI18n::format_date($contract->get('opc_at'));      
            $_contract['contract']['sav_at']=CustomerModelEmailI18n::format_date($contract->get('sav_at')); 
            $_contract['contract']['apf_at']=CustomerModelEmailI18n::format_date($contract->get('apf_at'));                  
            $_contract['contract']['doc_at']=CustomerModelEmailI18n::format_date($contract->get('doc_at')); 
            if ($contract->hasQuotedAt())
                $_contract['contract']['quoted_at']=CustomerModelEmailI18n::format_date($contract->get('quoted_at'));                  
            if ($contract->hasBillingAt())
                $_contract['contract']['billing_at']=CustomerModelEmailI18n::format_date($contract->get('billing_at')); 
            $action->contracts[$contract->get('id')]=$_contract;
       }
    }
    
    static function loadParametersWithChangesForEmail(CustomerContract $contract,$action)
    {        
        self::loadParametersForEmail($contract, $action);
        $action->contract['changes']=array(
            'state'=>(string)$contract->getOldStatus()->getI18n()
        );
    }
}



