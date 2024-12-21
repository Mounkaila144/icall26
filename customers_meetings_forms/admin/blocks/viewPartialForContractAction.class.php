<?php

    

class customers_meetings_forms_viewPartialForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                 
         $form=$this->getParameter('form');
         if (!$form->hasValidator('extra'))
             return mfView::NONE;        
    } 
    
    
}