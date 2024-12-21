<?php
require_once dirname(__FILE__).'/../locales/FormFilters/SessionFormFilter.class.php';
require_once dirname(__FILE__).'/../locales/Exports/UserSessionsExport.class.php';

class users_guard_ExportCsvSessionsAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $filter= new SessionFormFilter();  
        $filter->bind($request->getGetParameter('filter'));
       // var_dump($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
            //echo "Filter : ".$filter->getQuery()."<br/>"; 
            //die(__METHOD__);
           $csv=new UserSessionsExport($filter,array());
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
           // echo '<pre>';var_dump($filter->getErrorSchema()->getErrorsMessage());echo '</pre>';
        }
        die("Error filter");
    }
}
