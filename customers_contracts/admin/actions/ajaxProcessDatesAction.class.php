<?php

 
class customers_contracts_ajaxProcessDatesAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $engine=new CustomerContractDatesEngine();
        $engine->process();
        $messages->addInfo(__('Dates have been processed (%s contracts not valid).',$engine->getNumberOfContractNotValid()));
        $this->forward($this->getModuleName(),'ajaxListPartialDatesContract');
    }
    
    
}
