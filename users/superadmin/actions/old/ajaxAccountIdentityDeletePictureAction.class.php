<?php

class users_ajaxAccountIdentityDeletePictureAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $current_user=$this->getUser()->getGuardUser(); // get current user 
      try 
      {
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('user'));
          $user= new User($user_id);
          if ($user->get('id')!=$current_user->get('id')&&!$this->getUser()->hasCredential('superadmin_users'))
            throw new mfException(__("you don't have the right permission to do this action."));
          if ($user->isLoaded())
          {    
              $picture=$user->get('picture');
              if ($picture)
              {    
                $user->getPicture()->remove();
                $user->set('picture','');
                $user->save();
              }  
              $response = array("action"=>"deletePicture","id" =>$user_id);
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
