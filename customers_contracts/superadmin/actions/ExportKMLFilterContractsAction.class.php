<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerContractsFormFilter.class.php";

class customers_contracts_ExportKMLFilterContractsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                      
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"site","Admin");           
        $formFilter= new CustomerContractsFormFilter($this->getUser(),$site);    
        $formFilter->bind($request->getGetParameter('filter'));
        if (!$formFilter->isValid() && $request->getGetParameter('filter'))              
            return ;                
        $kml=new CustomerContractExportKMLCollection(CustomerContractUtils::getContractsFromFilter($formFilter,$site),$site);        
        $kml->build();                               
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        ob_end_clean();
        readfile($kml->getFilename());  
        die();       
   }

}

