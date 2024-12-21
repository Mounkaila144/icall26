<?php

class users_ajaxChangeUserAction extends mfAction {
    
    
     
    function execute(mfWebRequest $request) {       
      $messages = mfMessages::getInstance(); 
            if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_change'))))
            $this->forwardTo401Action();
      try 
      {         
          $user=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $user_id=$user->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $user= new User($user_id,'admin');         
          if ($user->isLoaded()) 
          {    
              $user->set('is_active',$value);
              $user->save();
              $this->getEventDispather()->notify(new mfEvent($user, 'user.change','validate')); 
              $response = array("action"=>"ChangeUser","id"=>$user_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

