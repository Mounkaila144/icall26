<?php


class customers_contracts_ajaxPlacementContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {         
         $item=new CustomerContract($request->getPostParameter('Contract'));  
         if ($item->isHold())
               throw new mfException(__('Contract is hold.'));           
          $item->setPlacement($this->getUser());    
          $item->setComments($this->getUser(),'placement');                    
          $item->save();
          $response = array("action"=>"PlacementContract",
                            "id" =>$item->get('id'),
                            "state"=>$item->getStatus()->toArray(array('icon','color')),
                            "state_i18n"=>(string)$item->getStatus()->getI18n(),                            
                            "info"=>__("Contract has been placed.")
                            );
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
