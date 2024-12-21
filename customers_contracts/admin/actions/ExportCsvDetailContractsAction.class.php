<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsFormFilter.class.php";
 require_once dirname(__FILE__)."/../locales/Export/CustomerContractDetailExportCsvFilter.class.php";

class customers_contracts_ExportCsvDetailContractsAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {    
         if (!$this->getUser()->hasCredential(array(array('superadmin','contract_export'))))
            $this->forwardTo401Action();
         if ($this->getUser()->hasCredential(array(array('contract_export_validation'))))            
             $this->getEventDispather()->notify(new mfEvent($this, 'contracts.csv.export.validation'));  
        $filter= new CustomerContractsFormFilter($this->getUser());             
       // echo "<pre>"; var_dump($request->getGetParameter('filter')); echo "</pre>"; 
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                          
          //  echo "Filter".$filter->getQuery()."<br/>";              
           $csv=new CustomerContractDetailExportCsvFilter($filter,$this->getUser());
           $csv->build();                       
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
          $response->setHeaderFile($csv->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           die();
        }   
       // if (!$filter->isValid())
       //     var_dump($filter->getErrorSchema()->getErrorsMessage());
        die("Error filter");
   }

}

