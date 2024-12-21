<?php



class app_domoprime_iso_requestForViewMeetingActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
         $form=$this->getParameter('form');         
         if (!$form->hasValidator('iso'))
             return mfView::NONE;    
         $meeting=$this->getParameter('meeting');
         $this->iso=new DomoprimeCustomerRequest($meeting,$meeting->getSite());
         if ($form->getDefault('iso'))
            $this->iso->add($form->getDefault('iso'));
    } 
    
    
}