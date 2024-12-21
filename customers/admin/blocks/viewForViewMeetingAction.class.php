<?php

class customers_viewForViewMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                     
        $this->customer_settings=CustomerSettings::load();   
    } 
    
    
}