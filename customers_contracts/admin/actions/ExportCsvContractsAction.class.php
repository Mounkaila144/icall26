<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
 require_once dirname(__FILE__)."/../locales/Export/CustomerContractExportCsvFilter.class.php";

class customers_contracts_ExportCsvContractsAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {            
        if (!$this->getUser()->hasCredential(array(array('superadmin','contract_export'))))
            $this->forwardTo401Action();
        if ($this->getUser()->hasCredential(array(array('contract_export_validation'))))            
             $this->getEventDispather()->notify(new mfEvent($this, 'contracts.csv.export.validation'));          
        
        $filter= new CustomerContractsFormFilter($this->getUser(),$request->getGetParameter('filter'));             
       // echo "<pre>"; var_dump($request->getGetParameter('filter')); echo "</pre>"; 
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                                                
           $csv=new CustomerContractExportCsvFilter($filter,$this->getUser());
           $csv->build();                       
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
          $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename());       
           $this->getEventDispather()->notify(new mfEvent($csv, 'contracts.csv.export'));                                      
           die();
        }   
        if (!$filter->isValid()) { echo "<!--"; var_dump($filter->getErrorSchema()->getErrorsMessage()); echo "-->"; }
        die("Error filter");
   }

}

