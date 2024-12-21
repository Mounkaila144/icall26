<?php


class customers_contracts_variablesSmsTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerContractModelSmsVariables();  
    } 
    
    
}

