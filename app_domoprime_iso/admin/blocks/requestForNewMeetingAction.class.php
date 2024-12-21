<?php



class app_domoprime_iso_requestForNewMeetingActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         $form=$this->getParameter('form');
         if (!$form->hasValidator('iso'))
             return mfView::NONE;    
         $this->iso=new DomoprimeCustomerRequest();
         $this->iso->add($form->getDefault('iso'));
    } 
    
    
}