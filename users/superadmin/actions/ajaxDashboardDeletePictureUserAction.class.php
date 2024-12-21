<?php

class users_ajaxDashboardDeletePictureUserAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $response="";
      try 
      {
          $user=new mfValidatorInteger();
          $user= new User($user->isValid($request->getPostParameter('user')));          
          
          if ($user->isLoaded()&&$user->get('picture'))
          {    
            $user->getPicture()->remove();
            $user->set('picture','');
            $user->save();
            $response = array("action"=>"deletePicture","id" =>$user->get('id')); 
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }      
      $response=$messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
      return $response; 
    }

}
