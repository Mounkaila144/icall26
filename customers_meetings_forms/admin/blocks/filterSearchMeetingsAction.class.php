<?php



class customers_meetings_forms_filterSearchMeetingsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                         
         $this->formfields=CustomerMeetingFormUtils::getActiveFormFieldI18nFromFormfieldsForSelect();      
    } 
    
    
}