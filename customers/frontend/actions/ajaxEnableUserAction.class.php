<?php


class customers_ajaxEnableUserAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {         
          $validator=new mfValidatorInteger();
          $customer= new CustomerUser($validator->isValid($request->getPostParameter('CustomerUser')));          
          if ($customer->isLoaded() && !$customer->isAdmin())
          {    
            $customer->set('status','ACTIVE');
            $customer->save();
            $response = array("action"=>"EnableUser","id" =>$customer->get('id'));
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
