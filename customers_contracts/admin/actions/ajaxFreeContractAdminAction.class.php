<?php


class customers_contracts_ajaxFreeContractAdminAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerContract($request->getPostParameter('Contract'));            
          $item->setUnHoldAdmin();
          $item->setComments($this->getUser(),'unhold_admin');
          $item->save();
          $this->getEventDispather()->notify(new mfEvent($item, 'contract.unhold_admin'));                     
          $response = array("action"=>"FreeContractAdmin",
                            "id" =>$item->get('id'),
                            "info"=>__("Contract is unhold.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
