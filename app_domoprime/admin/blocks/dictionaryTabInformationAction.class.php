<?php

class app_domoprime_dictionaryTabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->variables=DomoprimeExport::getFieldsForExport();  
       $this->getEventDispather()->notify(new mfEvent($this->variables, 'app.domoprime.dictionary.export.calculation'));  
    } 
    
    
}