<?php



class customers_contracts_ajaxMultipleBatchProcessAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
       
    }

}
