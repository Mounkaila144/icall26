<?php

class app_domoprime_dictionary5TabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->variables=DomoprimeEngine5QuotationExport::getFieldsForExport();       
       $this->getEventDispather()->notify(new mfEvent($this->variables, 'app.domoprime.dictionary.export.quotation'));  
    } 
    
    
}