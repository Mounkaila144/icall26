<?php


class partners_partners_layer_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new PartnerPolluterModelVariables();  
    } 
    
    
}

