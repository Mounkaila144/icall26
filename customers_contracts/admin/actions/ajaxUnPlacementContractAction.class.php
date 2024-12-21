<?php


class customers_contracts_ajaxUnPlacementContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
          $item=new CustomerContract($request->getPostParameter('Contract'));  
          if ($item->isHold())
               throw new mfException(__('Contract is hold.'));               
          $item->setUnPlacement($this->getUser());
          $item->setComments($this->getUser(),'unplacement');        
          $item->save();
          $response = array("action"=>"UnPlacementContract",
                            "id" =>$item->get('id'),
                            "state"=>$item->getStatus()->toArray(array('icon','color')),
                            "state_i18n"=>(string)$item->getStatus()->getI18n(),                         
                            "info"=>__("Contract placement has been removed.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}