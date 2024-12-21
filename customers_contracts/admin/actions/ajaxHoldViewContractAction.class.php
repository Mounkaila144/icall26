<?php


class customers_contracts_ajaxHoldViewContractAction extends mfAction {
                         
    function execute(mfWebRequest $request) 
    {              
          $messages = mfMessages::getInstance();             
          $item=new CustomerContract($request->getPostParameter('Contract'));                       
     
          $item->setHold();                  
          $item->setComments($this->getUser(),'hold');
      
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.hold'));                     
          $request->addRequestParameter('contract',$item);
          $this->forward($this->getModuleName(),'ajaxViewContract');
    }

}

