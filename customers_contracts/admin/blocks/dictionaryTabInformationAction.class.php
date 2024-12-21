<?php

class customers_contracts_dictionaryTabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $this->variables= CustomerContract::getFieldsForExport();
       
       //var_dump($this->variables);
    } 
    
    
}