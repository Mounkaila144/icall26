<?php


class customers_ajaxDisableUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $validator=new mfValidatorInteger();
          $customer= new CustomerUser($validator->isValid($request->getPostParameter('CustomerUser')));          
          if ($customer->isLoaded() && !$customer->isAdmin())
          {    
            $customer->set('status','DELETE');
            $customer->save();
            $response = array("action"=>"DisableUser","id" =>$customer->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
