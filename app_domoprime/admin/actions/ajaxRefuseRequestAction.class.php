<?php


class app_domoprime_ajaxRefuseRequestAction extends mfAction {
    
       
    
  
        
    function execute(mfWebRequest $request) 
    {              
      $messages = mfMessages::getInstance();             
      try 
      {                            
          $item=new DomoprimeCalculation($request->getPostParameter('DomoprimeRequest'));                         
          $item->setRefused($this->getUser());                        
          $item->save();
          $response = array("action"=>"RefuseRequest",
                            "id" =>$item->get('id'),   
                            "status"=>$item->getStatusI18n(),
                            "accepted_by"=>(string)$this->getUser()->getGuardUser()->getUpperName(),
                            "info"=>__("Request has been refused."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
