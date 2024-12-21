<?php


class customers_meetings_forms_variablesEmailTabForContractActionComponent extends mfActionComponent {

    
    
    function execute(mfWebRequest $request)
    {        
        $this->variables=new CustomerMeetingFormsModelEmailVariablesForContract();  
    } 
    
    
}

