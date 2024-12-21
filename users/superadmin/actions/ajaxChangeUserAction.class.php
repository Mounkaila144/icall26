<?php

class users_ajaxChangeUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
      if (!$request->isXmlHttpRequest()) 
            $this->redirect("/superadmin/users");
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));  
          $user=new mfValidatorInteger();
          $value=new mfValidatorBoolean();
          $user_id=$user->isValid($request->getPostParameter('id'));
          $value=$value->isValid($request->getPostParameter('value'))?"NO":"YES";
          $user= new User($user_id,'admin',$site);         
          if ($user->isLoaded()) 
          {    
              $user->set('is_active',$value);
              $user->save();
              $response = array("action"=>"ChangeUser","id"=>$user_id,"state" =>$value);
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

