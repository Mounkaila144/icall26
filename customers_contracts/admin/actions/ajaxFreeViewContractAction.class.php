<?php


class customers_contracts_ajaxFreeViewContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
        $messages = mfMessages::getInstance();                    
        $item=new CustomerContract($request->getPostParameter('Contract'));            
        $item->setUnHold();
        $item->setComments($this->getUser(),'unhold');
        $item->save();
        $this->getEventDispather()->notify(new mfEvent($item, 'contract.unhold'));  
        $request->addRequestParameter('contract', $item);
        $this->forward($this->getModuleName(), 'ajaxViewContract');

    }

}
