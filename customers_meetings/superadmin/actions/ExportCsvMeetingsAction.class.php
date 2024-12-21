<?php


require_once dirname(__FILE__)."/../locales/Export/CustomerMeetingExportCsvFilter.class.php";
require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";

class customers_meetings_ExportCsvMeetingsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {                                              
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $filter= new CustomerMeetingsFormFilter($this->getUser(),$site);  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {               
           $csv=new CustomerMeetingExportCsvFilter($filter,array('lang'=>$this->getUser()->getCountry()),$site);
           $csv->build();          
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }  
       // else var_dump($filter->getErrorSchema ());
        die("Error filter");
   }

}

