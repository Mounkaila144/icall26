<?php


class customers_meetings_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerMeetingModelEmailVariables();  
    } 
    
    
}

