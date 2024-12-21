<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/ExportKML/CustomerMeetingExportKmlFilter.class.php";

class customers_meetings_ExportKMLMeetingsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {              
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $filter= new CustomerMeetingsFormFilter($this->getUser(),$site);         
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {               
           $kml=new CustomerMeetingExportKMLFilter($filter,$site);
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
        
      /*  $kml=new CustomerMeetingExportKMLCollection(CustomerMeetingUtils::getMeetings($request->getPostParameter('Meetings'),$site),$site);        
        $kml->build();                     
        ob_start();
        ob_end_clean();
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        readfile($kml->getFilename());   
        die();       */
   }

}

