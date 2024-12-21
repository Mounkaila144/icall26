<?php

class customers_meetings_forms_dictionaryExportTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {               
       // $this->variables=CustomerMeetingFormUtils::getFormsI18nForExport();
        
        $this->variables=CustomerMeetingFormUtils::getFormsI18nForExport2();
    } 
    
    
}