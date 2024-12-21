<?php



class app_domoprime_iso_requestForViewContractActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         $form=$this->getParameter('form');         
         if (!$form->hasValidator('iso'))
             return mfView::NONE;    
         $contract=$this->getParameter('contract');
         $this->iso=new DomoprimeCustomerRequest($contract);
         if ($form->getDefault('iso'))
            $this->iso->add($form->getDefault('iso'));
    } 
    
    
}