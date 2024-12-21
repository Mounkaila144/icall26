<?php



class customers_meetings_forms_filterSearchContractsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                         
         $this->formfields=CustomerMeetingFormUtils::getActiveFormFieldI18nFromFormfieldsForSelect();      
    } 
    
    
}