<?php

class users_ajaxChangeUsersAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));  
          $form=new changeUsersForm($request->getPostParameter('users'));
          $form->bind($request->getPostParameter('users'));
          if ($form->isValid())
          {    
            $users= new UserCollection($form->getValue('users'),'admin',$site);   
            $users->save();
            $this->getEventDispather()->notify(new mfEvent($users, 'users.change','change')); 
            $response = array("action"=>"ChangeUsers",
                            "state" =>$form->getValue('value'),
                            "selection" =>$form->getValue('selection')
                           );
          }
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

