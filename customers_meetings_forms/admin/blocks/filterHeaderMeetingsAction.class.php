<?php



class customers_meetings_forms_filterHeaderMeetingsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                                 
        $this->formfields=CustomerMeetingFormUtils::getActiveFormFieldI18nFromFormfieldsForSelect();                                        
    } 
    
    
}