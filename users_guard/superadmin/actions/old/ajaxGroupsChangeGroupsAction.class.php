<?php

class userGuard_ajaxGroupsChangeGroupsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
      if (!$site)
          return "";
      try 
      {
          $form=new changeGroupsForm($request->getPostParameter('groups'));
          $form->bind($request->getPostParameter('groups'));
          if ($form->isValid())
          {    
            $users= new GroupCollection($form->getValue('groups'),array("admin","frontend"),$site);   
            $users->save();
            $this->getEventDispather()->notify(new mfEvent($users, 'groups.change','change')); 
            $response = array("action"=>"ChangeGroups",
                            "state" =>$form->getValue('value'),
                            "selection" =>$form->getValue('selection')
                           );
          }
      }
      catch (mfException $e) {
          $messages->addError($e);
      }
      $response=$messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
      return$response;
    }

}

