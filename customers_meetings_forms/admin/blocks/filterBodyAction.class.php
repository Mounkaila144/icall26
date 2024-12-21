<?php


class customers_meetings_forms_filterBodyActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $settings=CustomerMeetingFormsSettings::load();         
        $this->formfields=$settings->get('display_columns');       
    } 
    
    
}