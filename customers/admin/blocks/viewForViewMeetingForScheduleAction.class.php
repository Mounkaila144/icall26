<?php

class customers_viewForViewMeetingForScheduleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                     
        $this->customer_settings=CustomerSettings::load();   
    } 
    
    
}