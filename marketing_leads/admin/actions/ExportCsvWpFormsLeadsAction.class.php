<?php

require_once dirname(__FILE__)."/../locales/Export/MarketingLeadsWpFormsAllLeadsExportCsvFilter.class.php";
require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsAllFormFilter.class.php";

class marketing_leads_ExportCsvWpFormsLeadsAction extends mfAction {
   
    function execute(mfWebRequest $request) {   
        $filter= new MarketingLeadsWpFormsAllFormFilter($this->getUser());          
        
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
           $csv=new MarketingLeadsWpFormsAllLeadsExportCsvFilter($filter,array('lang'=>$this->getUser()->getCountry()));
           $csv->build();             
           mfContext::getInstance()->getEventManager()->notify(new mfEvent($filter, 'marketing.leads.export'));
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }    
        die("Error filter");
   }

}

