<?php


class customers_meetings_forms_variablesEmailTabActionComponent extends mfActionComponent {

    
    
    function execute(mfWebRequest $request)
    {        
        $this->variables=new CustomerMeetingFormsModelEmailVariables();  
    } 
    
    
}

