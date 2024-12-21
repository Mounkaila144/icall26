<?php



class app_domoprime_iso_requestForNewContract2ActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         $form=$this->getParameter('form');
         if (!$form->hasValidator('iso2'))
             return mfView::NONE;    
         $this->iso=new DomoprimeCustomerRequest();
         $this->iso->add($form->getDefault('iso2'));
    } 
    
    
}