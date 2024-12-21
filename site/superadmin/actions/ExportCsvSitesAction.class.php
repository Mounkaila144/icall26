<?php

 require_once dirname(__FILE__)."/../locales/Export/SitesExportCsvFormFilter.class.php";
 require_once dirname(__FILE__)."/../locales/FormFilters/SitesFormFilter.class.php";


 
class site_ExportCsvSitesAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {         

        $filter= new SitesFormFilter($this->getUser());  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                                                 
           $csv=new SitesExportCsvFormFilter($filter,array('lang'=>$this->getUser()->getCountry()));                      
           $csv->execute();           
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }    
  //         else var_dump($filter->getErrorSchema()->getErrorsMessage());
        die("Error filter");
   }

}

