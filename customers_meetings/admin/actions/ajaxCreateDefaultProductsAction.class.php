<?php


class customers_meetings_ajaxCreateDefaultProductsAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {                
         $item=new CustomerMeeting($request->getPostParameter('Meeting'));
         if (!$item->isUserAuthorized($this->getUser()))
            $this->forwardTo401Action();    
         if ($item->isLoaded())
         {    
            $item->createDefaultProducts();
            $response = array("action"=>"CreateDefaultProducts",
                              "id" =>$item->get('id'),
                              "info"=>__("Default products have been created.")
                          );
         }    
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

