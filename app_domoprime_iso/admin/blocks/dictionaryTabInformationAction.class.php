<?php

class app_domoprime_iso_dictionaryTabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        
       $this->variables=DomoprimeIsoExport::getFieldsForExport();
       $this->getEventDispather()->notify(new mfEvent($this->variables, 'app.domoprime.iso.export.variables'));                                      
    } 
    
    
}