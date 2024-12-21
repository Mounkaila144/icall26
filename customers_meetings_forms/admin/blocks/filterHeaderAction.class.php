<?php


class customers_meetings_forms_filterHeaderActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $settings=CustomerMeetingFormsSettings::load();         
        $this->formfields_i18n=CustomerMeetingFormUtils::getFormFieldI18nFromFormfieldsForSelect($settings->get('display_columns'));                              
    } 
    
    
}