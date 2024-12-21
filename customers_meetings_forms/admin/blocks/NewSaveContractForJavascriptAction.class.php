<?php



class customers_meetings_forms_NewSaveContractForJavascriptActionComponent extends mfActionComponent {

     
    function execute(mfWebRequest $request)
    {                
         if (!$this->getUser()->hasCredential(array(array('superadmin','contract_new_forms'))))
                 return mfView::NONE;
    } 
    
    
}