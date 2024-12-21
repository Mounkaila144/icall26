<?php


class customers_contracts_ajaxConfirmContractAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new CustomerContract($request->getPostParameter('Contract'));                       
      //     if (!$item->isUserAuthorized($this->getUser()))
     //          $this->forwardTo401Action(); 
          if ($item->isHold())
               throw new mfException(__('Contract is hold.'));       
          $item->setConfirmed($this->getUser());                  
          $item->setComments($this->getUser());                                          
          $item->save();          
             
          $response = array("action"=>"ConfirmContract",
                            "id" =>$item->get('id'),         
                            "state"=>$item->getStatus()->toArray(array('icon','color')),
                            "state_i18n"=>(string)$item->getStatus()->getI18n(),
                            "info"=>__("Contract is confirmed."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
