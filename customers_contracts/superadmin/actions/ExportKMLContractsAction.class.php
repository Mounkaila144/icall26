<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/ExportKML/CustomerContractExportKmlFilter.class.php";

class customers_contracts_ExportKMLContractsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {                                         
     /*   $kml=new CustomerContractExportKMLCollection(CustomerContractUtils::getContracts($request->getPostParameter('Contracts'),$site),$site);        
        $kml->build();                               
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        ob_end_clean();
        readfile($kml->getFilename());   
        die();  */
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $filter= new CustomerContractsFormFilter($this->getUser(),array(),$site);  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {               
           $kml=new CustomerContractExportKMLFilter($filter,$site);
           $kml->build();  
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($kml->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($kml->getFilename()); 
           die();
        }    
        die("Error filter");
   }

}

