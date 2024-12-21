<?php



class app_domoprime_iso_requestForViewContract2ActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         $form=$this->getParameter('form');         
         if (!$form->hasValidator('iso2'))
             return mfView::NONE;    
         $contract=$this->getParameter('contract');
         $settings=new DomoprimeIsoSettings();
         if (!$form->getDefault('iso2'))
         {    
            $form->setDefault('iso2',$contract->getProductItems()->getItemsForDefaults($settings->getProductItemsForForm(),$form->getDefault('iso2')));  // contract product items                       
         }
         $this->iso=new DomoprimeCustomerRequest($contract);        
         if ($form->getDefault('iso2'))
            $this->iso->add($form->getDefault('iso2'));
    } 
    
    
}