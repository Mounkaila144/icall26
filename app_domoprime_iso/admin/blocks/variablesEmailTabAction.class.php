<?php


class app_domoprime_iso_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new DomoprimeIsoModelEmailVariables();   
       $this->getEventDispather()->notify(new mfEvent($this->variables, 'app.domoprime.dictionary.models.requests'));  
    } 
    
    
}

