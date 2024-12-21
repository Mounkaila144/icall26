<?php


class customers_contracts_ajaxProcessAttributionsAction extends mfAction {
    
        
                
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        CustomerContractUtils::updateTeamAttributionsForContracts();
        $messages->addInfo(__('Team process has been done.'));
        $this->forward('users','ajaxListPartialAttribution');
    }

}

