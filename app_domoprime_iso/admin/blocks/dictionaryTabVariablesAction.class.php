<?php


class app_domoprime_iso_dictionaryTabVariablesActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new DomoprimeIsoModelVariables();      
       $this->getEventDispather()->notify(new mfEvent($this->variables, 'app.domoprime.dictionary.export.requests'));  
    } 
    
    
}

