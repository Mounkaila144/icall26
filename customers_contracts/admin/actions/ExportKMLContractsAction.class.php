<?php

require_once __DIR__."/../locales/ExportKML/CustomerContractExportKmlFilter.class.php";
require_once __DIR__."/../locales/Forms/ContractExportKmlForm.class.php";

class customers_contracts_ExportKMLContractsAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        if (!$this->getUser()->hasCredential([['superadmin','contract_exportKml']]))
                $this->forwardTo401Action ();
        if ($this->getUser()->hasCredential(array(array('contract_export_kml_validation'))))            
             $this->getEventDispather()->notify(new mfEvent($this, 'contracts.csv.export.kml.validation'));     
        $filter= new CustomerContractsFormFilter($this->getUser());  
        $filter->bind($request->getGetParameter('filter'));
        if ($filter->isValid() || $request->getGetParameter('filter')==null)
        {               
           $form= new ContractExportKmlForm();         
           $form->bind($request->getGetParameter('Options'));                               
           $kml=new CustomerContractExportKMLFilter($filter,$this->getUser(),$form->getOptionsForFilter());
           $kml->build();  
           ob_start();
           ob_end_clean();
           $response=$this->getResponse();
           $response->setHeaderFile($kml->getFilename(),true);
           $response->sendHttpHeaders();
           readfile($kml->getFilename()); 
           $this->getEventDispather()->notify(new mfEvent($kml, 'contracts.kml.export'));                                      
           die();
        }    
        die("Error filter");                 
      /*  $kml=new CustomerContractExportKMLCollection(CustomerContractUtils::getContracts($request->getPostParameter('Contracts')));        
        $kml->build();                               
        $response=$this->getResponse();
        $response->setHeaderFile($kml->getFilename(),true);
        $response->sendHttpHeaders();
        ob_end_clean();
        readfile($kml->getFilename());   
        die();   */    
   }

}

