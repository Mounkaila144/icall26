<?php


class utils_registration_ajaxDeleteRegistrationAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
      $messages = mfMessages::getInstance();   
      try 
      {         
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Registration'));    
          $item= new UtilsRegistration($id); 
          //var_dump($item);          
          $item->delete();         
          $response = array("action"=>"DeleteRegistration","id" =>$id,"info"=>__("Registration has been deleted."));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
