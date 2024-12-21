<?php


class customers_variablesSmsTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerModelEmailVariables();  
    } 
    
    
}

