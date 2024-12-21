<?php


class customers_contracts_ajaxCancelContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
         $item=new CustomerContract($request->getPostParameter('Contract'));  
         if ($item->isHold())
               throw new mfException(__('Contract is hold.'));           
          $item->setCancelled($this->getUser());    
          $item->setComments($this->getUser(),'cancel');                    
          $item->save();
          $response = array("action"=>"CancelContract",
                            "id" =>$item->get('id'),
                            "state"=>$item->getStatus()->toArray(array('icon','color')),
                            "state_i18n"=>(string)$item->getStatus()->getI18n(),
                            "has_opc_at"=>$item->hasOpcAt(),
                            "info"=>__("Contract is cancelled.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
