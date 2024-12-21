<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeQuotationFormFilter.class.php";

class app_domoprime_ExportCsvQuotationsAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {          
        if (!$this->getUser()->hasCredential([['superadmin','admin','app_domoprime_quotation_export']]))
            $this->forwardTo401Action(); 
        $filter= new DomoprimeQuotationFormFilter($this->getUser());          
       // echo "<pre>"; var_dump($request->getGetParameter('filter')); echo "</pre>"; 
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
           // echo "Filter".$filter->getQuery()."<br/>";           
          $csv=new DomoprimeQuotationExportCsvFilter($filter,$this->getUser(),array('lang'=>$this->getUser()->getCountry()));        
          $csv->build();                       
          ob_start();
          ob_end_clean();
          $response=$this->getResponse();
          $response->setHeaderFile($csv->getFilename());
          $response->sendHttpHeaders();
          readfile($csv->getFilename()); 
          $this->getEventDispather()->notify(new mfEvent($csv, 'app.domoprime.quotations.csv.export'));                                      
          die();
        }    
        die("Error filter");
   }

}

