<?php


class DomoprimeAssetModelParameters  {
    
    
    static function loadParametersForAsset(DomoprimeAsset $asset,$action)
    {               
       $settings=DomoprimeSettings::load($asset->getSite());
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($asset->getSite())->toArray();    
       // Customer
       $action->customer=$asset->getContract()->getCustomer()->toArray();      
       // Meeting
       $action->contract=$asset->getContract()->toArray();    
       $action->contract['created_at']=CustomerModelEmailI18n::format_date($asset->getContract()->get('created_at'));  
       $action->contract['updated_at']=CustomerModelEmailI18n::format_date($asset->getContract()->get('updated_at'));  
       $action->contract['in_at']=CustomerModelEmailI18n::format_date($asset->getContract()->get('in_at'));  
       $action->contract['in_at']['time']=format_date($asset->getContract()->get('in_at'),"t");
       if ($asset->getContract()->hasCompany())          
           $action->contract['company']=$asset->getContract()->getCompany()->toArray();     
       if ($asset->getContract()->hasCompany())         
           $action->company=$asset->getContract()->getCompany()->toArray();    
       $action->asset=$asset->toArrayForAsset();
       $action->asset['dated_at']=CustomerModelEmailI18n::format_date($asset->get('dated_at')); 
       if ($asset->hasContract() && $asset->getContract()->hasCompany())       
           $action->company=$asset->getContract()->getCompany()->toArray();            
       if ($asset->hasBilling())
       {    
            $action->asset['billing']=array();
            $action->asset['billing']=$asset->getBilling()->toArrayForBilling();                       
            $action->asset['billing']['created_at']=CustomerModelEmailI18n::format_date($asset->getBilling()->get('created_at'));  
            $action->asset['billing']['dated_at']=CustomerModelEmailI18n::format_date($asset->getBilling()->get('dated_at'));    
            $action->asset['billing']['products']=$asset->getBilling()->getProductsWithItems()->toArrayForBilling();  
            if ($asset->getBilling()->getContract()->hasPartnerLayer())       
                $action->asset['billing']['contract']['layer']=$asset->getBilling()->getContract()->getPartnerLayer()->toArrayForDocument();  
            $action->asset['billing']['products']=$asset->getBilling()->getProductsWithItems()->toArrayForBilling();            
            if ($asset->getBilling()->getContract()->hasPolluter())       
                 $action->asset['billing']['polluter']=$asset->getBilling()->getContract()->getPolluter()->toArrayForDocument();  
            if ($asset->getBilling()->getContract()->hasCompany())          
                 $action->asset['billing']['company']=$asset->getBilling()->getContract()->getCompany()->toArray();  
       }
        if (mfcontext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))) && mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true')
           {
               echo "<pre>"; var_dump(array(
                   'asset'=>$action->asset,                                 
                   'contract'=>$action->contract,
                   'customer'=>$action->customer,
               ));
               die();
           }  
    }
    
  
}


