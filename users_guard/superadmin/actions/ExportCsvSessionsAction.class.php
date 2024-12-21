<?php
require_once dirname(__FILE__).'/../locales/FormFilters/SessionFormFilter.class.php';
require_once dirname(__FILE__).'/../locales/Exports/DashboardUserSessionsExport.class.php';

class users_guard_ExportCsvSessionsAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $filter= new SessionFormFilter();  
        $filter->bind($request->getGetParameter('filter'));

        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
           $csv = new DashboardUserSessionsExport($filter,array());
           $csv->build();             
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }
        else{
            
        }
        die("Error filter");
    }
}
