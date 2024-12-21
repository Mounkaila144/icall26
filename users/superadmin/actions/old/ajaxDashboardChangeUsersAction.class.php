<?php

class users_ajaxDashboardChangeUsersAction extends mfAction {
    
       
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $form=new changeUsersForm($request->getPostParameter('users'));
          $form->bind($request->getPostParameter('users'));
          if ($form->isValid())
          {    
            $users= new UserCollection($form->getValue('users'));   
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
      $response=$messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;    
      return $response;
    }

}

