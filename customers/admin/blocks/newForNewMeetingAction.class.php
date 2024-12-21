<?php

class customers_newForNewMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                     
         $this->customer_settings=CustomerSettings::load();  
    } 
    
    
}