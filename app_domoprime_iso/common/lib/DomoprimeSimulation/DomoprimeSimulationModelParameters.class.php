<?php


class DomoprimeSimulationModelParameters  {
    
    
    static function loadParametersForSimulation(DomoprimeSimulation $simulation,$action)
    {           
        
       $settings=DomoprimeSettings::load($simulation->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($simulation->getSite())->toArray();    
       // Customer
       $action->customer=$simulation->hasContract()?$simulation->getContract()->getCustomer()->toArray():$simulation->getMeeting()->getCustomer()->toArray();      
       // Meeting
       if ($simulation->hasMeeting())
       {    
            $action->meeting=$simulation->getMeeting()->toArray();    
            $action->meeting['created_at']=CustomerModelEmailI18n::format_date($simulation->getMeeting()->get('created_at'));  
            $action->meeting['updated_at']=CustomerModelEmailI18n::format_date($simulation->getMeeting()->get('updated_at'));  
            $action->meeting['in_at']=CustomerModelEmailI18n::format_date($simulation->getMeeting()->get('in_at'));  
            $action->meeting['in_at']['time']=format_date($simulation->getMeeting()->get('in_at'),"t");
            if ($simulation->getMeeting()->hasPolluter())                  
                 $action->polluter=$simulation->getMeeting()->getPolluter()->toArrayForDocument();     
       }
      if ($simulation->hasContract())
       {    
            $action->contract=$simulation->getContract()->toArray();             
            $action->contract['created_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('created_at'));  
            $action->contract['updated_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('updated_at'));  
            $action->contract['opc_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('opc_at'));  
            $action->contract['sav_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('sav_at'));  
            $action->contract['opened_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('opened_at'));  
            $action->contract['payment_at']=CustomerModelEmailI18n::format_date($simulation->getContract()->get('payment_at'));  
            if ($simulation->getContract()->hasPolluter())       
                $action->polluter=$simulation->getContract()->getPolluter()->toArrayForDocument();  
       }
       // proposed products (separate with ,)      
       $action->simulation=$simulation->toArrayForQuotation();   
       $action->simulation['created_at']=CustomerModelEmailI18n::format_date($simulation->get('created_at'));  
       $action->simulation['dated_at']=CustomerModelEmailI18n::format_date($simulation->get('dated_at'));         
       $action->products=$simulation->getProductsWithItems()->toArrayForQuotation();
       $action->works=$simulation->getProductsWithProducts()->getValuesByField('reference')->asort()->implode(', ');       
       $action->restincharge= $settings->getRestInCharge(); 
       $action->restincharge_symbol= (string)$settings->getFormattedRestInCharge(); 
   // echo "<pre>"; var_dump($action->restincharge_symbol); die(__METHOD__);
    }
    
  
}


