<?php


class customers_contracts_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerContractModelEmailVariables();  
    } 
    
    
}

