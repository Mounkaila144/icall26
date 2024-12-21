<?php

class customers_contracts_ExportKMLContractAction extends mfAction {
    
    
    
 
    function execute(mfWebRequest $request) {                       
        $contract=new CustomerContract($request->getGetParameter('contract'));
        if ($contract->isNotLoaded())
            $this->forward404File();
        $kml=new CustomerContractExportKML($contract);
        $kml->build();     
        $response=$this->getResponse();     
        $response->setHttpHeader('Content-Type', mfFileMime::getType('kml'));
        $response->setHttpHeader('Content-Length', $kml->getSize());               
        $response->setHttpHeader('Content-Disposition','attachment; filename="'.$kml->getName().'"');
        $response->sendHttpHeaders();
        echo $kml->output();        
        die();       
   }

}

