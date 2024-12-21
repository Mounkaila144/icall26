<?php

require_once __DIR__."/../locales/Exports/CustomerContractForInstallersExportCsvFilter.class.php";

class app_domoprime_ExportForInstallersAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {         
        if (!$this->getUser()->hasCredential([['superadmin','admin','app_domoprime_contract_schedule_export']]))
            $this->forwardTo401Action(); 
        if ($this->getUser()->hasCredential(array(array('contract_export_installer_validation'))))            
             $this->getEventDispather()->notify(new mfEvent($this, 'contracts.csv.export.installer.validation')); 
        $filter= new CustomerContractsFormFilter($this->getUser());  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {                                                    
           $csv=new CustomerContractsForInstallersExportCsvFilter($filter);          
           $csv->build();  
                      
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($csv->getFilename());
           $response->sendHttpHeaders();
           readfile($csv->getFilename()); 
           $this->getEventDispather()->notify(new mfEvent($csv, 'app.domoprime.contracts.installers.csv.export'));                                      
           die();
        }    
        die("Error filter");
   }

}

