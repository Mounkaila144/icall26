<?php


class customers_meetings_variablesSmsTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerMeetingModelSmsVariables();  
    } 
    
    
}

