<?php



class customers_meetings_forms_filterBodyContractsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                         
          $this->formfields=CustomerMeetingFormUtils::getActiveFormFieldI18nFromFormfieldsForSelect();      
    } 
    
    
}