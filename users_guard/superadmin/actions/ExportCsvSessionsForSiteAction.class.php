<?php
require_once dirname(__FILE__).'/../locales/FormFilters/SessionForSiteFormFilter.class.php';
require_once dirname(__FILE__).'/../locales/Exports/UserSessionsForSiteExport.class.php';

class users_guard_ExportCsvSessionsForSiteAction extends mfAction{
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request){
        
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        if(!$this->site)
            die("Error site not loaded");
        
        $filter = new SessionForSiteFormFilter();  
        $filter->bind($request->getGetParameter('filter'));

        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
           $csv = new UserSessionsForSiteExport($filter,array(),$this->site);
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
