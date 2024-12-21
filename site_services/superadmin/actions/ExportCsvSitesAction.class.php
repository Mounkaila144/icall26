<?php

 require_once dirname(__FILE__)."/../locales/Export/SiteServicesExportCsvFormFilter.class.php";
 require_once dirname(__FILE__)."/../locales/FormFilters/SiteServicesSiteFormFiter.class.php";


class site_services_ExportCsvSitesAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {         

        $filter= new SiteServicesSiteFormFiter($this->getUser());  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                                                 
           $csv=new SiteServicesExportCsvFormFilter($filter,array('lang'=>$this->getUser()->getCountry()));                      
           $csv->execute();           
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }          
        else 
        {                  
       //     var_dump($filter->getErrorSchema()->getErrorsMessage());

        }
        die("Error filter");
   }

}

