<?php

class site_company_dictionaryTabInformationActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        
       $this->variables=SiteCompanyExport::getFieldsForExport();
    } 
    
    
}