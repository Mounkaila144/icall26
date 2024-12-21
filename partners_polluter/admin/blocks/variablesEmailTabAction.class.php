<?php


class partners_polluter_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new PartnerPolluterModelVariables();  
    } 
    
    
}

