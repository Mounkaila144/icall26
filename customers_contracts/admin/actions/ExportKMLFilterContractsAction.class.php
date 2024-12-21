<?php

class customers_contracts_ExportKMLFilterContractsAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {  
        if (!$this->getUser()->hasCredential([['superadmin','admin','contract_exportKml']]))
                $this->forwardTo401Action ();
        if ($this->getUser()->hasCredential(array(array('contract_export_kml_validation'))))            
             $this->getEventDispather()->notify(new mfEvent($this, 'contracts.csv.export.kml.validation')); 
        // Control access is permitted
        $formFilter= new CustomerContractsFormFilter($this->getUser());    
        $formFilter->bind($request->getGetParameter('filter'));
        if (!$formFilter->isValid() && $request->getGetParameter('filter'))              
          return ;                 
        $kml=new CustomerContractExportKMLCollection(CustomerContractUtils::getContractsFromFilter($formFilter));        
        $kml->build();                               
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        ob_end_clean();
        readfile($kml->getFilename());  
        $this->getEventDispather()->notify(new mfEvent($kml, 'contracts.filter.kml.export'));                    
        die();       
   }

}
