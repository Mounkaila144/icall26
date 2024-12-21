<?php

class users_ajaxDeletePictureUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
      
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));  
          $user=new mfValidatorInteger();
          $user_id=$user->isValid($request->getPostParameter('user'));
          $user= new User($user_id,'admin',$site);          
          if ($user->get('picture'))
          {    
            $user->getPicture()->remove();
            $user->set('picture','');
            $user->save();
          }  
          $response = array("action"=>"deletePicture","id" =>$user_id);
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
