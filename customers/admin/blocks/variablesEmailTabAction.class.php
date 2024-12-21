<?php


class customers_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new CustomerModelEmailVariables();  
    } 
    
    
}

