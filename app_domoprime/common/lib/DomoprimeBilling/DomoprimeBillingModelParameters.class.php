<?php


class DomoprimeBillingModelParameters  {
    
    
    static function loadParametersForBilling(DomoprimeBilling $billing,$action)
    {               
       $settings=DomoprimeSettings::load($billing->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($billing->getSite())->toArray();           
       // proposed products (separate with ,)      
       $action->billing=$billing->toArrayForBilling();                       
       $action->billing['created_at']=CustomerModelEmailI18n::format_date($billing->get('created_at'));  
       $action->billing['dated_at']=CustomerModelEmailI18n::format_date($billing->get('dated_at'));       
       // Customer
       $action->billing['customer']=$billing->getContract()->getCustomer()->toArray();      
       // Contract
       $action->billing['contract']=$billing->getContract()->toArray();    
       $action->billing['contract']['created_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('created_at'));  
       $action->billing['contract']['updated_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('updated_at'));  
       $action->billing['contract']['opc_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('opc_at'));  
       $action->billing['contract']['sav_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('sav_at'));  
       $action->billing['contract']['opened_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('opened_at'));  
       $action->billing['contract']['payment_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('payment_at'));                 
       $action->billing['contract']['pre_meeting_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('pre_meeting_at')); 
       $action->billing['contract']['pre_meeting_at']['time']=format_date($billing->getContract()->get('pre_meeting_at'),"t");      
       if ($billing->getContract()->hasPartnerLayer())       
            $action->billing['contract']['layer']=$billing->getContract()->getPartnerLayer()->toArrayForDocument();  
       $action->billing['products']=$billing->getProductsWithItems()->toArrayForBilling();            
       if ($billing->getContract()->hasPolluter())       
            $action->billing['polluter']=$billing->getContract()->getPolluter()->toArrayForDocument();  
       if ($billing->getContract()->hasCompany())          
            $action->billing['company']=$billing->getContract()->getCompany()->toArray();  
       if ($billing->getContract()->hasCompany())           
            $action->company=$billing->getContract()->getCompany()->toArray();       
       $calculation =new DomoprimeCalculation($billing->getContract());
       if ($calculation->isLoaded())       
           $action->billing['calculation']=$calculation->toArrayForBilling();      
       $action->billing['works']=$billing->getProductsWithProducts()->getValuesByField('reference')->asort()->implode(', ');       
       //$action->billing['restincharge']= $settings->getRestInCharge();      
       $action->billing['restincharge']=$billing->get('fixed_prime')!=0 ? $billing->getFixedPrime() + $settings->getRestInCharge(): $settings->getRestInCharge();   
       $action->billing['restincharge_symbol']= (string)$settings->getFormattedRestInCharge();        
       if ($billing->getContract()->hasQuotedAt())
          $action->billing['contract']['quoted_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('quoted_at')); 
       if ($billing->getContract()->hasBillingAt())
          $action->billing['contract']['billing_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('billing_at')); 
       $action->billing['quotation']['dated_at']=CustomerModelEmailI18n::format_date($billing->getQuotation()->get('dated_at'));        
       $action->billing['quotation']['created_at']=CustomerModelEmailI18n::format_date($billing->getQuotation()->get('created_at'));        
       if ($billing->getQuotation()->hasSignedAt())
            $action->billing['quotation']['signed_at']=CustomerModelEmailI18n::format_date($billing->getQuotation()->get('signed_at'));        
       $action->billing['quotation']['reference']=$billing->getQuotation()->get('reference');    
       $action->billing['dated_at_90']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+90 days',strtotime($billing->get('dated_at')))));
       $action->billing['dated_at_15']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+15 days',strtotime($billing->get('dated_at')))));
       $action->billing['master']=$billing->getProductsWithItems()->hasMaster()?$billing->getProductsWithItems()->getMaster()->toArrayForBilling():"";
       if ($billing->getContract()->hasPartnerLayer())       
           $action->contract['layer']=$billing->getContract()->getPartnerLayer()->toArrayForDocument();  
       if ($billing->getContract()->hasPartner())       
                $action->contract['partner']=$billing->getContract()->getPartner()->toArrayForDocument();  
    }
    
    
    static function loadParametersForBillings(DomoprimeBillingCollection $billings,$action)
    {               
       $settings=DomoprimeSettings::load($billings->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($billings->getSite())->toArray(); 
       $action->billings=array();
       foreach ($billings as $billing)
       {                               
            $_billing=$billing->toArrayForBilling();   
            $_billing['created_at']=CustomerModelEmailI18n::format_date($billing->get('created_at'));  
            $_billing['dated_at']=CustomerModelEmailI18n::format_date($billing->get('dated_at'));    
            $_billing['customer']=$billing->getContract()->getCustomer()->toArray();             
            $_billing['contract']=$billing->getContract()->toArray();    
            $_billing['contract']['created_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('created_at'));  
            $_billing['contract']['updated_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('updated_at'));  
            $_billing['contract']['opc_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('opc_at'));  
            $_billing['contract']['sav_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('sav_at'));  
            $_billing['contract']['opened_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('opened_at'));  
            $_billing['contract']['payment_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('payment_at'));                       
            $_billing['contract']['pre_meeting_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('pre_meeting_at')); 
            $_billing['contract']['pre_meeting_at']['time']=format_date($billing->getContract()->get('pre_meeting_at'),"t");
            $_billing['products']=$billing->getProductsWithItems()->toArrayForBilling();   
            if ($billing->getContract()->hasPartnerLayer())       
                $_billing['contract']['layer']=$billing->getContract()->getPartnerLayer()->toArrayForDocument();      
            if ($billing->getContract()->hasCompany())          
                $_billing['contract']['company']=$billing->getContract()->getCompany()->toArray();  
            $_billing['restincharge']= $settings->getRestInCharge(); 
            if ($billing->getContract()->hasQuotedAt())
                $_billing['contract']['quoted_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('quoted_at')); 
            if ($billing->getContract()->hasBillingAt())
                $_billing['contract']['billing_at']=CustomerModelEmailI18n::format_date($billing->getContract()->get('billing_at'));
            $_billing['quotation']['dated_at']=CustomerModelEmailI18n::format_date($billing->getQuotation()->get('dated_at'));        
            $_billing['quotation']['created_at']=CustomerModelEmailI18n::format_date($billing->getQuotation()->get('created_at'));        
            $_billing['quotation']['reference']=$billing->getQuotation()->get('reference');                 
            $action->billings[]=$_billing;
       }
       //echo "<pre>"; var_dump($action->billings); die(__METHOD__);
    }
  
    
    static function loadParametersForEmailBilling(DomoprimeBilling $billing,$action)
    {               
       $settings=DomoprimeSettings::load($billing->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($billing->getSite())->toArray();                 
       // Customer
       $action->customer=$billing->getContract()->getCustomer()->toArray();     
       if ($billing->getContract()->hasCompany())           
         $action->company=$billing->getContract()->getCompany()->toArray();           
    }
}


