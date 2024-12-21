<?php

require_once __DIR__."/DomoprimeCustomerRequestViewForm.class.php";

 class DomoprimeCustomerRequestView2Form extends DomoprimeCustomerRequestViewForm {
 
     function getSettings()
     {
         return $this->settings=$this->settings===null?new DomoprimeIsoSettings():$this->settings;
     }
     
    function configure()
    {                       
         parent::configure();
         if ($this->getUser()->hasCredential(array(array('app_domoprime_iso_contract_view_no_items','app_domoprime_iso_contract_new_no_items'))))
             return ;
         foreach (array('wall','top','floor') as $type)
         {                   
            if (!$this->getSettings()->get('surface_'.$type.'_product'))
                continue;           
            $method='get'.ucfirst($type).'Product';
            $this->setValidator('item_'.$type, new mfValidatorChoice(array('choices'=>$this->getSettings()->$method()->getProductItemsForSelect()->unshift(array(''=>''))->toArray(),'required'=>false,'key'=>true)));
            $this->setValidator('added_price_with_tax_'.$type,new mfValidatorI18nNumber(array('empty_value'=>0.0,'required'=>false)));
            $this->setValidator('restincharge_price_with_tax_'.$type,new mfValidatorI18nNumber(array('empty_value'=>0.0,'required'=>false)));
         }        
    }
    
 
}


