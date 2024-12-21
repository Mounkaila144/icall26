<?php

class partners_dictionaryTabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->variables=PartnerExport::getFieldsForExport();
       
       //var_dump($this->variables);
    } 
    
    
}