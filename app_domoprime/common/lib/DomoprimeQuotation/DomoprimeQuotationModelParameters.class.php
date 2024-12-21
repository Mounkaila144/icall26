<?php


class DomoprimeQuotationModelParameters  {
    
    
    static function loadParametersForQuotation(DomoprimeQuotation $quotation,$action)
    {   
       $settings=DomoprimeSettings::load($quotation->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($quotation->getSite())->toArray();    
       // Customer
       $action->customer=$quotation->hasContract()?$quotation->getContract()->getCustomer()->toArray():$quotation->getMeeting()->getCustomer()->toArray();      
       // Meeting       
       if ($quotation->hasContract())
       {    
            $action->contract=$quotation->getContract()->toArray();             
            $action->contract['created_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('created_at'));  
            $action->contract['updated_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('updated_at'));  
            $action->contract['opc_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('opc_at'));  
            $action->contract['sav_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('sav_at'));  
            $action->contract['opened_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('opened_at'));  
            if ($quotation->getContract()->hasQuotedAt())
            {                                    
                $action->contract['quoted_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('quoted_at'));  
                $action->contract['quoted_at_90']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+90 days',strtotime($quotation->getContract()->get('quoted_at')))));             
                $action->contract['quoted_at_30']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+1 month',strtotime($quotation->getContract()->get('quoted_at')))));
            }                      
            if ($quotation->getContract()->hasBillingAt())
                    $action->contract['billing_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('billing_at'));  
            $action->contract['payment_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('payment_at'));  
            $action->contract['pre_meeting_at']=CustomerModelEmailI18n::format_date($quotation->getContract()->get('pre_meeting_at')); 
            $action->contract['pre_meeting_at']['time']=format_date($quotation->getContract()->get('pre_meeting_at'),"t");
            $action->contract['opc_at_one_year']=CustomerModelEmailI18n::format_date($quotation->getContract()->getOpcAtDate()->getNextYearDay()->getDate()); 
            if ($quotation->getContract()->hasPolluter())       
                $action->polluter=$quotation->getContract()->getPolluter()->toArrayForDocument();  
            if ($quotation->getContract()->hasCompany())          
                 $action->contract['company']=$quotation->getContract()->getCompany()->toArray(); 
            if ($quotation->getContract()->hasPartner())       
                $action->contract['partner']=$quotation->getContract()->getPartner()->toArrayForDocument();  
            if ($quotation->getContract()->hasPartnerLayer())       
                $action->contract['layer']=$quotation->getContract()->getPartnerLayer()->toArrayForDocument();  
            $calculation =new DomoprimeCalculation($quotation->getContract());
            if ($calculation->isLoaded())          
                 $action->calculation=$calculation->toArrayForQuotation();         
            if ($quotation->getContract()->hasCompany())         
                $action->company=$quotation->getContract()->getCompany()->toArray();          
       }
       if ($quotation->hasMeeting())    
       {    
            $action->meeting=$quotation->getMeeting()->toArray();    
            $action->meeting['created_at']=CustomerModelEmailI18n::format_date($quotation->getMeeting()->get('created_at'));  
            $action->meeting['updated_at']=CustomerModelEmailI18n::format_date($quotation->getMeeting()->get('updated_at'));  
            $action->meeting['in_at']=CustomerModelEmailI18n::format_date($quotation->getMeeting()->get('in_at'));  
            $action->meeting['in_at']['time']=format_date($quotation->getMeeting()->get('in_at'),"t");
            if ($quotation->getMeeting()->hasPolluter())             
                 $action->polluter=$quotation->getMeeting()->getPolluter()->toArrayForDocument();                                               
            if ($quotation->getMeeting()->hasCompany())            
                 $action->contract['company']=$quotation->getMeeting()->getCompany()->toArray();                                               
             $calculation =new DomoprimeCalculation($quotation->getMeeting());
            if ($calculation->isLoaded())          
                $action->calculation=$calculation->toArrayForQuotation();          
            if ($quotation->getMeeting()->hasPartnerLayer())       
                $action->meeting['layer']=$quotation->getMeeting()->getPartnerLayer()->toArrayForDocument();  
            if (!$quotation->hasContract() && $quotation->getMeeting()->hasCompany())          
                $action->company=$quotation->getMeeting()->getCompany()->toArray();       
       }    
       // proposed products (separate with ,)      
       $action->quotation=$quotation->toArrayForQuotation();   
       $action->quotation['created_at']=CustomerModelEmailI18n::format_date($quotation->get('created_at'));  
       $action->quotation['dated_at']=CustomerModelEmailI18n::format_date($quotation->get('dated_at'));  
       $action->quotation['dated_at_90']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+90 days',strtotime($quotation->get('dated_at')))));
       $action->quotation['dated_at_15']=CustomerModelEmailI18n::format_date(date('Y-m-d', strtotime('+15 days',strtotime($quotation->get('dated_at')))));
       if ($calculation->isLoaded())
       {
           foreach (array('prime'=>'getFormattedPrime',
                         'fixed_prime'=>'getFormattedFixedPrime', 
                        'prime_oneeuro'=>'getFormattedCurrencyPrimeOneEuro',
                       'prime_one_euro'=>'getFormattedPrimeOneEuro') as $field=>$method)
           {
               $action->quotation[$field."_precarity"]=$calculation->getSettings()->get('classic_class')!=$calculation->get('class_id')?$quotation->$method():"";
               $action->quotation[$field."_prime_classic"]=$calculation->getSettings()->get('classic_class')==$calculation->get('class_id')?$quotation->$method():"";
               $action->quotation[$field."_prime_modest"]=$calculation->getClass()->get('name')=='0'?$quotation->$method():"";
               $action->quotation[$field."_prime_very_modest"]=$calculation->getClass()->get('name')=='1'?$quotation->$method():"";          
           }                                                                       
       }
       
       $action->products=$quotation->getProductsWithItems()->toArrayForQuotation();  
       $action->master=$quotation->getProductsWithItems()->hasMaster()?$quotation->getProductsWithItems()->getMaster()->toArrayForQuotation():"";
     //  echo "<pre>"; var_dump($action->master); die(__METHOD__);
       $action->works=$quotation->getProductsWithProducts()->getValuesByField('reference')->asort()->implode(', ');       
       $action->restincharge= $quotation->get('fixed_prime')!=0 ? $quotation->getFixedPrime() + $settings->getRestInCharge(): $settings->getRestInCharge();   
       $action->restincharge_symbol= (string)$settings->getFormattedRestInCharge(); 
    //echo "<pre>"; var_dump($action->products); die(__METHOD__);
    }
    
  
}


