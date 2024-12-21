<?php


class customers_meetings_forms_filterInActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $settings=CustomerMeetingFormsSettings::load();         
        //$this->formfields=$settings->get('filter_columns'); 
        $this->formfields=CustomerMeetingFormUtils::getFormFieldI18nFromFormfieldsForIn($settings->get('filter_columns'));   
       // echo "<pre>"; var_dump($settings->get('filter_columns')); echo "</pre>"; 
      // echo "<pre>"; var_dump($this->formfields); echo "</pre>"; 
    } 
    
    
}